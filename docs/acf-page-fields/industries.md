# ACF Field Inventory — `industries`

Source: [`frontend-source/industries.html`](../../frontend-source/industries.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

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

- `section_01_copy_01` — **Copy** (HTML `p`): Industry experience
- `section_01_heading_01` — **Heading** (HTML `h2`): Different worlds. One thoughtful approach.
- `section_01_copy_02` — **Copy** (HTML `p`): Different audiences, regulations, buying journeys, and business models need different digital answers. Explore where our connected capabilities can help.
- `section_01_heading_02` — **Heading** (HTML `h3`): SaaS & Technology
- `section_01_copy_03` — **Copy** (HTML `p`): Technical products often have a strong story buried beneath features and terminology. We help bring the value to the surface.
- `section_01_link_label_01` — **Link Label** (HTML `a`): Explore SaaS & Technology
- `section_01_heading_03` — **Heading** (HTML `h3`): E-commerce
- `section_01_copy_04` — **Copy** (HTML `p`): Commerce experiences should make the product easy to understand, the journey easy to trust, and the next step easy to take.
- `section_01_link_label_02` — **Link Label** (HTML `a`): Explore E-commerce
- `section_01_heading_04` — **Heading** (HTML `h3`): Real Estate
- `section_01_copy_05` — **Copy** (HTML `p`): Property decisions are practical and emotional. Clear information and immersive storytelling help people move from interest to inquiry.
- `section_01_link_label_03` — **Link Label** (HTML `a`): Explore Real Estate
- `section_01_heading_05` — **Heading** (HTML `h3`): Healthcare
- `section_01_copy_06` — **Copy** (HTML `p`): Healthcare experiences need calm, accessible communication and a careful respect for privacy, trust, and different user needs.
- `section_01_link_label_04` — **Link Label** (HTML `a`): Explore Healthcare
- `section_01_heading_06` — **Heading** (HTML `h3`): Startups
- `section_01_copy_07` — **Copy** (HTML `p`): Early-stage teams need focus: a clear proposition, a distinctive presence, and a flexible foundation that can evolve with the business.
- `section_01_link_label_05` — **Link Label** (HTML `a`): Explore Startups
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): 01 / INDUSTRY
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 02 / INDUSTRY
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): 03 / INDUSTRY
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): 04 / INDUSTRY
- `section_01_inline_text_05` — **Inline Text** (HTML `span`): 05 / INDUSTRY

Link destinations:
- `section_01_link_01_url` — Explore SaaS & Technology → `industry-single.html`
- `section_01_link_02_url` — Explore SaaS & Technology → `industry-single.html`
- `section_01_link_03_url` — Explore E-commerce → `ecommerce.html`
- `section_01_link_04_url` — Explore E-commerce → `ecommerce.html`
- `section_01_link_05_url` — Explore Real Estate → `real-estate.html`
- `section_01_link_06_url` — Explore Real Estate → `real-estate.html`
- `section_01_link_07_url` — Explore Healthcare → `healthcare.html`
- `section_01_link_08_url` — Explore Healthcare → `healthcare.html`
- `section_01_link_09_url` — Explore Startups → `startups.html`
- `section_01_link_10_url` — Explore Startups → `startups.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/industries/technology-saas.jpg`
  - `section_01_image_01_alt` (**Text**): SaaS & Technology team and customer experience
- `section_01_image_02` (**Image**): `assets/images/industries/retail-ecommerce.jpg`
  - `section_01_image_02_alt` (**Text**): E-commerce team and customer experience
- `section_01_image_03` (**Image**): `assets/images/industries/real-estate.jpg`
  - `section_01_image_03_alt` (**Text**): Real Estate team and customer experience
- `section_01_image_04` (**Image**): `assets/images/industries/healthcare.jpg`
  - `section_01_image_04_alt` (**Text**): Healthcare team and customer experience
- `section_01_image_05` (**Image**): `assets/images/industries/startups-ventures.jpg`
  - `section_01_image_05_alt` (**Text**): Startups team and customer experience

Repeated content: 5 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 02. Related work

Section metadata: aria-label: `Related work`.

- `section_02_copy_01` — **Copy** (HTML `p`): Industry thinking in context
- `section_02_heading_01` — **Heading** (HTML `h2`): See the thinking applied.
- `section_02_copy_02` — **Copy** (HTML `p`): Three connected concepts showing how strategy, design, and technology work together.
- `section_02_link_label_01` — **Link Label** (HTML `a`): Web · UI UX Fintech, reimagined
- `section_02_link_label_02` — **Link Label** (HTML `a`): AI · Service design Automation with purpose
- `section_02_link_label_03` — **Link Label** (HTML `a`): Commerce · Growth Commerce without friction
- `section_02_copy_03` — **Copy** (HTML `p`): Not sure where to begin?
- `section_02_heading_02` — **Heading** (HTML `h2`): Start with the decision, not the deliverable.
- `section_02_copy_04` — **Copy** (HTML `p`): Share the outcome you need. We can help identify the right capability, scope, and engagement before you commit to a brief.
- `section_02_link_label_04` — **Link Label** (HTML `a`): Compare engagement options

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

- `section_03_copy_01` — **Copy** (HTML `p`): Across every industry
- `section_03_heading_01` — **Heading** (HTML `h2`): Context changes. The standard does not.
- `section_03_copy_02` — **Copy** (HTML `p`): A consistent approach to strategy, experience, and technology keeps the work useful and coherent.
- `section_03_heading_02` — **Heading** (HTML `h3`): Strategy before styling
- `section_03_copy_03` — **Copy** (HTML `p`): Understand the commercial context and audience before defining the creative response.
- `section_03_heading_03` — **Heading** (HTML `h3`): Human journeys
- `section_03_copy_04` — **Copy** (HTML `p`): Clear content and useful interactions designed around what people actually need to do.
- `section_03_heading_04` — **Heading** (HTML `h3`): Flexible systems
- `section_03_copy_05` — **Copy** (HTML `p`): Digital foundations that adapt as your offer, content, and market continue to evolve.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Industry approach

Section metadata: aria-label: `Industry approach`.

- `section_04_copy_01` — **Copy** (HTML `p`): Our approach
- `section_04_heading_01` — **Heading** (HTML `h2`): Industry insight without inherited assumptions.
- `section_04_copy_02` — **Copy** (HTML `p`): We learn the landscape, find the meaningful difference, and shape the right response around your reality.
- `section_04_heading_02` — **Heading** (HTML `h3`): Learn the landscape
- `section_04_copy_03` — **Copy** (HTML `p`): Review the market, audience, competitors, internal knowledge, and existing experience.
- `section_04_heading_03` — **Heading** (HTML `h3`): Find the difference
- `section_04_copy_04` — **Copy** (HTML `p`): Identify the clearest opportunity to be more useful and distinctive.
- `section_04_heading_04` — **Heading** (HTML `h3`): Shape the solution
- `section_04_copy_05` — **Copy** (HTML `p`): Select services, content, and functionality around the actual challenge.
- `section_04_heading_05` — **Heading** (HTML `h3`): Validate and improve
- `section_04_copy_06` — **Copy** (HTML `p`): Use feedback and real-world behaviour to refine the experience.
- `section_04_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_04_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_04_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_04_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 05. Industry questions

Section metadata: aria-label: `Industry questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

- `section_05_copy_01` — **Copy** (HTML `p`): Industry questions
- `section_05_heading_01` — **Heading** (HTML `h2`): Planning around your context.
- `section_05_copy_02` — **Copy** (HTML `p`): Search the essentials or filter by topic.
- `section_05_field_label_01` — **Field Label** (HTML `label`): Search frequently asked questions
- `section_05_button_label_01` — **Button Label** (HTML `button`): All
- `section_05_button_label_02` — **Button Label** (HTML `button`): Projects
- `section_05_button_label_03` — **Button Label** (HTML `button`): Process
- `section_05_button_label_04` — **Button Label** (HTML `button`): Support
- `section_05_button_label_05` — **Button Label** (HTML `button`): Do you only work with the industries listed here?
- `section_05_copy_03` — **Copy** (HTML `p`): No. These are examples of where our approach applies. We are happy to discuss adjacent sectors and new challenges.
- `section_05_button_label_06` — **Button Label** (HTML `button`): Can you work with industry-specific platforms?
- `section_05_copy_04` — **Copy** (HTML `p`): Yes, subject to technical review. We consider integrations, data, accessibility, privacy, and operational requirements during discovery.
- `section_05_button_label_07` — **Button Label** (HTML `button`): How do you handle regulated content?
- `section_05_copy_05` — **Copy** (HTML `p`): We work with your subject-matter and compliance stakeholders, keeping review responsibilities clear throughout the content and design process.
- `section_05_copy_06` — **Copy** (HTML `p`): No matching questions found. Try another search or topic.

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
