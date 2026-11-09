# ACF Field Inventory — `digital-marketing`

Source: [`frontend-source/digital-marketing.html`](../../frontend-source/digital-marketing.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

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

- `section_01_copy_01` — **Copy** (HTML `p`): Digital Marketing
- `section_01_heading_01` — **Heading** (HTML `h2`): Campaigns that connect the idea, the channel, and the outcome.
- `section_01_copy_02` — **Copy** (HTML `p`): We bring audience insight, campaign thinking, creative execution, and measurement together so every touchpoint supports the same clear objective.
- `section_01_inline_text_01` — **Inline Text** (HTML `strong`): Stronger campaign ideas
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): A central thought that travels coherently across channels.
- `section_01_inline_text_03` — **Inline Text** (HTML `strong`): Connected journeys
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): Ads, content, landing pages, and follow-up designed together.
- `section_01_inline_text_05` — **Inline Text** (HTML `strong`): Iteration with purpose
- `section_01_inline_text_06` — **Inline Text** (HTML `span`): Performance signals used to refine creative and experience.

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_01_image_01_alt` (**Text**): Animated Digital Marketing service scene

### 02. Service deliverables

Section metadata: aria-label: `Service deliverables`.

- `section_02_copy_01` — **Copy** (HTML `p`): What this can include
- `section_02_heading_01` — **Heading** (HTML `h2`): Deliverables shaped around the outcome.
- `section_02_copy_02` — **Copy** (HTML `p`): A focused scope can include some or all of these, depending on your current needs.
- `section_02_heading_02` — **Heading** (HTML `h3`): Campaign strategy
- `section_02_copy_03` — **Copy** (HTML `p`): Objective, audience, channel roles, messaging, offer, and measurement plan.
- `section_02_heading_03` — **Heading** (HTML `h3`): Creative direction
- `section_02_copy_04` — **Copy** (HTML `p`): Campaign concepts, content systems, copy direction, and channel adaptations.
- `section_02_heading_04` — **Heading** (HTML `h3`): Landing experiences
- `section_02_copy_05` — **Copy** (HTML `p`): Focused pages that continue the campaign story and support action.
- `section_02_heading_05` — **Heading** (HTML `h3`): Review and optimisation
- `section_02_copy_06` — **Copy** (HTML `p`): A practical cadence for reading results and improving the next iteration.
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

### 04. Service in practice

Section metadata: aria-label: `Service in practice`.

- `section_04_copy_01` — **Copy** (HTML `p`): Practical artefact
- `section_04_heading_01` — **Heading** (HTML `h3`): One campaign journey, end to end.
- `section_04_list_item_01` — **List Item** (HTML `li`): Audience
- `section_04_list_item_02` — **List Item** (HTML `li`): Creative
- `section_04_list_item_03` — **List Item** (HTML `li`): Landing
- `section_04_list_item_04` — **List Item** (HTML `li`): Learn
- `section_04_link_label_01` — **Link Label** (HTML `a`): Explore the commerce growth concept
- `section_04_copy_02` — **Copy** (HTML `p`): What the work includes
- `section_04_heading_02` — **Heading** (HTML `h2`): Creative, landing content, and measurement are planned around the same audience decision rather than treated as separate deliverables.
- `section_04_list_item_05` — **List Item** (HTML `li`): Audience moment and campaign promise
- `section_04_list_item_06` — **List Item** (HTML `li`): Channel creative and landing experience
- `section_04_list_item_07` — **List Item** (HTML `li`): Conversion quality and learning loop
- `section_04_term_01` — **Term** (HTML `dt`): Timeline
- `section_04_definition_01` — **Definition** (HTML `dd`): Defined around scope and dependencies
- `section_04_term_02` — **Term** (HTML `dt`): Engagement
- `section_04_definition_02` — **Definition** (HTML `dd`): Focused project or connected partnership
- `section_04_term_03` — **Term** (HTML `dt`): First input
- `section_04_definition_03` — **Definition** (HTML `dd`): Your goal, audience, constraints, and current context

Link destinations:
- `section_04_link_01_url` — Explore the commerce growth concept → `commerce-project.html`

### 05. Related services

Section metadata: aria-label: `Related services`.

- `section_05_copy_01` — **Copy** (HTML `p`): Continue exploring
- `section_05_heading_01` — **Heading** (HTML `h2`): Related capabilities.
- `section_05_copy_02` — **Copy** (HTML `p`): Connected services can be combined into one joined-up engagement.
- `section_05_link_label_01` — **Link Label** (HTML `a`): AI Automation
- `section_05_link_label_02` — **Link Label** (HTML `a`): UI UX Design
- `section_05_link_label_03` — **Link Label** (HTML `a`): Logo Design

Link destinations:
- `section_05_link_01_url` — AI Automation → `ai-automation.html`
- `section_05_link_02_url` — UI UX Design → `ui-ux-design.html`
- `section_05_link_03_url` — Logo Design → `logo-design.html`

### 06. Service FAQs

Section metadata: aria-label: `Service FAQs`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

- `section_06_copy_01` — **Copy** (HTML `p`): Service questions
- `section_06_heading_01` — **Heading** (HTML `h2`): Before we define your scope.
- `section_06_copy_02` — **Copy** (HTML `p`): Search or filter the essentials, then bring us the context specific to your challenge.
- `section_06_field_label_01` — **Field Label** (HTML `label`): Search frequently asked questions
- `section_06_button_label_01` — **Button Label** (HTML `button`): All
- `section_06_button_label_02` — **Button Label** (HTML `button`): Projects
- `section_06_button_label_03` — **Button Label** (HTML `button`): Process
- `section_06_button_label_04` — **Button Label** (HTML `button`): Support
- `section_06_button_label_05` — **Button Label** (HTML `button`): Can you work with our existing ad accounts?
- `section_06_copy_03` — **Copy** (HTML `p`): Yes, subject to access and review. We first understand current setup, data quality, and past learning.
- `section_06_button_label_06` — **Button Label** (HTML `button`): Do you create campaign content?
- `section_06_copy_04` — **Copy** (HTML `p`): Creative direction and channel-ready content can be included in an agreed campaign scope.
- `section_06_button_label_07` — **Button Label** (HTML `button`): How do you measure campaigns?
- `section_06_copy_05` — **Copy** (HTML `p`): Measures are chosen around the objective, such as qualified inquiries, conversion, engagement quality, or revenue contribution.
- `section_06_copy_06` — **Copy** (HTML `p`): No matching questions found. Try another search or topic.

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
