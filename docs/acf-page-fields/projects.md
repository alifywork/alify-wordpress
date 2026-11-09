# ACF Field Inventory — `projects`

Source: [`frontend-source/projects.html`](../../frontend-source/projects.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Projects — Alify |
| `meta_description` | Textarea | Explore selected digital projects and creative work by Alify. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Projects / Archive |
| `hero_title` | Text | Selected work, shaped by curiosity and craft. |
| `hero_description` | Textarea | Explore a collection of digital experiences created through close collaboration, clear thinking, and careful execution. |
| `hero_background` | Select/Image | neon-lines-07.webp |

## Main content fields

### 01. Featured project

Section metadata: aria-label: `Featured project`.

- `section_01_copy_01` — **Copy** (HTML `p`): Featured concept · Fintech
- `section_01_heading_01` — **Heading** (HTML `h2`): Complex product. Simple story.
- `section_01_copy_02` — **Copy** (HTML `p`): A product-positioning and website concept exploring how a technical finance platform could communicate value with more clarity and confidence.
- `section_01_link_label_01` — **Link Label** (HTML `a`): View project concept

Link destinations:
- `section_01_link_01_url` — View project concept → `project-single.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_01_image_01_alt` (**Text**): Animated fintech website concept

### 02. Project collection

Section metadata: aria-label: `Project collection`.

Interaction/filter data: `data-filter` = `all`; `data-filter` = `web`; `data-filter` = `brand`; `data-filter` = `product`; `data-filter` = `growth`; `data-category` = `web`; `data-category` = `growth`; `data-category` = `product`; `data-category` = `brand`; `data-category` = `web`; `data-category` = `product`.

- `section_02_copy_01` — **Copy** (HTML `p`): Project archive
- `section_02_heading_01` — **Heading** (HTML `h2`): Explore the work by discipline.
- `section_02_copy_02` — **Copy** (HTML `p`): Illustrative concept projects that show different thinking, not the same abstract image repeated.
- `section_02_button_label_01` — **Button Label** (HTML `button`): All
- `section_02_button_label_02` — **Button Label** (HTML `button`): Web
- `section_02_button_label_03` — **Button Label** (HTML `button`): Brand
- `section_02_button_label_04` — **Button Label** (HTML `button`): Product
- `section_02_button_label_05` — **Button Label** (HTML `button`): Growth
- `section_02_link_label_01` — **Link Label** (HTML `a`): Concept project · web Fintech, reimagined Product strategy · UI UX · Development
- `section_02_link_label_02` — **Link Label** (HTML `a`): Concept project · growth Commerce without friction Experience · E-commerce · Growth
- `section_02_link_label_03` — **Link Label** (HTML `a`): Concept project · product Automation with purpose AI strategy · Workflow · Prototype
- `section_02_link_label_04` — **Link Label** (HTML `a`): Concept project · brand A distinct new identity Strategy · Identity · System
- `section_02_link_label_05` — **Link Label** (HTML `a`): Concept project · web Property, made personal Research · Product design · Build
- `section_02_link_label_06` — **Link Label** (HTML `a`): Concept project · product Wellness within reach Content · Visibility · Growth

Link destinations:
- `section_02_link_01_url` — Concept project · web Fintech, reimagined Product strategy · UI UX · Development → `project-single.html`
- `section_02_link_02_url` — Concept project · growth Commerce without friction Experience · E-commerce · Growth → `commerce-project.html`
- `section_02_link_03_url` — Concept project · product Automation with purpose AI strategy · Workflow · Prototype → `case-study-single.html`
- `section_02_link_04_url` — Concept project · brand A distinct new identity Strategy · Identity · System → `identity-project.html`
- `section_02_link_05_url` — Concept project · web Property, made personal Research · Product design · Build → `property-project.html`
- `section_02_link_06_url` — Concept project · product Wellness within reach Content · Visibility · Growth → `wellness-project.html`

Images/media:
- `section_02_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_02_image_01_alt` (**Text**): Animated visual for Fintech, reimagined
- `section_02_image_02` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_02_image_02_alt` (**Text**): Animated visual for Commerce without friction
- `section_02_image_03` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_02_image_03_alt` (**Text**): Animated visual for Automation with purpose
- `section_02_image_04` (**Image**): `assets/images/services/logo-design.svg`
  - `section_02_image_04_alt` (**Text**): Animated visual for A distinct new identity
- `section_02_image_05` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_02_image_05_alt` (**Text**): Animated visual for Property, made personal
- `section_02_image_06` (**Image**): `assets/images/services/seo.svg`
  - `section_02_image_06_alt` (**Text**): Animated visual for Wellness within reach

Repeated content: 6 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. Project standards

Section metadata: aria-label: `Project standards`.

- `section_03_copy_01` — **Copy** (HTML `p`): Across every brief
- `section_03_heading_01` — **Heading** (HTML `h2`): One standard, whatever the deliverable.
- `section_03_copy_02` — **Copy** (HTML `p`): A clear idea, useful experience, and a system that can keep growing.
- `section_03_heading_02` — **Heading** (HTML `h3`): A clear central idea
- `section_03_copy_03` — **Copy** (HTML `p`): A focused thought connects the brand, the experience, and the reason people should care.
- `section_03_heading_03` — **Heading** (HTML `h3`): Useful for real people
- `section_03_copy_04` — **Copy** (HTML `p`): Accessible content, intuitive journeys, responsive layouts, and purposeful interactions.
- `section_03_heading_04` — **Heading** (HTML `h3`): Built as a system
- `section_03_copy_05` — **Copy** (HTML `p`): Reusable components and practical decisions make future evolution easier.
- `section_03_heading_05` — **Heading** (HTML `h3`): Made to keep improving
- `section_03_copy_06` — **Copy** (HTML `p`): Measurement and feedback create a foundation for meaningful iteration.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_03_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
