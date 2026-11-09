#!/usr/bin/env python3
"""Generate structured field data and page-by-page ACF inventories from source HTML.

The JSON inventory is consumed by the theme's local ACF registration; Markdown
files document the resulting page/template fields. Re-run after source markup changes.
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


def inside_tag(node: Node, boundary: Node, tag: str) -> bool:
    parent = node.parent
    while parent and parent is not boundary:
        if parent.tag == tag:
            return True
        parent = parent.parent
    return False


def inside_node_ids(node: Node, boundary: Node, node_ids: set[int]) -> bool:
    parent = node.parent
    while parent and parent is not boundary:
        if id(parent) in node_ids:
            return True
        parent = parent.parent
    return False


def structured_elements(boundary: Node, exclude_articles: bool, exclude_nodes: set[int] | None = None) -> list[dict]:
    candidates = BLOCK_TEXT | INLINE_TEXT
    excluded_ids = exclude_nodes or set()
    selected = []
    for node in descendants(boundary):
        if node.tag not in candidates or not node.text() or inside_form(node, boundary):
            continue
        if exclude_articles and inside_tag(node, boundary, "article"):
            continue
        if id(node) in excluded_ids or any(id(parent) in excluded_ids for parent in ancestors_until(node, boundary)):
            continue
        parent = node.parent
        nested = False
        while parent and parent is not boundary:
            if parent.tag in candidates:
                nested = True
                break
            parent = parent.parent
        if not nested:
            selected.append(node)
    indices = {}
    result = []
    for node in selected:
        indices[node.tag] = indices.get(node.tag, 0) + 1
        content_children = []
        for child in node.children:
            if isinstance(child, Node) and child.tag in {"i", "svg"}:
                classes = clean(child.attrs.get("class")).split()
                if child.attrs.get("aria-hidden") == "true" or any(token.startswith(("fa-", "icon-")) for token in classes):
                    continue
            content_children.append(child)
        inner = "".join(serialize_node(child) for child in content_children)
        rich = any(isinstance(child, Node) for child in content_children)
        editor = "wysiwyg" if rich else ("textarea" if node.tag in {"p", "li", "blockquote", "figcaption", "td", "dd"} else "text")
        default = inner if rich else node.text()
        result.append({"index": len(result) + 1, "tag": node.tag, "tag_index": indices[node.tag], "type": editor, "default": default, "label": node.text()[:90]})
    return result


REPEATED_CLASS_HINTS = (
    "faq", "testimonial", "step", "card", "feature", "benefit", "service", "project",
    "process", "quote", "review", "pricing", "reason", "principle", "team", "client",
    "logo", "stat", "industry", "tool", "result", "award", "case", "solution", "item",
)


def semantic_class_token(class_value: str | None) -> str:
    tokens = clean(class_value).split()
    return next((token for token in tokens if any(hint in token.lower() for hint in REPEATED_CLASS_HINTS)), "")


def item_template(item: Node) -> dict:
    elements = structured_elements(item, False)
    if not elements:
        elements = [{"index": 1, "tag": item.tag, "tag_index": 1, "type": "textarea", "default": node_inner_html(item), "label": item.text()}]
    links = [{"index": j, "href": clean(link.attrs.get("href")), "label": link.text()} for j, link in enumerate((node for node in descendants(item, "a") if not inside_form(node, item)), 1)]
    images = [{"index": j, "src": clean(image.attrs.get("src")), "alt": clean(image.attrs.get("alt"))} for j, image in enumerate((node for node in descendants(item, "img") if not inside_form(node, item)), 1)]
    attributes = {key: clean(item.attrs.get(key)) for key in ("data-category", "data-filter") if item.attrs.get(key) is not None}
    return {"html": serialize_node(item), "elements": elements, "links": links, "images": images, "attributes": attributes}


def item_signature(items: list[dict]) -> list[tuple]:
    return [(tuple((e["tag"], e["type"]) for e in item["elements"]), len(item["links"]), len(item["images"]), tuple(sorted(item.get("attributes", {}).keys()))) for item in items]


def repeated_list_groups(boundary: Node, exclude_articles: bool = True) -> list[dict]:
    groups = []
    tag_indices = {"ul": 0, "ol": 0}
    candidates = descendants(boundary)
    for container in candidates:
        if container.tag not in tag_indices:
            continue
        if inside_form(container, boundary) or (exclude_articles and inside_tag(container, boundary, "article")) or inside_tag(container, boundary, "li"):
            continue
        tag_indices[container.tag] += 1
        items = [child for child in container.children if isinstance(child, Node) and child.tag == "li"]
        if len(items) < 2:
            continue
        if any(descendants(item, "form") for item in items):
            continue
        templates = [item_template(item) for item in items]
        signatures = item_signature(templates)
        if len(set(signatures)) != 1:
            continue
        group_index = len(groups) + 1
        groups.append({
            "index": group_index, "kind": "list", "field_name": f"list_{group_index:02d}_items",
            "label": "List", "tag": container.tag, "tag_index": tag_indices[container.tag],
            "container_tag": container.tag, "container_class": "", "container_index": tag_indices[container.tag],
            "item_tag": "li", "item_class": "", "html": serialize_node(container), "items": templates,
            "repeatable": True, "_exclude_ids": [id(item) for item in items],
        })

    # Some designs (notably FAQs) repeat styled DIV cards rather than articles or list items.
    for container in candidates:
        if container.tag in {"ul", "ol", "form", "article"} or inside_form(container, boundary):
            continue
        if exclude_articles and inside_tag(container, boundary, "article"):
            continue
        container_hint = semantic_class_token(container.attrs.get("class"))
        if not container_hint:
            continue
        by_shape: dict[tuple[str, str], list[Node]] = {}
        for child in container.children:
            if not isinstance(child, Node) or child.tag in {"form", "article"}:
                continue
            if exclude_articles and inside_tag(child, boundary, "article"):
                continue
            item_hint = semantic_class_token(child.attrs.get("class"))
            if item_hint or child.tag in {"figure", "blockquote"}:
                by_shape.setdefault((child.tag, item_hint), []).append(child)
        for (item_tag, item_class), items in by_shape.items():
            if len(items) < 2:
                continue
            if any(descendants(item, "form") for item in items):
                continue
            templates = [item_template(item) for item in items]
            if len(set(item_signature(templates))) != 1:
                continue
            kind = next((hint for hint in REPEATED_CLASS_HINTS if hint in (item_class or container_hint).lower()), "item")
            group_index = len(groups) + 1
            # Use a class-token occurrence so the PHP renderer can target this exact wrapper.
            matching_containers = [node for node in candidates if node.tag == container.tag and container_hint in clean(node.attrs.get("class")).split() and not inside_form(node, boundary) and not (exclude_articles and inside_tag(node, boundary, "article"))]
            container_index = matching_containers.index(container) + 1
            groups.append({
                "index": group_index, "kind": kind, "field_name": f"{kind}_{group_index:02d}_items",
                "label": kind.replace("_", " ").title(), "tag": container.tag, "tag_index": 0,
                "container_tag": container.tag, "container_class": container_hint, "container_index": container_index,
                "item_tag": item_tag, "item_class": item_class, "html": serialize_node(container), "items": templates,
                "repeatable": True, "_exclude_ids": [id(item) for item in items],
            })
    groups.sort(key=lambda group: (group["tag_index"] if group["tag_index"] else 10**9, group["index"]))
    # Field suffixes follow the final visual order in the section.
    for index, group in enumerate(groups, 1):
        group["index"] = index
        group["field_name"] = f"{group['kind']}_{index:02d}_items"
    return groups


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
    return value.replace("\\", "\\\\").replace("`", "\\`").replace("|", "\\|").replace("\n", " ").strip()


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
        ("> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination." if slug in ARCHIVE_SLUGS else "> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields."),
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

        list_groups = repeated_list_groups(section, True)
        excluded_ids = {node_id for group in list_groups for node_id in group["_exclude_ids"]}
        elements = structured_elements(section, True, excluded_ids)
        if elements:
            lines.append("Structured section fields:")
            for element in elements:
                name = f"{section_name}_element_{element['index']:02d}"
                lines.append(f"- `{name}` — **{element['type']}** ({element['tag']}): {esc(element['label'])}")
            lines.append("")

        links = [node for node in descendants(section, "a") if not inside_form(node, section) and not inside_tag(node, section, "article") and not inside_node_ids(node, section, excluded_ids)]
        if links:
            lines.append("")
            lines.append("Link destinations:")
            for i, link in enumerate(links, 1):
                label = link.text() or clean(link.attrs.get("aria-label")) or "[image/icon-only link]"
                url = clean(link.attrs.get("href")) or "[no href in source]"
                lines.append(f"- `{section_name}_link_{i:02d}_url` — {esc(label)} → `{esc(url)}`")

        images = [node for node in descendants(section, "img") if not inside_form(node, section) and not inside_tag(node, section, "article") and not inside_node_ids(node, section, excluded_ids)]
        if images:
            lines.append("")
            lines.append("Images/media:")
            for i, image in enumerate(images, 1):
                lines.append(f"- `{section_name}_image_{i:02d}` (**Image**): `{esc(clean(image.attrs.get('src')) or '[no src]')}`")
                lines.append(f"  - `{section_name}_image_{i:02d}_alt` (**Text**): {esc(clean(image.attrs.get('alt')) or '[empty alt — decorative or alt text needed]')}")

        forms = descendants(section, "form")
        for form_index, form in enumerate(forms, 1):
            lines += ["", f"Form `{section_name}_form_{form_index:02d}` — individual fields for labels/copy plus protected theme controls:"]
            for element in structured_elements(form, False):
                lines.append(f"- `{section_name}_form_{form_index:02d}_element_{element['index']:02d}` — **{element['type']}** ({element['tag']}): {esc(element['label'])}")
            lines.append("- Form controls, choices, validation, and submission behavior remain theme-managed.")
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

        cards = [node for node in descendants(section, "article") if not inside_tag(node, section, "article")]
        if cards:
            repeatable = all(
                (tuple((item["tag"], item["type"]) for item in structured_elements(card, False)), len([n for n in descendants(card, "a") if not inside_form(n, card)]), len([n for n in descendants(card, "img") if not inside_form(n, card)]))
                == (tuple((item["tag"], item["type"]) for item in structured_elements(cards[0], False)), len([n for n in descendants(cards[0], "a") if not inside_form(n, cards[0])]), len([n for n in descendants(cards[0], "img") if not inside_form(n, cards[0])]))
                for card in cards
            ) and not any(descendants(card, "form") for card in cards)
            if len(cards) > 1 and repeatable:
                lines += ["", f"Repeater `{section_name}_cards` — {len(cards)} starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF."]
            else:
                lines += ["", f"Structured card/item fields: {len(cards)} source `<article>` item(s), with separate text, link, and image subfields."]
        for group_index, group in enumerate(list_groups, 1):
            lines += ["", f"{group['label']} group {group_index:02d}: {len(group['items'])} source items ({group['item_tag']})"]
            signatures = [
                (tuple((element["tag"], element["type"]) for element in item["elements"]), len(item["links"]), len(item["images"]))
                for item in group["items"]
            ]
            if len(group["items"]) > 1 and len(set(signatures)) == 1:
                base = f"{section_name}_{group['field_name']}"
                lines.append(f"- {group['label']} repeater `{base}` — add, remove, or reorder rows while the theme retains the source layout.")
                for element in group["items"][0]["elements"]:
                    lines.append(f"  - `{base}.element_{element['index']:02d}` — **{element['type']}** ({element['tag']}): {esc(element['label'])}")
                for link in group["items"][0]["links"]:
                    lines.append(f"  - `{base}.link_{link['index']:02d}_url` — URL for {esc(link['label'] or 'list-item link')}")
                for image in group["items"][0]["images"]:
                    lines.append(f"  - `{base}.image_{image['index']:02d}` and `{base}.image_{image['index']:02d}_alt` — image and alternative text")
                for attribute in group["items"][0].get("attributes", {}):
                    field_name = "attribute_" + attribute.replace("-", "_")
                    lines.append(f"  - `{base}.{field_name}` — editable item filter/category value")
            else:
                lines.append("- Fixed structured list-item fields retain the source list shape.")
        lines.append("")

    lines += [
        "## Shared implementation notes",
        "",
        "- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.",
        "- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.",
        "- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.",
        "- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.",

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
        list_groups = repeated_list_groups(section, True)
        excluded_ids = {node_id for group in list_groups for node_id in group["_exclude_ids"]}
        links = []
        section_links = (node for node in descendants(section, "a") if not inside_form(node, section) and not inside_tag(node, section, "article") and not inside_node_ids(node, section, excluded_ids))
        for j, link in enumerate(section_links, 1):
            href = clean(link.attrs.get("href"))
            if href:
                links.append({"index": j, "label": link.text() or clean(link.attrs.get("aria-label")), "href": href})
        images = []
        section_images = (node for node in descendants(section, "img") if not inside_form(node, section) and not inside_tag(node, section, "article") and not inside_node_ids(node, section, excluded_ids))
        for j, image in enumerate(section_images, 1):
            images.append({"index": j, "src": clean(image.attrs.get("src")), "alt": clean(image.attrs.get("alt"))})
        cards = []
        articles = [node for node in descendants(section, "article") if not inside_tag(node, section, "article")]
        for card_index, card in enumerate(articles, 1):
            card_links = [{"index": j, "href": clean(link.attrs.get("href")), "label": link.text()} for j, link in enumerate((node for node in descendants(card, "a") if not inside_form(node, card)), 1)]
            card_images = [{"index": j, "src": clean(image.attrs.get("src")), "alt": clean(image.attrs.get("alt"))} for j, image in enumerate((node for node in descendants(card, "img") if not inside_form(node, card)), 1)]
            cards.append({"index": card_index, "html": serialize_node(card), "elements": structured_elements(card, False), "links": card_links, "images": card_images})
        signatures = [
            (tuple((element["tag"], element["type"]) for element in card["elements"]), len(card["links"]), len(card["images"]))
            for card in cards
        ]
        cards_repeatable = len(cards) > 1 and len(set(signatures)) == 1 and not any(descendants(card, "form") for card in articles)
        section_elements = structured_elements(section, True, excluded_ids)
        for group in list_groups:
            group.pop("_exclude_ids", None)
            group_signatures = [
                (tuple((element["tag"], element["type"]) for element in item["elements"]), len(item["links"]), len(item["images"]))
                for item in group["items"]
            ]
            group["repeatable"] = len(group["items"]) > 1 and len(set(group_signatures)) == 1
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
            forms.append({"index": j, "html": form_html, "elements": structured_elements(form, False), "controls": controls})
        sections.append({
            "index": i,
            "label": section_heading(section, i),
            "class": clean(section.attrs.get("class")),
            "aria_label": clean(section.attrs.get("aria-label")),
            "html": section_html,
            "elements": section_elements,
            "links": links,
            "images": images,
            "cards": cards,
            "cards_repeatable": cards_repeatable,
            "list_groups": list_groups,
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
        "Every singular source page has a page-specific ACF field group registered in PHP. Its fields follow that page's actual sections, with separate headings, copy, CTA/link destinations, and images/alt text. Repeated cards, FAQs, and homogeneous lists use per-item ACF Repeaters where the source template repeats. The same source single layouts and fields are available on Blog Posts, Services, Work, Case Studies, and Industries unless a record has a more specific source mapping. Source-managed pages hide the generic Flexible Content builder and standard content editor; the generic fallback appears only when no source-template group matches. Template wrappers and layout remain theme-controlled. The eight dynamic archive pages have corresponding SEO, hero, and section fields under Theme Settings → Archive Pages. On populated archives, saved static section edits render after live results; bundled article cards are omitted while WordPress drives cards, search, and pagination. Forms expose separate copy/label editing while theme-owned control markup and validation stay fixed. ACF Pro is required for the Repeater and options-page features.",
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
