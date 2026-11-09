# ACF Field Inventory — `project-single`

Source: [`frontend-source/project-single.html`](../../frontend-source/project-single.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Fintech Product Concept — Alify |
| `meta_description` | Textarea | Explore the process and thinking behind an Alify digital project. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Projects / Fintech concept |
| `hero_title` | Text | Making complex fintech feel clear. |
| `hero_description` | Textarea | Explore the product thinking, interface direction, and responsive system behind this illustrative fintech concept. |
| `hero_background` | Select/Image | neon-lines-08.webp |

## Main content fields

### 01. Project overview

Section metadata: aria-label: `Project overview`.

- `section_01_copy_01` — **Copy** (HTML `p`): Concept project · Fintech
- `section_01_heading_01` — **Heading** (HTML `h2`): Fintech, reimagined.
- `section_01_copy_02` — **Copy** (HTML `p`): A product-story and website concept that turns a technically capable platform into a clear, confident digital experience.
- `section_01_copy_03` — **Copy** (HTML `p`): Illustrative concept created to demonstrate our approach—not a verified client engagement.
- `section_01_term_01` — **Term** (HTML `dt`): Sector
- `section_01_definition_01` — **Definition** (HTML `dd`): Financial technology
- `section_01_term_02` — **Term** (HTML `dt`): Scope
- `section_01_definition_02` — **Definition** (HTML `dd`): Product strategy, UI UX, development
- `section_01_term_03` — **Term** (HTML `dt`): Focus
- `section_01_definition_03` — **Definition** (HTML `dd`): Clarity, trust, activation
- `section_01_term_04` — **Term** (HTML `dt`): Status
- `section_01_definition_04` — **Definition** (HTML `dd`): Illustrative concept

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_01_image_01_alt` (**Text**): Animated fintech website and responsive product interface concept

### 02. The challenge

Section metadata: aria-label: `The challenge`.

- `section_02_copy_01` — **Copy** (HTML `p`): The challenge
- `section_02_heading_01` — **Heading** (HTML `h2`): A powerful product hidden beneath technical language.
- `section_02_copy_02` — **Copy** (HTML `p`): The concept begins with a common problem: the platform can explain what it does, but not why it matters.
- `section_02_copy_03` — **Copy** (HTML `p`): Feature-heavy content creates friction for first-time visitors. Different audiences need different levels of detail, and the route from understanding to action lacks a clear rhythm.
- `section_02_copy_04` — **Copy** (HTML `p`): The brief in four moves
- `section_02_list_item_01` — **List Item** (HTML `li`): 01 Clarify the central value proposition
- `section_02_list_item_02` — **List Item** (HTML `li`): 02 Create journeys for distinct decision-makers
- `section_02_list_item_03` — **List Item** (HTML `li`): 03 Make technical detail easier to scan
- `section_02_list_item_04` — **List Item** (HTML `li`): 04 Build confidence before requesting action
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01

### 03. The response

Section metadata: aria-label: `The response`.

- `section_03_copy_01` — **Copy** (HTML `p`): The response
- `section_03_heading_01` — **Heading** (HTML `h2`): One clear story. A flexible product system.
- `section_03_copy_02` — **Copy** (HTML `p`): The experience connects positioning, interface design, and technology so every part supports the same promise.
- `section_03_heading_02` — **Heading** (HTML `h3`): Lead with the outcome.
- `section_03_copy_03` — **Copy** (HTML `p`): Start with the change the platform creates, then support that claim with relevant capabilities and evidence.
- `section_03_heading_03` — **Heading** (HTML `h3`): Reveal detail progressively.
- `section_03_copy_04` — **Copy** (HTML `p`): Give scanning visitors a clear overview while keeping technical depth available for evaluators.
- `section_03_heading_04` — **Heading** (HTML `h3`): Design for coherence.
- `section_03_copy_05` — **Copy** (HTML `p`): Reusable content, interface, and interaction patterns keep the experience consistent as it grows.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01 / POSITION
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02 / STRUCTURE
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03 / SYSTEM

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Experience direction

Section metadata: aria-label: `Experience direction`.

- `section_04_caption_01` — **Caption** (HTML `figcaption`): Responsive product and marketing interface direction
- `section_04_copy_01` — **Copy** (HTML `p`): Experience direction
- `section_04_heading_01` — **Heading** (HTML `h2`): Confidence without unnecessary complexity.
- `section_04_copy_02` — **Copy** (HTML `p`): Calm typography, deliberate hierarchy, and purposeful interaction make the product feel capable without making it feel complicated.
- `section_04_heading_02` — **Heading** (HTML `h3`): Clear hierarchy
- `section_04_copy_03` — **Copy** (HTML `p`): A focused narrative, useful proof points, and intentional calls to action help visitors understand where to go next.
- `section_04_heading_03` — **Heading** (HTML `h3`): Responsive by default
- `section_04_copy_04` — **Copy** (HTML `p`): Content and interactions adapt around real screen sizes, accessibility needs, and different reading contexts.
- `section_04_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_04_inline_text_02` — **Inline Text** (HTML `span`): 02

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_01_alt` (**Text**): Animated responsive interface system for the fintech product concept

Repeated content: 2 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 05. Project deliverables and timeline

Section metadata: aria-label: `Project deliverables and timeline`.

- `section_05_copy_01` — **Copy** (HTML `p`): Artefacts and delivery
- `section_05_heading_01` — **Heading** (HTML `h2`): The system behind the final screens.
- `section_05_copy_02` — **Copy** (HTML `p`): Illustrative deliverables and a sample sequence showing how this concept could become a real engagement.
- `section_05_caption_01` — **Caption** (HTML `figcaption`): Journey and content study
- `section_05_caption_02` — **Caption** (HTML `figcaption`): Responsive system study
- `section_05_copy_03` — **Copy** (HTML `p`): Illustrative deliverables
- `section_05_list_item_01` — **List Item** (HTML `li`): 01 Product positioning and content hierarchy
- `section_05_list_item_02` — **List Item** (HTML `li`): 02 Responsive website and product UI
- `section_05_list_item_03` — **List Item** (HTML `li`): 03 Component and interaction specifications
- `section_05_list_item_04` — **List Item** (HTML `li`): 04 Accessibility, performance, and handover checks
- `section_05_copy_04` — **Copy** (HTML `p`): Illustrative timeline · Scope dependent
- `section_05_list_item_05` — **List Item** (HTML `li`): Weeks 01–02 Discover and define Context, audience, content, constraints, and success measures.
- `section_05_list_item_06` — **List Item** (HTML `li`): Weeks 03–04 Design the system Journeys, visual direction, prototypes, and review.
- `section_05_list_item_07` — **List Item** (HTML `li`): Weeks 05–07 Build and integrate Responsive implementation, content, and quality checks.
- `section_05_list_item_08` — **List Item** (HTML `li`): Week 08 Validate and hand over Final review, documentation, launch, and next-step planning.

Images/media:
- `section_05_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_05_image_01_alt` (**Text**): Additional project interface study
- `section_05_image_02` (**Image**): `assets/images/services/seo.svg`
  - `section_05_image_02_alt` (**Text**): Additional project interface study

### 06. Proposed success measures

Section metadata: aria-label: `Proposed success measures`.

- `section_06_copy_01` — **Copy** (HTML `p`): Proposed success measures
- `section_06_heading_01` — **Heading** (HTML `h2`): What a live project would validate.
- `section_06_copy_02` — **Copy** (HTML `p`): These are evaluation criteria for a future engagement, not reported results from this concept.
- `section_06_heading_02` — **Heading** (HTML `h3`): Comprehension
- `section_06_copy_03` — **Copy** (HTML `p`): Can first-time visitors explain the product value and identify the journey relevant to them?
- `section_06_heading_03` — **Heading** (HTML `h3`): Activation
- `section_06_copy_04` — **Copy** (HTML `p`): Do qualified visitors reach demo, signup, or inquiry actions with greater confidence?
- `section_06_heading_04` — **Heading** (HTML `h3`): Experience quality
- `section_06_copy_05` — **Copy** (HTML `p`): Does the implementation remain fast, accessible, and usable across devices and connection speeds?
- `section_06_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_06_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_06_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 07. Next concept

Section metadata: aria-label: `Next concept`.

- `section_07_link_label_01` — **Link Label** (HTML `a`): Next case concept Less repetition. More meaningful work. Explore how an automation concept could connect repetitive tasks into one visible, manageable workflow. Explore automation with purpose

Link destinations:
- `section_07_link_01_url` — Next case concept Less repetition. More meaningful work. Explore how an automation concept could connect repetitive tasks into one visible, manageable workflow. Explore automation with purpose → `case-study-single.html`

Images/media:
- `section_07_image_01` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_07_image_01_alt` (**Text**): Animated AI automation workflow concept

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
