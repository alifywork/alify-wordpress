# ACF Field Inventory — `startups`

Source: [`frontend-source/startups.html`](../../frontend-source/startups.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Startups — Alify |
| `meta_description` | Textarea | Explore Alify’s tailored digital approach for your industry. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Industries / Startups |
| `hero_title` | Text | Give the next big idea a clear first impression. |
| `hero_description` | Textarea | Positioning, identity, and digital foundations that help early-stage teams launch with clarity and learn quickly. |
| `hero_background` | Select/Image | neon-lines-14.webp |

## Main content fields

### 01. Startups overview

Section metadata: aria-label: `Startups overview`; id: `startups`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Startups
- `section_01_element_02` — **text** (h2): Move from idea to credible launch.
- `section_01_element_03` — **textarea** (p): Early-stage teams need focus: a clear proposition, a distinctive presence, and a flexible
- `section_01_element_04` — **text** (a): Discuss your brief


Link destinations:
- `section_01_link_01_url` — Discuss your brief → `start-project.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/industries/startups-ventures.jpg`
  - `section_01_image_01_alt` (**Text**): Natural Startups working environment

### 02. Industry challenge

Section metadata: aria-label: `Industry challenge`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): The context
- `section_02_element_02` — **text** (h2): The idea is moving fast. The story needs to keep up.
- `section_02_element_03` — **textarea** (p): Early-stage teams must explain a changing proposition, build credibility, and prioritise i


List group 01: 3 source items (li)
- List repeater `section_02_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_01_items.element_01` — **textarea** (li): A focused proposition people can repeat

### 03. Where we can help

Section metadata: aria-label: `Where we can help`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Where we can help
- `section_03_element_02` — **wysiwyg** (h2): Connected capabilities. One clear direction.
- `section_03_element_03` — **textarea** (p): A focused engagement or a connected team across strategy, design, content, and technology.


Repeater `section_03_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Industry in practice

Section metadata: aria-label: `Industry in practice`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Practical artefact
- `section_04_element_02` — **text** (h3): From a moving idea to a focused first release.
- `section_04_element_03` — **text** (a): View the identity project
- `section_04_element_04` — **textarea** (p): What the work includes
- `section_04_element_05` — **text** (h2): A phased foundation helps early teams communicate clearly now without overbuilding for an
- `section_04_element_06` — **text** (dt): Timeline
- `section_04_element_07` — **textarea** (dd): Defined around scope and dependencies
- `section_04_element_08` — **text** (dt): Engagement
- `section_04_element_09` — **textarea** (dd): Focused project or connected partnership
- `section_04_element_10` — **text** (dt): First input
- `section_04_element_11` — **textarea** (dd): Your goal, audience, constraints, and current context


Link destinations:
- `section_04_link_01_url` — View the identity project → `identity-project.html`

List group 01: 4 source items (li)
- List repeater `section_04_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_04_list_01_items.element_01` — **textarea** (li): Focus

List group 02: 3 source items (li)
- List repeater `section_04_list_02_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_04_list_02_items.element_01` — **textarea** (li): Positioning and launch priorities

### 05. Engagement approach

Section metadata: aria-label: `Engagement approach`.

Structured section fields:
- `section_05_element_01` — **textarea** (p): A practical engagement
- `section_05_element_02` — **wysiwyg** (h2): From sector context to useful experience.
- `section_05_element_03` — **textarea** (p): Clear responsibilities and review points keep the work connected to your reality.


Repeater `section_05_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 06. Other industries

Section metadata: aria-label: `Other industries`.

Structured section fields:
- `section_06_element_01` — **textarea** (p): Other industries
- `section_06_element_02` — **text** (h2): Explore another context.
- `section_06_element_03` — **textarea** (p): The approach adapts around different audiences, journeys, and business models.
- `section_06_element_04` — **wysiwyg** (a): SaaS & Technology
- `section_06_element_05` — **wysiwyg** (a): E-commerce
- `section_06_element_06` — **wysiwyg** (a): Real Estate
- `section_06_element_07` — **wysiwyg** (a): Healthcare


Link destinations:
- `section_06_link_01_url` — SaaS & Technology → `industry-single.html`
- `section_06_link_02_url` — E-commerce → `ecommerce.html`
- `section_06_link_03_url` — Real Estate → `real-estate.html`
- `section_06_link_04_url` — Healthcare → `healthcare.html`

### 07. Industry questions

Section metadata: aria-label: `Industry questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

Structured section fields:
- `section_07_element_01` — **textarea** (p): Industry questions
- `section_07_element_02` — **text** (h2): Planning around your context.
- `section_07_element_03` — **textarea** (p): Search the essentials or filter by topic.
- `section_07_element_04` — **wysiwyg** (label): Search frequently asked questions
- `section_07_element_05` — **text** (button): All
- `section_07_element_06` — **text** (button): Projects
- `section_07_element_07` — **text** (button): Process
- `section_07_element_08` — **text** (button): Support
- `section_07_element_09` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 3 source items (div)
- Faq repeater `section_07_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_07_faq_01_items.element_01` — **text** (button): Can we begin with a small first release?
  - `section_07_faq_01_items.element_02` — **textarea** (p): Yes. We can define a focused first phase that communicates the idea clearly without invest
  - `section_07_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
