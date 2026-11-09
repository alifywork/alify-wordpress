# ACF Field Inventory — `wellness-project`

Source: [`frontend-source/wellness-project.html`](../../frontend-source/wellness-project.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Wellness within reach — Alify |
| `meta_description` | Textarea | A wellness concept connecting accessible service information, calm journeys, and privacy-conscious inquiry. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Projects / Healthcare and wellness |
| `hero_title` | Text | Make support easier to find and understand. |
| `hero_description` | Textarea | A wellness concept connecting accessible service information, calm journeys, and privacy-conscious inquiry. |
| `hero_background` | Select/Image | neon-lines-03.webp |
| `hero_variant` | Select | mirror-right |

## Main content fields

### 01. Project overview

Section metadata: aria-label: `Project overview`.

- `section_01_copy_01` — **Copy** (HTML `p`): Concept project · Healthcare and wellness
- `section_01_heading_01` — **Heading** (HTML `h2`): Wellness within reach.
- `section_01_copy_02` — **Copy** (HTML `p`): A service-discovery concept designed to make wellness information feel approachable, understandable, and easy to act on.
- `section_01_copy_03` — **Copy** (HTML `p`): Illustrative concept created to demonstrate our approach—not a verified client engagement.
- `section_01_term_01` — **Term** (HTML `dt`): Sector
- `section_01_definition_01` — **Definition** (HTML `dd`): Healthcare and wellness
- `section_01_term_02` — **Term** (HTML `dt`): Scope
- `section_01_definition_02` — **Definition** (HTML `dd`): Content strategy, accessibility, UI UX, SEO
- `section_01_term_03` — **Term** (HTML `dt`): Focus
- `section_01_definition_03` — **Definition** (HTML `dd`): Clarity, reassurance, accessibility
- `section_01_term_04` — **Term** (HTML `dt`): Status
- `section_01_definition_04` — **Definition** (HTML `dd`): Illustrative concept

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/seo.svg`
  - `section_01_image_01_alt` (**Text**): Animated Wellness within reach project concept

### 02. The challenge

Section metadata: aria-label: `The challenge`.

- `section_02_copy_01` — **Copy** (HTML `p`): The challenge
- `section_02_heading_01` — **Heading** (HTML `h2`): Important information often arrives at a stressful moment.
- `section_02_copy_02` — **Copy** (HTML `p`): A service-discovery concept designed to make wellness information feel approachable, understandable, and easy to act on.
- `section_02_copy_03` — **Copy** (HTML `p`): Visitors may be anxious, comparing options, or supporting someone else. Dense terminology and unclear next steps make an already sensitive task harder.
- `section_02_copy_04` — **Copy** (HTML `p`): The brief in four moves
- `section_02_list_item_01` — **List Item** (HTML `li`): 01 Organise information around real questions
- `section_02_list_item_02` — **List Item** (HTML `li`): 02 Use calm language without losing accuracy
- `section_02_list_item_03` — **List Item** (HTML `li`): 03 Make accessibility part of every interaction
- `section_02_list_item_04` — **List Item** (HTML `li`): 04 Create privacy-conscious inquiry routes
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01

### 03. The response

Section metadata: aria-label: `The response`.

- `section_03_copy_01` — **Copy** (HTML `p`): The response
- `section_03_heading_01` — **Heading** (HTML `h2`): A calm content system built around reassurance.
- `section_03_copy_02` — **Copy** (HTML `p`): Strategy, content, interface design, and technology connect around one clear experience.
- `section_03_heading_02` — **Heading** (HTML `h3`): Start with the visitor question.
- `section_03_copy_03` — **Copy** (HTML `p`): Services and guidance are organised around what people need to know, not internal terminology.
- `section_03_heading_03` — **Heading** (HTML `h3`): Make the experience feel manageable.
- `section_03_copy_04` — **Copy** (HTML `p`): Readable content, accessible interactions, and visible practical detail reduce uncertainty.
- `section_03_heading_04` — **Heading** (HTML `h3`): Offer a respectful next step.
- `section_03_copy_05` — **Copy** (HTML `p`): Appointment and inquiry routes explain what happens and avoid requesting unnecessary information.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01 / UNDERSTAND
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02 / SUPPORT
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03 / CONNECT

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Experience direction

Section metadata: aria-label: `Experience direction`.

- `section_04_caption_01` — **Caption** (HTML `figcaption`): Responsive product and marketing interface direction
- `section_04_copy_01` — **Copy** (HTML `p`): Experience direction
- `section_04_heading_01` — **Heading** (HTML `h2`): Accessible, calm, and easy to navigate.
- `section_04_copy_02` — **Copy** (HTML `p`): Clear typography, predictable interactions, and responsive content help visitors find support across devices and reading contexts.
- `section_04_heading_02` — **Heading** (HTML `h3`): Clear hierarchy
- `section_04_copy_03` — **Copy** (HTML `p`): A focused narrative, useful proof points, and intentional calls to action help visitors understand where to go next.
- `section_04_heading_03` — **Heading** (HTML `h3`): Responsive by default
- `section_04_copy_04` — **Copy** (HTML `p`): Content and interactions adapt around real screen sizes, accessibility needs, and different reading contexts.
- `section_04_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_04_inline_text_02` — **Inline Text** (HTML `span`): 02

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_01_alt` (**Text**): Animated responsive experience direction for Wellness within reach

Repeated content: 2 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 05. Project deliverables and timeline

Section metadata: aria-label: `Project deliverables and timeline`.

- `section_05_copy_01` — **Copy** (HTML `p`): Artefacts and delivery
- `section_05_heading_01` — **Heading** (HTML `h2`): The system behind the final screens.
- `section_05_copy_02` — **Copy** (HTML `p`): Illustrative deliverables and a sample sequence showing how this concept could become a real engagement.
- `section_05_caption_01` — **Caption** (HTML `figcaption`): Journey and content study
- `section_05_caption_02` — **Caption** (HTML `figcaption`): Responsive system study
- `section_05_copy_03` — **Copy** (HTML `p`): Illustrative deliverables
- `section_05_list_item_01` — **List Item** (HTML `li`): 01 Accessible service-content structure
- `section_05_list_item_02` — **List Item** (HTML `li`): 02 Service discovery and appointment journeys
- `section_05_list_item_03` — **List Item** (HTML `li`): 03 Privacy-conscious inquiry patterns
- `section_05_list_item_04` — **List Item** (HTML `li`): 04 Search, measurement, and handover framework
- `section_05_copy_04` — **Copy** (HTML `p`): Illustrative timeline · Scope dependent
- `section_05_list_item_05` — **List Item** (HTML `li`): Weeks 01–02 Discover and define Context, audience, content, constraints, and success measures.
- `section_05_list_item_06` — **List Item** (HTML `li`): Weeks 03–04 Design the system Journeys, visual direction, prototypes, and review.
- `section_05_list_item_07` — **List Item** (HTML `li`): Weeks 05–07 Build and integrate Responsive implementation, content, and quality checks.
- `section_05_list_item_08` — **List Item** (HTML `li`): Week 08 Validate and hand over Final review, documentation, launch, and next-step planning.

Images/media:
- `section_05_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_05_image_01_alt` (**Text**): Additional project interface study
- `section_05_image_02` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_05_image_02_alt` (**Text**): Additional project interface study

### 06. Proposed success measures

Section metadata: aria-label: `Proposed success measures`.

- `section_06_copy_01` — **Copy** (HTML `p`): Proposed success measures
- `section_06_heading_01` — **Heading** (HTML `h2`): What a live project would validate.
- `section_06_copy_02` — **Copy** (HTML `p`): Evaluation criteria for a future engagement, not reported results from this concept.
- `section_06_heading_02` — **Heading** (HTML `h3`): Comprehension
- `section_06_copy_03` — **Copy** (HTML `p`): Can visitors identify the service relevant to their situation?
- `section_06_heading_03` — **Heading** (HTML `h3`): Action
- `section_06_copy_04` — **Copy** (HTML `p`): Does the content remain understandable and accessible across needs?
- `section_06_heading_04` — **Heading** (HTML `h3`): Experience quality
- `section_06_copy_05` — **Copy** (HTML `p`): Do appointment and inquiry journeys feel clear and respectful?
- `section_06_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_06_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_06_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 07. Next concept

Section metadata: aria-label: `Next concept`.

- `section_07_link_label_01` — **Link Label** (HTML `a`): Next case concept Automation with purpose. Explore how fragmented coordination could become one connected, human-reviewed workflow. Explore the next concept

Link destinations:
- `section_07_link_01_url` — Next case concept Automation with purpose. Explore how fragmented coordination could become one connected, human-reviewed workflow. Explore the next concept → `case-study-single.html`

Images/media:
- `section_07_image_01` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_07_image_01_alt` (**Text**): Animated next project concept

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
