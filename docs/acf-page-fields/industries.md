# ACF Field Inventory — `industries`

Source: [`frontend-source/industries.html`](../../frontend-source/industries.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Industries — Alify |
| `meta_description` | Textarea | Discover the industries Alify supports with strategy, design, and technology. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Industries / Archive |
| `hero_title` | Text | Digital thinking, shaped around your world. |
| `hero_description` | Textarea | We bring flexible strategy and fresh perspective to industries where meaningful digital experiences make a difference. |
| `hero_background` | Select/Image | neon-lines-09.webp |

## Main content fields

### 01. Industry directory

Section metadata: aria-label: `Industry directory`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Industry experience
- `section_01_element_02` — **wysiwyg** (h2): Different worlds. One thoughtful approach.
- `section_01_element_03` — **textarea** (p): Different audiences, regulations, buying journeys, and business models need different digi


Repeater `section_01_cards` — 5 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 02. Related work

Section metadata: aria-label: `Related work`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): Industry thinking in context
- `section_02_element_02` — **text** (h2): See the thinking applied.
- `section_02_element_03` — **textarea** (p): Three connected concepts showing how strategy, design, and technology work together.
- `section_02_element_04` — **wysiwyg** (a): Web · UI UX Fintech, reimagined
- `section_02_element_05` — **wysiwyg** (a): AI · Service design Automation with purpose
- `section_02_element_06` — **wysiwyg** (a): Commerce · Growth Commerce without friction
- `section_02_element_07` — **textarea** (p): Not sure where to begin?
- `section_02_element_08` — **text** (h2): Start with the decision, not the deliverable.
- `section_02_element_09` — **textarea** (p): Share the outcome you need. We can help identify the right capability, scope, and engageme
- `section_02_element_10` — **text** (a): Compare engagement options


Link destinations:
- `section_02_link_01_url` — Web · UI UX Fintech, reimagined → `project-single.html`
- `section_02_link_02_url` — AI · Service design Automation with purpose → `case-study-single.html`
- `section_02_link_03_url` — Commerce · Growth Commerce without friction → `commerce-project.html`
- `section_02_link_04_url` — Compare engagement options → `pricing.html`

Images/media:
- `section_02_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_02_image_01_alt` (**Text**): Fintech website concept
- `section_02_image_02` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_02_image_02_alt` (**Text**): Automation workflow concept
- `section_02_image_03` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_02_image_03_alt` (**Text**): Commerce growth concept

### 03. Connected capabilities

Section metadata: aria-label: `Connected capabilities`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Across every industry
- `section_03_element_02` — **wysiwyg** (h2): Context changes. The standard does not.
- `section_03_element_03` — **textarea** (p): A consistent approach to strategy, experience, and technology keeps the work useful and co


Repeater `section_03_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Industry approach

Section metadata: aria-label: `Industry approach`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Our approach
- `section_04_element_02` — **text** (h2): Industry insight without inherited assumptions.
- `section_04_element_03` — **textarea** (p): We learn the landscape, find the meaningful difference, and shape the right response aroun


Repeater `section_04_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 05. Industry questions

Section metadata: aria-label: `Industry questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

Structured section fields:
- `section_05_element_01` — **textarea** (p): Industry questions
- `section_05_element_02` — **text** (h2): Planning around your context.
- `section_05_element_03` — **textarea** (p): Search the essentials or filter by topic.
- `section_05_element_04` — **wysiwyg** (label): Search frequently asked questions
- `section_05_element_05` — **text** (button): All
- `section_05_element_06` — **text** (button): Projects
- `section_05_element_07` — **text** (button): Process
- `section_05_element_08` — **text** (button): Support
- `section_05_element_09` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 3 source items (div)
- Faq repeater `section_05_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_faq_01_items.element_01` — **text** (button): Do you only work with the industries listed here?
  - `section_05_faq_01_items.element_02` — **textarea** (p): No. These are examples of where our approach applies. We are happy to discuss adjacent sec
  - `section_05_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
