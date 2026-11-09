# ACF Field Inventory — `service-single`

Source: [`frontend-source/service-single.html`](../../frontend-source/service-single.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Web Development — Alify |
| `meta_description` | Textarea | Strategy, responsive design, clean development, and dependable technical foundations for modern websites. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Services / Web Development |
| `hero_title` | Text | Fast, scalable experiences built around your users. |
| `hero_description` | Textarea | Strategy, responsive design, clean development, and dependable technical foundations for modern websites. |
| `hero_background` | Select/Image | neon-lines-01.webp |

## Main content fields

### 01. Service overview

Section metadata: aria-label: `Service overview`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Web Development
- `section_01_element_02` — **text** (h2): Websites designed to perform today and scale tomorrow.
- `section_01_element_03` — **textarea** (p): From marketing sites to content-managed platforms, we connect clear storytelling with resp
- `section_01_element_04` — **text** (strong): Clearer journeys
- `section_01_element_05` — **text** (span): Content and conversion paths shaped around real user needs.
- `section_01_element_06` — **text** (strong): Responsive by default
- `section_01_element_07` — **text** (span): Careful layouts across mobile, tablet, laptop, and wide screens.
- `section_01_element_08` — **text** (strong): Maintainable foundation
- `section_01_element_09` — **text** (span): Reusable components and practical technology choices.


Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_01_image_01_alt` (**Text**): Animated Web Development service scene

### 02. Service deliverables

Section metadata: aria-label: `Service deliverables`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): What this can include
- `section_02_element_02` — **text** (h2): Deliverables shaped around the outcome.
- `section_02_element_03` — **textarea** (p): A focused scope can include some or all of these, depending on your current needs.


Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. Service process

Section metadata: aria-label: `Service process`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): A shared process
- `section_03_element_02` — **text** (h2): Clear from discovery to delivery.
- `section_03_element_03` — **textarea** (p): The work stays visible, collaborative, and connected to the original goal.


Repeater `section_03_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Related services

Section metadata: aria-label: `Related services`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Continue exploring
- `section_04_element_02` — **text** (h2): Related capabilities.
- `section_04_element_03` — **textarea** (p): Connected services can be combined into one joined-up engagement.
- `section_04_element_04` — **text** (a): SEO
- `section_04_element_05` — **text** (a): Digital Marketing
- `section_04_element_06` — **text** (a): AI Automation


Link destinations:
- `section_04_link_01_url` — SEO → `seo.html`
- `section_04_link_02_url` — Digital Marketing → `digital-marketing.html`
- `section_04_link_03_url` — AI Automation → `ai-automation.html`

### 05. Service FAQs

Section metadata: aria-label: `Service FAQs`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

Structured section fields:
- `section_05_element_01` — **textarea** (p): Service questions
- `section_05_element_02` — **text** (h2): Before we define your scope.
- `section_05_element_03` — **textarea** (p): Search or filter the essentials, then bring us the context specific to your challenge.
- `section_05_element_04` — **wysiwyg** (label): Search frequently asked questions
- `section_05_element_05` — **text** (button): All
- `section_05_element_06` — **text** (button): Projects
- `section_05_element_07` — **text** (button): Process
- `section_05_element_08` — **text** (button): Support
- `section_05_element_09` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 3 source items (div)
- Faq repeater `section_05_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_faq_01_items.element_01` — **text** (button): Can you rebuild an existing website?
  - `section_05_faq_01_items.element_02` — **textarea** (p): Yes. We first assess what should be retained, improved, or rebuilt so the investment targe
  - `section_05_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
