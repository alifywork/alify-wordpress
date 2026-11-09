# ACF Field Inventory — `useful-automation`

Source: [`frontend-source/useful-automation.html`](../../frontend-source/useful-automation.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Where automation creates useful space. — ALIFY Journal |
| `meta_description` | Textarea | How to find repetitive workflows worth improving without removing necessary human judgement. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / AI automation |
| `hero_title` | Text | Where automation creates useful space. |
| `hero_description` | Textarea | How to find repetitive workflows worth improving without removing necessary human judgement. |
| `hero_background` | Select/Image | neon-lines-07.webp |
| `hero_variant` | Select | soft-focus |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

- `section_01_link_label_01` — **Link Label** (HTML `a`): Back to the journal
- `section_01_copy_01` — **Copy** (HTML `p`): The best automation opportunity is not always the most impressive workflow. It is often the repetitive coordination that prevents a capable team from spending time on more valuable work.
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): AI automation
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 5 min read
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): By ALIFY Automation Team
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): 27 October 2026

Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_01_image_01_alt` (**Text**): Animated AI automation article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

- `section_02_copy_01` — **Copy** (HTML `p`): On this page
- `section_02_link_label_01` — **Link Label** (HTML `a`): 01 Look for repeated coordination
- `section_02_link_label_02` — **Link Label** (HTML `a`): 02 Separate rules from judgement
- `section_02_link_label_03` — **Link Label** (HTML `a`): 03 Prototype the smallest complete workflow
- `section_02_link_label_04` — **Link Label** (HTML `a`): 04 Measure time and quality together
- `section_02_link_label_05` — **Link Label** (HTML `a`): Discuss your project
- `section_02_heading_01` — **Heading** (HTML `h2`): Look for repeated coordination
- `section_02_copy_02` — **Copy** (HTML `p`): Document the handoffs, copying, reminders, classification, and status checks that happen every day. These tasks often consume more collective attention than teams realise.
- `section_02_copy_03` — **Copy** (HTML `p`): Map the trigger, the information involved, the decision, and the desired output before discussing tools.
- `section_02_heading_02` — **Heading** (HTML `h2`): Separate rules from judgement
- `section_02_copy_04` — **Copy** (HTML `p`): Stable, repeatable rules are strong automation candidates. Ambiguous decisions, sensitive communication, and exceptions may need a person to remain responsible.
- `section_02_copy_05` — **Copy** (HTML `p`): A useful workflow makes that boundary explicit rather than treating human oversight as an afterthought.
- `section_02_caption_01` — **Caption** (HTML `figcaption`): Visual framework A human-reviewed automation flow
- `section_02_list_item_01` — **List Item** (HTML `li`): Structured trigger
- `section_02_list_item_02` — **List Item** (HTML `li`): Assisted classification
- `section_02_list_item_03` — **List Item** (HTML `li`): Human review
- `section_02_list_item_04` — **List Item** (HTML `li`): Visible action
- `section_02_copy_06` — **Copy** (HTML `p`): Exceptions and accountability remain explicit throughout the workflow.
- `section_02_heading_03` — **Heading** (HTML `h2`): Prototype the smallest complete workflow
- `section_02_copy_07` — **Copy** (HTML `p`): Test one real route from trigger to outcome. Include error states, missing information, ownership, and a visible record of what happened.
- `section_02_copy_08` — **Copy** (HTML `p`): A narrow prototype exposes operational reality faster than a broad demonstration built around ideal data.
- `section_02_heading_04` — **Heading** (HTML `h2`): Measure time and quality together
- `section_02_copy_09` — **Copy** (HTML `p`): Time saved matters, but so do accuracy, visibility, response speed, and the effort required to maintain the workflow.
- `section_02_copy_10` — **Copy** (HTML `p`): The goal is useful space for better work, not automation volume for its own sake.
- `section_02_quote_01` — **Quote** (HTML `blockquote`): “Automate the repeatable coordination; keep responsibility and judgement clearly human.”
- `section_02_copy_11` — **Copy** (HTML `p`): Key takeaways
- `section_02_heading_05` — **Heading** (HTML `h2`): Keep these four points.
- `section_02_list_item_05` — **List Item** (HTML `li`): Start with repetitive coordination, not a tool.
- `section_02_list_item_06` — **List Item** (HTML `li`): Keep judgement and accountability visible.
- `section_02_list_item_07` — **List Item** (HTML `li`): Prototype one complete workflow with exceptions.
- `section_02_list_item_08` — **List Item** (HTML `li`): Measure quality alongside time saved.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Link destinations:
- `section_02_link_01_url` — 01 Look for repeated coordination → `#article-point-1`
- `section_02_link_02_url` — 02 Separate rules from judgement → `#article-point-2`
- `section_02_link_03_url` — 03 Prototype the smallest complete workflow → `#article-point-3`
- `section_02_link_04_url` — 04 Measure time and quality together → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

- `section_03_link_label_01` — **Link Label** (HTML `a`): Previous article A practical guide to planning a website that can grow.
- `section_03_link_label_02` — **Link Label** (HTML `a`): Next article Technical SEO is experience design too.

Link destinations:
- `section_03_link_01_url` — Previous article A practical guide to planning a website that can grow. → `planning-scalable-website.html`
- `section_03_link_02_url` — Next article Technical SEO is experience design too. → `technical-seo-experience.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

- `section_04_copy_01` — **Copy** (HTML `p`): Continue reading
- `section_04_heading_01` — **Heading** (HTML `h2`): Related perspectives.
- `section_04_copy_02` — **Copy** (HTML `p`): Explore another connected discipline.
- `section_04_link_label_01` — **Link Label** (HTML `a`): Web development A practical guide to planning a website that can grow. Read next
- `section_04_link_label_02` — **Link Label** (HTML `a`): SEO Technical SEO is experience design too. Read next

Link destinations:
- `section_04_link_01_url` — Web development A practical guide to planning a website that can grow. Read next → `planning-scalable-website.html`
- `section_04_link_02_url` — SEO Technical SEO is experience design too. Read next → `technical-seo-experience.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/seo.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
