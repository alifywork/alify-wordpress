# ACF Field Inventory — `projects`

Source: [`frontend-source/projects.html`](../../frontend-source/projects.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Projects — Alify |
| `meta_description` | Textarea | Explore selected digital projects and creative work by Alify. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Projects / Archive |
| `hero_title` | Text | Selected work, shaped by curiosity and craft. |
| `hero_description` | Textarea | Explore a collection of digital experiences created through close collaboration, clear thinking, and careful execution. |
| `hero_background` | Select/Image | neon-lines-07.webp |

## Main content fields

### 01. Featured project

Section metadata: aria-label: `Featured project`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Featured concept · Fintech
- `section_01_element_02` — **wysiwyg** (h2): Complex product. Simple story.
- `section_01_element_03` — **textarea** (p): A product-positioning and website concept exploring how a technical finance platform could
- `section_01_element_04` — **text** (a): View project concept


Link destinations:
- `section_01_link_01_url` — View project concept → `project-single.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_01_image_01_alt` (**Text**): Animated fintech website concept

### 02. Project collection

Section metadata: aria-label: `Project collection`.

Interaction/filter data: `data-filter` = `all`; `data-filter` = `web`; `data-filter` = `brand`; `data-filter` = `product`; `data-filter` = `growth`; `data-category` = `web`; `data-category` = `growth`; `data-category` = `product`; `data-category` = `brand`; `data-category` = `web`; `data-category` = `product`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): Project archive
- `section_02_element_02` — **text** (h2): Explore the work by discipline.
- `section_02_element_03` — **textarea** (p): Illustrative concept projects that show different thinking, not the same abstract image re
- `section_02_element_04` — **text** (button): All
- `section_02_element_05` — **text** (button): Web
- `section_02_element_06` — **text** (button): Brand
- `section_02_element_07` — **text** (button): Product
- `section_02_element_08` — **text** (button): Growth


Repeater `section_02_cards` — 6 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. Project standards

Section metadata: aria-label: `Project standards`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Across every brief
- `section_03_element_02` — **text** (h2): One standard, whatever the deliverable.
- `section_03_element_03` — **textarea** (p): A clear idea, useful experience, and a system that can keep growing.


Repeater `section_03_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
