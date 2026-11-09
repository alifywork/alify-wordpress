# ACF Field Inventory — `service-single`

Source: [`frontend-source/service-single.html`](../../frontend-source/service-single.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

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

- `section_01_copy_01` — **Copy** (HTML `p`): Web Development
- `section_01_heading_01` — **Heading** (HTML `h2`): Websites designed to perform today and scale tomorrow.
- `section_01_copy_02` — **Copy** (HTML `p`): From marketing sites to content-managed platforms, we connect clear storytelling with responsive, accessible implementation and a technical foundation your team can build on.
- `section_01_inline_text_01` — **Inline Text** (HTML `strong`): Clearer journeys
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): Content and conversion paths shaped around real user needs.
- `section_01_inline_text_03` — **Inline Text** (HTML `strong`): Responsive by default
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): Careful layouts across mobile, tablet, laptop, and wide screens.
- `section_01_inline_text_05` — **Inline Text** (HTML `strong`): Maintainable foundation
- `section_01_inline_text_06` — **Inline Text** (HTML `span`): Reusable components and practical technology choices.

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_01_image_01_alt` (**Text**): Animated Web Development service scene

### 02. Service deliverables

Section metadata: aria-label: `Service deliverables`.

- `section_02_copy_01` — **Copy** (HTML `p`): What this can include
- `section_02_heading_01` — **Heading** (HTML `h2`): Deliverables shaped around the outcome.
- `section_02_copy_02` — **Copy** (HTML `p`): A focused scope can include some or all of these, depending on your current needs.
- `section_02_heading_02` — **Heading** (HTML `h3`): Technical discovery
- `section_02_copy_03` — **Copy** (HTML `p`): Goals, integrations, content structure, constraints, and the most practical technical route.
- `section_02_heading_03` — **Heading** (HTML `h3`): Responsive development
- `section_02_copy_04` — **Copy** (HTML `p`): Accessible front-end implementation with considered motion and interaction states.
- `section_02_heading_04` — **Heading** (HTML `h3`): CMS and integrations
- `section_02_copy_05` — **Copy** (HTML `p`): Editing workflows, third-party services, forms, analytics, and data requirements.
- `section_02_heading_05` — **Heading** (HTML `h3`): Quality and handover
- `section_02_copy_06` — **Copy** (HTML `p`): Cross-device testing, performance checks, documentation, and launch support.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. Service process

Section metadata: aria-label: `Service process`.

- `section_03_copy_01` — **Copy** (HTML `p`): A shared process
- `section_03_heading_01` — **Heading** (HTML `h2`): Clear from discovery to delivery.
- `section_03_copy_02` — **Copy** (HTML `p`): The work stays visible, collaborative, and connected to the original goal.
- `section_03_heading_02` — **Heading** (HTML `h3`): Discover
- `section_03_copy_03` — **Copy** (HTML `p`): Understand the audience, goal, current situation, constraints, and success measures.
- `section_03_heading_03` — **Heading** (HTML `h3`): Define
- `section_03_copy_04` — **Copy** (HTML `p`): Turn the brief into a focused route, scope, priorities, and shared direction.
- `section_03_heading_04` — **Heading** (HTML `h3`): Create
- `section_03_copy_05` — **Copy** (HTML `p`): Develop and review tangible work in clear stages with focused feedback.
- `section_03_heading_05` — **Heading** (HTML `h3`): Deliver and improve
- `section_03_copy_06` — **Copy** (HTML `p`): Complete quality checks, handover, measurement, and next-step planning.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_03_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Related services

Section metadata: aria-label: `Related services`.

- `section_04_copy_01` — **Copy** (HTML `p`): Continue exploring
- `section_04_heading_01` — **Heading** (HTML `h2`): Related capabilities.
- `section_04_copy_02` — **Copy** (HTML `p`): Connected services can be combined into one joined-up engagement.
- `section_04_link_label_01` — **Link Label** (HTML `a`): SEO
- `section_04_link_label_02` — **Link Label** (HTML `a`): Digital Marketing
- `section_04_link_label_03` — **Link Label** (HTML `a`): AI Automation

Link destinations:
- `section_04_link_01_url` — SEO → `seo.html`
- `section_04_link_02_url` — Digital Marketing → `digital-marketing.html`
- `section_04_link_03_url` — AI Automation → `ai-automation.html`

### 05. Service FAQs

Section metadata: aria-label: `Service FAQs`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

- `section_05_copy_01` — **Copy** (HTML `p`): Service questions
- `section_05_heading_01` — **Heading** (HTML `h2`): Before we define your scope.
- `section_05_copy_02` — **Copy** (HTML `p`): Search or filter the essentials, then bring us the context specific to your challenge.
- `section_05_field_label_01` — **Field Label** (HTML `label`): Search frequently asked questions
- `section_05_button_label_01` — **Button Label** (HTML `button`): All
- `section_05_button_label_02` — **Button Label** (HTML `button`): Projects
- `section_05_button_label_03` — **Button Label** (HTML `button`): Process
- `section_05_button_label_04` — **Button Label** (HTML `button`): Support
- `section_05_button_label_05` — **Button Label** (HTML `button`): Can you rebuild an existing website?
- `section_05_copy_03` — **Copy** (HTML `p`): Yes. We first assess what should be retained, improved, or rebuilt so the investment targets the real limitation.
- `section_05_button_label_06` — **Button Label** (HTML `button`): Which platforms do you work with?
- `section_05_copy_04` — **Copy** (HTML `p`): The platform depends on your editing, integration, and operational needs. We recommend technology after discovery rather than forcing one stack.
- `section_05_button_label_07` — **Button Label** (HTML `button`): Will the website be easy to update?
- `section_05_copy_05` — **Copy** (HTML `p`): Where a CMS is included, we design an appropriate editing experience and provide handover guidance.
- `section_05_copy_06` — **Copy** (HTML `p`): No matching questions found. Try another search or topic.

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
