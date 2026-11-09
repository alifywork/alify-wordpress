# ACF Field Inventory — `digital-marketing`

Source: [`frontend-source/digital-marketing.html`](../../frontend-source/digital-marketing.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Digital Marketing — Alify |
| `meta_description` | Textarea | Connected campaign strategy, creative direction, landing experiences, and ongoing optimisation. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Services / Digital Marketing |
| `hero_title` | Text | Campaigns with creative momentum and clear purpose. |
| `hero_description` | Textarea | Connected campaign strategy, creative direction, landing experiences, and ongoing optimisation. |
| `hero_background` | Select/Image | neon-lines-03.webp |

## Main content fields

### 01. Service overview

Section metadata: aria-label: `Service overview`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Digital Marketing
- `section_01_element_02` — **text** (h2): Campaigns that connect the idea, the channel, and the outcome.
- `section_01_element_03` — **textarea** (p): We bring audience insight, campaign thinking, creative execution, and measurement together
- `section_01_element_04` — **text** (strong): Stronger campaign ideas
- `section_01_element_05` — **text** (span): A central thought that travels coherently across channels.
- `section_01_element_06` — **text** (strong): Connected journeys
- `section_01_element_07` — **text** (span): Ads, content, landing pages, and follow-up designed together.
- `section_01_element_08` — **text** (strong): Iteration with purpose
- `section_01_element_09` — **text** (span): Performance signals used to refine creative and experience.


Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_01_image_01_alt` (**Text**): Animated Digital Marketing service scene

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

### 04. Service in practice

Section metadata: aria-label: `Service in practice`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Practical artefact
- `section_04_element_02` — **text** (h3): One campaign journey, end to end.
- `section_04_element_03` — **text** (a): Explore the commerce growth concept
- `section_04_element_04` — **textarea** (p): What the work includes
- `section_04_element_05` — **text** (h2): Creative, landing content, and measurement are planned around the same audience decision r
- `section_04_element_06` — **text** (dt): Timeline
- `section_04_element_07` — **textarea** (dd): Defined around scope and dependencies
- `section_04_element_08` — **text** (dt): Engagement
- `section_04_element_09` — **textarea** (dd): Focused project or connected partnership
- `section_04_element_10` — **text** (dt): First input
- `section_04_element_11` — **textarea** (dd): Your goal, audience, constraints, and current context


Link destinations:
- `section_04_link_01_url` — Explore the commerce growth concept → `commerce-project.html`

List group 01: 4 source items (li)
- List repeater `section_04_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_04_list_01_items.element_01` — **textarea** (li): Audience

List group 02: 3 source items (li)
- List repeater `section_04_list_02_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_04_list_02_items.element_01` — **textarea** (li): Audience moment and campaign promise

### 05. Related services

Section metadata: aria-label: `Related services`.

Structured section fields:
- `section_05_element_01` — **textarea** (p): Continue exploring
- `section_05_element_02` — **text** (h2): Related capabilities.
- `section_05_element_03` — **textarea** (p): Connected services can be combined into one joined-up engagement.
- `section_05_element_04` — **text** (a): AI Automation
- `section_05_element_05` — **text** (a): UI UX Design
- `section_05_element_06` — **text** (a): Logo Design


Link destinations:
- `section_05_link_01_url` — AI Automation → `ai-automation.html`
- `section_05_link_02_url` — UI UX Design → `ui-ux-design.html`
- `section_05_link_03_url` — Logo Design → `logo-design.html`

### 06. Service FAQs

Section metadata: aria-label: `Service FAQs`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

Structured section fields:
- `section_06_element_01` — **textarea** (p): Service questions
- `section_06_element_02` — **text** (h2): Before we define your scope.
- `section_06_element_03` — **textarea** (p): Search or filter the essentials, then bring us the context specific to your challenge.
- `section_06_element_04` — **wysiwyg** (label): Search frequently asked questions
- `section_06_element_05` — **text** (button): All
- `section_06_element_06` — **text** (button): Projects
- `section_06_element_07` — **text** (button): Process
- `section_06_element_08` — **text** (button): Support
- `section_06_element_09` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 3 source items (div)
- Faq repeater `section_06_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_06_faq_01_items.element_01` — **text** (button): Can you work with our existing ad accounts?
  - `section_06_faq_01_items.element_02` — **textarea** (p): Yes, subject to access and review. We first understand current setup, data quality, and pa
  - `section_06_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
