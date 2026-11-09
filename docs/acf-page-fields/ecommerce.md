# ACF Field Inventory — `ecommerce`

Source: [`frontend-source/ecommerce.html`](../../frontend-source/ecommerce.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | E-commerce — Alify |
| `meta_description` | Textarea | Explore Alify’s tailored digital approach for your industry. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Industries / E-commerce |
| `hero_title` | Text | Make every product easier to choose. |
| `hero_description` | Textarea | Storefronts, campaigns, and customer journeys designed around discovery, confidence, and conversion. |
| `hero_background` | Select/Image | neon-lines-11.webp |
| `hero_variant` | Select | mirror-right |

## Main content fields

### 01. E-commerce overview

Section metadata: aria-label: `E-commerce overview`; id: `ecommerce`.

- `section_01_copy_01` — **Copy** (HTML `p`): E-commerce
- `section_01_heading_01` — **Heading** (HTML `h2`): Turn discovery into confident action.
- `section_01_copy_02` — **Copy** (HTML `p`): Commerce experiences should make the product easy to understand, the journey easy to trust, and the next step easy to take.
- `section_01_link_label_01` — **Link Label** (HTML `a`): Discuss your brief

Link destinations:
- `section_01_link_01_url` — Discuss your brief → `start-project.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/industries/retail-ecommerce.jpg`
  - `section_01_image_01_alt` (**Text**): Natural E-commerce working environment

### 02. Industry challenge

Section metadata: aria-label: `Industry challenge`.

- `section_02_copy_01` — **Copy** (HTML `p`): The context
- `section_02_heading_01` — **Heading** (HTML `h2`): More choice does not always make choosing easier.
- `section_02_copy_02` — **Copy** (HTML `p`): Customers need the right product information, useful comparison, and reassurance at the exact moment uncertainty appears.
- `section_02_list_item_01` — **List Item** (HTML `li`): Clear product discovery and comparison
- `section_02_list_item_02` — **List Item** (HTML `li`): Content that answers practical buying questions
- `section_02_list_item_03` — **List Item** (HTML `li`): A consistent journey from campaign to checkout

### 03. Where we can help

Section metadata: aria-label: `Where we can help`.

- `section_03_copy_01` — **Copy** (HTML `p`): Where we can help
- `section_03_heading_01` — **Heading** (HTML `h2`): Connected capabilities. One clear direction.
- `section_03_copy_02` — **Copy** (HTML `p`): A focused engagement or a connected team across strategy, design, content, and technology.
- `section_03_heading_02` — **Heading** (HTML `h3`): Storefront strategy and design
- `section_03_copy_03` — **Copy** (HTML `p`): Shape navigation, merchandising, and page systems around how customers actually browse and decide.
- `section_03_heading_03` — **Heading** (HTML `h3`): Product discovery
- `section_03_copy_04` — **Copy** (HTML `p`): Improve categories, filtering, search, and product storytelling so the right option feels easier to find.
- `section_03_heading_04` — **Heading** (HTML `h3`): Conversion content
- `section_03_copy_05` — **Copy** (HTML `p`): Clarify product benefits, delivery, returns, proof, and reassurance without overwhelming the journey.
- `section_03_heading_05` — **Heading** (HTML `h3`): Campaign experiences
- `section_03_copy_06` — **Copy** (HTML `p`): Connect advertising and seasonal campaigns to focused landing experiences with one clear next step.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_03_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Industry in practice

Section metadata: aria-label: `Industry in practice`.

- `section_04_copy_01` — **Copy** (HTML `p`): Practical artefact
- `section_04_heading_01` — **Heading** (HTML `h3`): From discovery to a confident purchase.
- `section_04_list_item_01` — **List Item** (HTML `li`): Discover
- `section_04_list_item_02` — **List Item** (HTML `li`): Compare
- `section_04_list_item_03` — **List Item** (HTML `li`): Trust
- `section_04_list_item_04` — **List Item** (HTML `li`): Purchase
- `section_04_link_label_01` — **Link Label** (HTML `a`): View the commerce project
- `section_04_copy_02` — **Copy** (HTML `p`): What the work includes
- `section_04_heading_02` — **Heading** (HTML `h2`): A commerce system aligns product content, comparison, reassurance, and campaign entry points around the customer decision.
- `section_04_list_item_05` — **List Item** (HTML `li`): Catalogue and customer-intent structure
- `section_04_list_item_06` — **List Item** (HTML `li`): Product detail and reassurance patterns
- `section_04_list_item_07` — **List Item** (HTML `li`): Campaign and checkout continuity
- `section_04_term_01` — **Term** (HTML `dt`): Timeline
- `section_04_definition_01` — **Definition** (HTML `dd`): Defined around scope and dependencies
- `section_04_term_02` — **Term** (HTML `dt`): Engagement
- `section_04_definition_02` — **Definition** (HTML `dd`): Focused project or connected partnership
- `section_04_term_03` — **Term** (HTML `dt`): First input
- `section_04_definition_03` — **Definition** (HTML `dd`): Your goal, audience, constraints, and current context

Link destinations:
- `section_04_link_01_url` — View the commerce project → `commerce-project.html`

### 05. Engagement approach

Section metadata: aria-label: `Engagement approach`.

- `section_05_copy_01` — **Copy** (HTML `p`): A practical engagement
- `section_05_heading_01` — **Heading** (HTML `h2`): From sector context to useful experience.
- `section_05_copy_02` — **Copy** (HTML `p`): Clear responsibilities and review points keep the work connected to your reality.
- `section_05_heading_02` — **Heading** (HTML `h3`): Understand the customer and catalogue
- `section_05_copy_03` — **Copy** (HTML `p`): A focused working session establishes the audience, commercial priorities, constraints, and available knowledge.
- `section_05_heading_03` — **Heading** (HTML `h3`): Map discovery and purchase friction
- `section_05_copy_04` — **Copy** (HTML `p`): We identify the important questions, decision points, and friction that the experience needs to address.
- `section_05_heading_04` — **Heading** (HTML `h3`): Design the storefront journey
- `section_05_copy_05` — **Copy** (HTML `p`): Strategy, content, interface, and interaction come together in a coherent direction.
- `section_05_heading_05` — **Heading** (HTML `h3`): Build, measure, and optimise
- `section_05_copy_06` — **Copy** (HTML `p`): The experience is implemented and reviewed with the relevant stakeholders and real content.
- `section_05_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_05_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_05_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_05_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 06. Other industries

Section metadata: aria-label: `Other industries`.

- `section_06_copy_01` — **Copy** (HTML `p`): Other industries
- `section_06_heading_01` — **Heading** (HTML `h2`): Explore another context.
- `section_06_copy_02` — **Copy** (HTML `p`): The approach adapts around different audiences, journeys, and business models.
- `section_06_link_label_01` — **Link Label** (HTML `a`): SaaS & Technology
- `section_06_link_label_02` — **Link Label** (HTML `a`): Real Estate
- `section_06_link_label_03` — **Link Label** (HTML `a`): Healthcare
- `section_06_link_label_04` — **Link Label** (HTML `a`): Startups

Link destinations:
- `section_06_link_01_url` — SaaS & Technology → `industry-single.html`
- `section_06_link_02_url` — Real Estate → `real-estate.html`
- `section_06_link_03_url` — Healthcare → `healthcare.html`
- `section_06_link_04_url` — Startups → `startups.html`

### 07. Industry questions

Section metadata: aria-label: `Industry questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

- `section_07_copy_01` — **Copy** (HTML `p`): Industry questions
- `section_07_heading_01` — **Heading** (HTML `h2`): Planning around your context.
- `section_07_copy_02` — **Copy** (HTML `p`): Search the essentials or filter by topic.
- `section_07_field_label_01` — **Field Label** (HTML `label`): Search frequently asked questions
- `section_07_button_label_01` — **Button Label** (HTML `button`): All
- `section_07_button_label_02` — **Button Label** (HTML `button`): Projects
- `section_07_button_label_03` — **Button Label** (HTML `button`): Process
- `section_07_button_label_04` — **Button Label** (HTML `button`): Support
- `section_07_button_label_05` — **Button Label** (HTML `button`): Can you work with our commerce platform?
- `section_07_copy_03` — **Copy** (HTML `p`): Yes, subject to technical review. We consider your platform, integrations, operations, and team before recommending an approach.
- `section_07_button_label_06` — **Button Label** (HTML `button`): Can you help with campaign landing pages?
- `section_07_copy_04` — **Copy** (HTML `p`): Yes. We can create focused campaign experiences that connect the promise in your marketing to a clear purchase journey.
- `section_07_button_label_07` — **Button Label** (HTML `button`): Do you only design new stores?
- `section_07_copy_05` — **Copy** (HTML `p`): No. We can also improve specific journeys, content, navigation, product pages, or conversion friction within an existing store.
- `section_07_copy_06` — **Copy** (HTML `p`): No matching questions found. Try another search or topic.

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
