# ACF Field Inventory — `blog`

Source: [`frontend-source/blog.html`](../../frontend-source/blog.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Journal — Alify |
| `meta_description` | Textarea | Practical ALIFY perspectives on digital strategy, design, technology, and growth. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Ideas and perspectives |
| `hero_title` | Text | Think clearly. Build thoughtfully. |
| `hero_description` | Textarea | Notes and practical perspectives from the intersection of strategy, design, technology, and growth. |
| `hero_background` | Select/Image | neon-lines-04.webp |

## Main content fields

### 01. Featured article

Section metadata: aria-label: `Featured article`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): The ALIFY journal
- `section_01_element_02` — **wysiwyg** (h2): Useful ideas for building better digital.
- `section_01_element_03` — **textarea** (p): Practical notes on strategy, design, technology, and growth—written to help you make clear


Structured card/item fields: 1 source `<article>` item(s), with separate text, link, and image subfields.

### 02. Latest articles

Section metadata: aria-label: `Latest articles`.

Interaction/filter data: `data-filter` = `all`; `data-filter` = `strategy`; `data-filter` = `technology`; `data-filter` = `growth`; `data-category` = `technology`; `data-category` = `technology`; `data-category` = `growth`; `data-category` = `growth`; `data-category` = `strategy`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): Browse the journal
- `section_02_element_02` — **text** (h2): Explore by discipline.
- `section_02_element_03` — **textarea** (p): Filter the collection by the kind of challenge you are thinking about.
- `section_02_element_04` — **wysiwyg** (label): Search articles
- `section_02_element_05` — **text** (button): All articles
- `section_02_element_06` — **text** (button): Strategy
- `section_02_element_07` — **text** (button): Technology
- `section_02_element_08` — **text** (button): Growth
- `section_02_element_09` — **textarea** (p): No matching articles found. Try another search or discipline.


Repeater `section_02_cards` — 5 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. Editorial principles

Section metadata: aria-label: `Editorial principles`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Our editorial approach
- `section_03_element_02` — **wysiwyg** (h2): Less noise. More useful thinking.


Repeater `section_03_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Discuss your project

Section metadata: aria-label: `Discuss your project`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Bring us the real challenge
- `section_04_element_02` — **text** (h2): Turn the thinking into a useful next step.
- `section_04_element_03` — **textarea** (p): If an article connects with a problem you are facing, we can help you apply the thinking t
- `section_04_element_04` — **text** (a): Start a conversation


Link destinations:
- `section_04_link_01_url` — Start a conversation → `contact.html`

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
