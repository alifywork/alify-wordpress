# ACF Field Inventory — `case-studies`

Source: [`frontend-source/case-studies.html`](../../frontend-source/case-studies.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Case Studies — Alify |
| `meta_description` | Textarea | Read Alify case studies exploring digital challenges, solutions, and results. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Case studies / Archive |
| `hero_title` | Text | See the thinking behind the experience. |
| `hero_description` | Textarea | Go beyond the visuals and explore how strategy, design, and technology come together to create lasting value. |
| `hero_background` | Select/Image | neon-lines-11.webp |

## Main content fields

### 01. Featured case concept

Section metadata: aria-label: `Featured case concept`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Featured case concept
- `section_01_element_02` — **wysiwyg** (h2): From repetitive coordination to a connected workflow.
- `section_01_element_03` — **textarea** (p): Explore the operational thinking behind the concept—not just the final interface.


Structured card/item fields: 1 source `<article>` item(s), with separate text, link, and image subfields.

### 02. Case study archive

Section metadata: aria-label: `Case study archive`.

Interaction/filter data: `data-filter` = `all`; `data-filter` = `product`; `data-filter` = `brand`; `data-filter` = `growth`; `data-category` = `product`; `data-category` = `product`; `data-category` = `brand`; `data-category` = `growth`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): Case study archive
- `section_02_element_02` — **wysiwyg** (h2): Challenge. Response. Validation.
- `section_02_element_03` — **textarea** (p): Illustrative concept case studies. Each story has its own dedicated destination and propos
- `section_02_element_04` — **text** (button): All
- `section_02_element_05` — **text** (button): Product
- `section_02_element_06` — **text** (button): Brand
- `section_02_element_07` — **text** (button): Growth


Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. How we measure

Section metadata: aria-label: `How we measure`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): How we measure
- `section_03_element_02` — **wysiwyg** (h2): Success defined before the solution.
- `section_03_element_03` — **textarea** (p): A useful case study connects the work to business goals, human behaviour, and learning ove


Repeater `section_03_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
