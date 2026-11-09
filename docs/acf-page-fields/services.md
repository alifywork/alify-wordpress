# ACF Field Inventory — `services`

Source: [`frontend-source/services.html`](../../frontend-source/services.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Services — Alify |
| `meta_description` | Textarea | Explore Alify services across strategy, branding, web design, and development. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Services / Archive |
| `hero_title` | Text | Expertise for every stage of your digital journey. |
| `hero_description` | Textarea | From strategy and identity to design and development, our services bring clarity and momentum to ambitious ideas. |
| `hero_background` | Select/Image | neon-lines-05.webp |

## Main content fields

### 01. Service capabilities

Section metadata: aria-label: `Service capabilities`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Capabilities
- `section_01_element_02` — **text** (h2): Six disciplines. One connected studio.
- `section_01_element_03` — **textarea** (p): Choose a focused capability or bring us the whole brief. Each service has its own detailed


Repeater `section_01_cards` — 6 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 02. Engagement models

Section metadata: aria-label: `Engagement models`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): Ways to work together
- `section_02_element_02` — **text** (h2): An engagement that fits the challenge.
- `section_02_element_03` — **textarea** (p): A clear project, ongoing support, or additional expertise inside your team.


Repeater `section_02_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. Service process

Section metadata: aria-label: `Service process`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Our process
- `section_03_element_02` — **text** (h2): Clarity from first conversation to final release.
- `section_03_element_03` — **textarea** (p): Visible stages, focused feedback, and no unnecessary agency theatre.


Repeater `section_03_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Related work

Section metadata: aria-label: `Related work`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Capabilities in context
- `section_04_element_02` — **text** (h2): See the thinking applied.
- `section_04_element_03` — **textarea** (p): Three connected concepts showing how strategy, design, and technology work together.
- `section_04_element_04` — **wysiwyg** (a): Web · UI UX Fintech, reimagined
- `section_04_element_05` — **wysiwyg** (a): AI · Service design Automation with purpose
- `section_04_element_06` — **wysiwyg** (a): Commerce · Growth Commerce without friction
- `section_04_element_07` — **textarea** (p): Not sure where to begin?
- `section_04_element_08` — **text** (h2): Start with the decision, not the deliverable.
- `section_04_element_09` — **textarea** (p): Share the outcome you need. We can help identify the right capability, scope, and engageme
- `section_04_element_10` — **text** (a): Compare engagement options


Link destinations:
- `section_04_link_01_url` — Web · UI UX Fintech, reimagined → `project-single.html`
- `section_04_link_02_url` — AI · Service design Automation with purpose → `case-study-single.html`
- `section_04_link_03_url` — Commerce · Growth Commerce without friction → `commerce-project.html`
- `section_04_link_04_url` — Compare engagement options → `pricing.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_04_image_01_alt` (**Text**): Fintech website concept
- `section_04_image_02` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_04_image_02_alt` (**Text**): Automation workflow concept
- `section_04_image_03` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_04_image_03_alt` (**Text**): Commerce growth concept

### 05. Tools and technology

Section metadata: aria-label: `Tools and technology`.

Structured section fields:
- `section_05_element_01` — **textarea** (p): Tools and technology
- `section_05_element_02` — **text** (h2): The right tool for the job.


List group 01: 13 source items (li)
- List repeater `section_05_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_list_01_items.element_01` — **textarea** (li): HTML5

### 06. Service FAQs

Section metadata: aria-label: `Service FAQs`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`; `data-category` = `projects`.

Structured section fields:
- `section_06_element_01` — **textarea** (p): Service questions
- `section_06_element_02` — **text** (h2): A few useful answers.
- `section_06_element_03` — **textarea** (p): Search or filter the essentials before starting a conversation.
- `section_06_element_04` — **wysiwyg** (label): Search frequently asked questions
- `section_06_element_05` — **text** (button): All
- `section_06_element_06` — **text** (button): Projects
- `section_06_element_07` — **text** (button): Process
- `section_06_element_08` — **text** (button): Support
- `section_06_element_09` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 4 source items (div)
- Faq repeater `section_06_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_06_faq_01_items.element_01` — **text** (button): Can we combine multiple services in one project?
  - `section_06_faq_01_items.element_02` — **textarea** (p): Yes. Many projects bring strategy, design, development, and growth together in one joined-
  - `section_06_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
