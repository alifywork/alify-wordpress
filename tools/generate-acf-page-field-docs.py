#!/usr/bin/env python3
"""Generate page-by-page ACF content-field inventories from bundled source HTML.

The output is documentation only: it does not register ACF fields, alter source
content, or write to WordPress. Re-run from the repository root after editing
frontend-source/*.html to refresh docs/acf-page-fields/*.md.
"""
from __future__ import annotations

from html.parser import HTMLParser
from pathlib import Path
import html as html_lib
import json
import re

ROOT = Path(__file__).resolve().parents[1]
SOURCE = ROOT / "frontend-source"
OUTPUT = ROOT / "docs" / "acf-page-fields"
VOID = {"area", "base", "br", "col", "embed", "hr", "img", "input", "link", "meta", "param", "source", "track", "wbr"}
SKIP_TEXT = {"script", "style", "noscript", "svg", "i"}
BLOCK_TEXT = {"h1", "h2", "h3", "h4", "h5", "h6", "p", "blockquote", "label", "legend", "button", "a", "li", "summary", "dt", "dd", "figcaption", "th", "td"}
INLINE_TEXT = {"span", "strong", "em", "small", "time", "abbr", "code", "mark"}
ARCHIVE_SLUGS = {"blog", "case-studies", "faqs", "industries", "pricing", "projects", "services", "testimonials"}


class Node:
    def __init__(self, tag: str, attrs: dict[str, str | None] | None = None):
        self.tag = tag
        self.attrs = attrs or {}
        self.children: list[Node | str] = []
        self.parent: Node | None = None

    def descendants(self):
        for child in self.children:
            if isinstance(child, Node):
                yield child
                yield from child.descendants()

    def text(self) -> str:
        pieces: list[str] = []
        def collect(node: Node):
            if node.tag in SKIP_TEXT:
                return
            for child in node.children:
                if isinstance(child, str):
                    pieces.append(child)
                else:
                    collect(child)
        collect(self)
        return clean(" ".join(pieces))


class DocumentParser(HTMLParser):
    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.root = Node("document")
        self.stack = [self.root]

    def handle_starttag(self, tag, attrs):
        node = Node(tag, dict(attrs))
        node.parent = self.stack[-1]
        self.stack[-1].children.append(node)
        if tag not in VOID:
            self.stack.append(node)

    def handle_startendtag(self, tag, attrs):
        node = Node(tag, dict(attrs))
        node.parent = self.stack[-1]
        self.stack[-1].children.append(node)

    def handle_endtag(self, tag):
        for i in range(len(self.stack) - 1, 0, -1):
            if self.stack[i].tag == tag:
                del self.stack[i:]
                break

    def handle_data(self, data):
        self.stack[-1].children.append(data)


def clean(value: str | None) -> str:
    return re.sub(r"\s+", " ", value or "").strip()


def descendants(node: Node, tag: str | None = None):
    return [item for item in node.descendants() if tag is None or item.tag == tag]


def inside_form(node: Node, boundary: Node) -> bool:
    parent = node.parent
    while parent and parent is not boundary:
        if parent.tag == "form":
            return True
        parent = parent.parent
    return False


def serialize_node(node: Node | str) -> str:
    if isinstance(node, str):
        return html_lib.escape(node, quote=False)
    attrs = "".join(
        f" {name}" if value is None else f' {name}="{html_lib.escape(str(value), quote=True)}"'
        for name, value in node.attrs.items()
    )
    opening = f"<{node.tag}{attrs}>"
    if node.tag in VOID:
        return opening
    return opening + "".join(serialize_node(child) for child in node.children) + f"</{node.tag}>"


def node_inner_html(node: Node) -> str:
    return "".join(serialize_node(child) for child in node.children)


def esc(value: str) -> str:
    return value.replace("\\", "\\\\").replace("`", "\\`").replace("|", "\\|").replace("\n", " ")


def nested_block_ancestor(node: Node, boundary: Node) -> bool:
    parent = node.parent
    while parent and parent is not boundary:
        if parent.tag in BLOCK_TEXT:
            return True
        parent = parent.parent
    return False


def section_heading(section: Node, index: int) -> str:
    label = clean(section.attrs.get("aria-label"))
    if label:
        return label
    heading = next((n.text() for n in descendants(section) if n.tag in {"h2", "h3"} and n.text()), "")
    return heading or f"Section {index:02d}"


def field_doc(slug: str, source: Path) -> str:
    parser = DocumentParser()
    parser.feed(source.read_text(encoding="utf-8"))
    root = parser.root
    hero = next((n for n in root.descendants() if n.tag == "page-hero"), None)
    main = next((n for n in root.descendants() if n.tag == "main"), None)
    hero_values: dict[str, tuple[str, str]] = {}
    if hero:
        for attr, field_type in (("eyebrow", "Text"), ("title", "Text"), ("description", "Textarea"), ("background", "Select/Image"), ("variant", "Select")):
            value = clean(hero.attrs.get(attr))
            if value:
                hero_values[f"hero_{attr}"] = (field_type, value)
    elif slug == "index":
        hero_classes = {"intro__eyebrow": "hero_eyebrow", "intro__title": "hero_title", "intro__text": "hero_description"}
        for node in root.descendants():
            classes = set((node.attrs.get("class") or "").split())
            for class_name, field_name in hero_classes.items():
                if class_name in classes and node.text():
                    hero_values[field_name] = ("Textarea" if field_name.endswith("description") else "Text", node.text())
        bg = next((n for n in root.descendants() if n.tag == "img" and "assets/images/background/neon-lines-" in (n.attrs.get("src") or "")), None)
        if bg:
            hero_values["hero_background"] = ("Image/Select", clean(bg.attrs.get("src")))
    lines = [
        f"# ACF Field Inventory — `{slug}`",
        "",
        f"Source: [`frontend-source/{source.name}`](../../frontend-source/{source.name})",
        "",
        ("> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination." if slug in ARCHIVE_SLUGS else "> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme."),
        "",
        "Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.",
        "",
    ]
    title_node = next((n for n in root.descendants() if n.tag == "title"), None)
    description_meta = next((n for n in root.descendants() if n.tag == "meta" and n.attrs.get("name", "").lower() == "description"), None)
    if title_node or description_meta:
        lines += ["## SEO metadata", "", "| ACF field | Suggested ACF type | Current source value |", "|---|---|---|"]
        if title_node and title_node.text():
            lines.append(f"| `seo_title` | Text | {esc(title_node.text())} |")
        if description_meta and clean(description_meta.attrs.get("content")):
            lines.append(f"| `meta_description` | Textarea | {esc(clean(description_meta.attrs.get('content')))} |")
        lines.append("")
    if hero_values:
        lines += ["## Hero", "", "| ACF field | Suggested ACF type | Current source value |", "|---|---|---|"]
        for field_name, (field_type, value) in hero_values.items():
            lines.append(f"| `{field_name}` | {field_type} | {esc(value)} |")
        lines.append("")
    else:
        lines += ["## Hero", "", "No source hero component or recognized homepage intro fields were found. Inspect the first page heading before defining the page group.", ""]

    if not main:
        lines += ["## Main content", "", "No `<main>` element was found. Review this source before defining the page group.", ""]
        return "\n".join(lines)

    sections = [n for n in descendants(main, "section") if not any(a.tag == "section" for a in ancestors_until(n, main))]
    if not sections:
        sections = [main]
    lines += ["## Main content fields", ""]
    for section_index, section in enumerate(sections, 1):
        title = section_heading(section, section_index)
        section_name = f"section_{section_index:02d}"
        lines += [f"### {section_index:02d}. {title}", ""]
        aria = clean(section.attrs.get("aria-label"))
        section_id = clean(section.attrs.get("id"))
        if aria or section_id:
            lines.append("Section metadata: " + "; ".join(x for x in ([f"aria-label: `{aria}`"] if aria else []) + ([f"id: `{section_id}`"] if section_id else [])) + ".")
            lines.append("")
        category_values = []
        for node in descendants(section):
            for attr in ("data-category", "data-filter", "data-faq-filter"):
                value = clean(node.attrs.get(attr))
                if value:
                    category_values.append((attr, value))
        if category_values:
            lines.append("Interaction/filter data: " + "; ".join(f"`{attr}` = `{esc(value)}`" for attr, value in category_values) + ".")
            lines.append("")

        semantic = [n for n in descendants(section) if n.tag in BLOCK_TEXT and n.text() and not nested_block_ancestor(n, section)]
        counters: dict[str, int] = {}
        for node in semantic:
            name_tag = "heading" if node.tag.startswith("h") else {
                "p": "copy", "li": "list_item", "a": "link_label", "button": "button_label",
                "blockquote": "quote", "label": "field_label", "legend": "legend",
                "summary": "summary", "dt": "term", "dd": "definition", "figcaption": "caption",
                "th": "table_heading", "td": "table_cell",
            }.get(node.tag, "text")
            counters[name_tag] = counters.get(name_tag, 0) + 1
            idx = counters[name_tag]
            name = f"{section_name}_{name_tag}_{idx:02d}"
            value = node.text()
            extra = f" (HTML `{node.tag}`)"
            lines.append(f"- `{name}` — **{name_tag.replace('_', ' ').title()}**{extra}: {esc(value)}")

        for node in descendants(section):
            if node.tag not in INLINE_TEXT or nested_block_ancestor(node, section):
                continue
            if any(isinstance(child, Node) for child in node.children) or not node.text():
                continue
            counters["inline_text"] = counters.get("inline_text", 0) + 1
            name = f"{section_name}_inline_text_{counters['inline_text']:02d}"
            lines.append(f"- `{name}` — **Inline Text** (HTML `{node.tag}`): {esc(node.text())}")

        links = [node for node in descendants(section, "a") if not inside_form(node, section)]
        if links:
            lines.append("")
            lines.append("Link destinations:")
            for i, link in enumerate(links, 1):
                label = link.text() or clean(link.attrs.get("aria-label")) or "[image/icon-only link]"
                url = clean(link.attrs.get("href")) or "[no href in source]"
                lines.append(f"- `{section_name}_link_{i:02d}_url` — {esc(label)} → `{esc(url)}`")

        images = [node for node in descendants(section, "img") if not inside_form(node, section)]
        if images:
            lines.append("")
            lines.append("Images/media:")
            for i, image in enumerate(images, 1):
                lines.append(f"- `{section_name}_image_{i:02d}` (**Image**): `{esc(clean(image.attrs.get('src')) or '[no src]')}`")
                lines.append(f"  - `{section_name}_image_{i:02d}_alt` (**Text**): {esc(clean(image.attrs.get('alt')) or '[empty alt — decorative or alt text needed]')}")

        forms = descendants(section, "form")
        for form_index, form in enumerate(forms, 1):
            lines += ["", f"Form `{section_name}_form_{form_index:02d}` — separate WYSIWYG field for labels and safe HTML; keep the `ALIFY_CONTROL_XX` placeholders so the validated server-owned controls are restored in place:"]
            form_labels = {n.attrs.get("for"): n.text() for n in descendants(form, "label") if n.attrs.get("for")}
            for field_index, control in enumerate([n for n in descendants(form) if n.tag in {"input", "select", "textarea"}], 1):
                attrs = control.attrs
                field_type = clean(attrs.get("type")) if control.tag == "input" else control.tag
                detail = [f"type={field_type or control.tag}"]
                if attrs.get("name"):
                    detail.append(f"name={attrs['name']}")
                if attrs.get("id"):
                    detail.append(f"id={attrs['id']}")
                if attrs.get("id") in form_labels:
                    detail.append(f"label={form_labels[attrs['id']]}")
                if "required" in attrs:
                    detail.append("required")
                if attrs.get("placeholder"):
                    detail.append(f"placeholder={attrs['placeholder']}")
                if attrs.get("autocomplete"):
                    detail.append(f"autocomplete={attrs['autocomplete']}")
                lines.append(f"- `{section_name}_form_{form_index:02d}_field_{field_index:02d}` — " + ", ".join(f"`{esc(x)}`" for x in detail))
                if control.tag == "select":
                    choices = [(o.text(), clean(o.attrs.get("value"))) for o in descendants(control, "option") if o.text()]
                    if choices:
                        lines.append("  - Options: " + "; ".join(f"`{esc(label)}`" + (f" (value `{esc(value)}`)" if value else "") for label, value in choices))

        cards = [n for n in descendants(section, "article")]
        if cards:
            lines += ["", f"Repeated content: {len(cards)} `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present."]
        lines.append("")

    lines += [
        "## Shared implementation notes",
        "",
        "- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.",
        "- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.",
        "- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.",
        "- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.",

        "",
    ]
    return "\n".join(lines)


def ancestors_until(node: Node, stop: Node):
    parent = node.parent
    result = []
    while parent and parent is not stop:
        result.append(parent)
        parent = parent.parent
    return result


def build_acf_page_data(source: Path) -> dict:
    parser = DocumentParser()
    parser.feed(source.read_text(encoding="utf-8"))
    root = parser.root
    main_node = next((n for n in root.descendants() if n.tag == "main"), None)
    if not main_node:
        return {"title": source.stem, "sections": []}
    section_nodes = [n for n in descendants(main_node, "section") if not any(a.tag == "section" for a in ancestors_until(n, main_node))]
    sections = []
    for i, section in enumerate(section_nodes, 1):
        links = []
        for j, link in enumerate((node for node in descendants(section, "a") if not inside_form(node, section)), 1):
            href = clean(link.attrs.get("href"))
            if href:
                links.append({"index": j, "label": link.text() or clean(link.attrs.get("aria-label")), "href": href})
        images = []
        for j, image in enumerate((node for node in descendants(section, "img") if not inside_form(node, section)), 1):
            images.append({"index": j, "src": clean(image.attrs.get("src")), "alt": clean(image.attrs.get("alt"))})
        forms = []
        section_html = node_inner_html(section)
        for j, form in enumerate(descendants(section, "form"), 1):
            form_html = serialize_node(form)
            controls = []
            for control_index, control in enumerate((item for item in descendants(form) if item.tag in {"input", "select", "textarea"}), 1):
                control_html = serialize_node(control)
                control_marker = f'ALIFY_CONTROL_{control_index:02d}'
                form_html = form_html.replace(control_html, control_marker, 1)
                controls.append({"index": control_index, "html": control_html})
            marker = f'ALIFY_FORM_{j:02d}'
            section_html = section_html.replace(serialize_node(form), marker, 1)
            forms.append({"index": j, "html": form_html, "controls": controls})
        sections.append({
            "index": i,
            "label": section_heading(section, i),
            "class": clean(section.attrs.get("class")),
            "aria_label": clean(section.attrs.get("aria-label")),
            "html": section_html,
            "links": links,
            "images": images,
            "forms": forms,
            "has_form": bool(forms),
        })
    title = next((n.text() for n in root.descendants() if n.tag == "title" and n.text()), source.stem)
    description = next((clean(n.attrs.get("content")) for n in root.descendants() if n.tag == "meta" and (n.attrs.get("name") or "").lower() == "description"), "")
    hero_node = next((n for n in root.descendants() if n.tag == "page-hero"), None)
    hero = {}
    if hero_node:
        for attr in ("eyebrow", "title", "description", "background", "variant"):
            value = clean(hero_node.attrs.get(attr))
            if value:
                hero[attr] = value
    elif source.stem == "index":
        class_fields = {"intro__eyebrow": "eyebrow", "intro__title": "title", "intro__text": "description"}
        for node in root.descendants():
            classes = set((node.attrs.get("class") or "").split())
            for class_name, field_name in class_fields.items():
                if class_name in classes and node.text():
                    hero[field_name] = node.text()
        background = next((n for n in root.descendants() if n.tag == "img" and "assets/images/background/neon-lines-" in (n.attrs.get("src") or "")), None)
        if background:
            hero["background"] = Path(background.attrs.get("src", "")).name
    seo = {"title": title, "description": description}
    return {"title": title, "seo": seo, "hero": hero, "sections": sections}


def main():
    OUTPUT.mkdir(parents=True, exist_ok=True)
    pages = sorted(SOURCE.glob("*.html"))
    for source in pages:
        slug = source.stem
        destination = OUTPUT / f"{slug}.md"
        destination.write_text(field_doc(slug, source), encoding="utf-8")
    acf_data = {source.stem: build_acf_page_data(source) for source in pages}
    (ROOT / "inc" / "acf-page-field-data.json").write_text(json.dumps(acf_data, ensure_ascii=False, indent=2) + "\n", encoding="utf-8")
    index = [
        "# ACF Page Field Inventories",
        "",
        f"Generated from all {len(pages)} bundled source pages in `frontend-source/*.html` by `tools/generate-acf-page-field-docs.py`.",
        "",
        "The companion `inc/acf-page-field-data.json` is the runtime schema used to register the page-specific ACF fields and preserve each source section as its default HTML."
        "",
        "Every singular source page has a page-specific ACF field group registered in PHP. The eight dynamic archive pages have corresponding SEO, hero, and section fields under Theme Settings → Archive Pages. On populated archives, saved static section edits render after live results; bundled article cards are omitted while WordPress drives cards, search, and pagination. Section WYSIWYG editors support formatted text and raw HTML; link URLs and image/alt overrides are separate fields. Forms expose separate copy/label editing while theme-owned control markup and validation stay fixed.",
        "",
        "The source defaults and renderer mappings are generated into `inc/acf-page-field-data.json`. Shared Theme Settings and the generic Flexible Content builder remain defined in `inc/acf.php`. The ACF groups are local PHP registrations; no ACF export plugin or generated database JSON is required.",
        "",
        "## Pages",
        "",
    ]
    for source in pages:
        index.append(f"- [`{source.stem}`]({source.stem}.md)")
    (OUTPUT / "README.md").write_text("\n".join(index) + "\n", encoding="utf-8")
    print(f"Generated {len(pages)} page inventories in {OUTPUT.relative_to(ROOT)}")


if __name__ == "__main__":
    main()
