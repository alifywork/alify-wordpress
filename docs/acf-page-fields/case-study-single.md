# ACF Field Inventory — `case-study-single`

Source: [`frontend-source/case-study-single.html`](../../frontend-source/case-study-single.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Automation with purpose — Alify |
| `meta_description` | Textarea | An illustrative operations case study connecting fragmented manual tasks into one visible, human-reviewed workflow. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Projects / AI workflow |
| `hero_title` | Text | Less repetition. More meaningful work. |
| `hero_description` | Textarea | An illustrative operations case study connecting fragmented manual tasks into one visible, human-reviewed workflow. |
| `hero_background` | Select/Image | neon-lines-12.webp |

## Main content fields

### 01. Project overview

Section metadata: aria-label: `Project overview`.

- `section_01_copy_01` — **Copy** (HTML `p`): Concept project · AI workflow
- `section_01_heading_01` — **Heading** (HTML `h2`): Automation with purpose.
- `section_01_copy_02` — **Copy** (HTML `p`): An operations concept exploring how structured intake, assisted routing, and human review could reduce repetitive coordination.
- `section_01_copy_03` — **Copy** (HTML `p`): Illustrative concept created to demonstrate our approach—not a verified client engagement.
- `section_01_term_01` — **Term** (HTML `dt`): Sector
- `section_01_definition_01` — **Definition** (HTML `dd`): AI workflow
- `section_01_term_02` — **Term** (HTML `dt`): Scope
- `section_01_definition_02` — **Definition** (HTML `dd`): Workflow research, service design, prototype
- `section_01_term_03` — **Term** (HTML `dt`): Focus
- `section_01_definition_03` — **Definition** (HTML `dd`): Intake, routing, review, reporting
- `section_01_term_04` — **Term** (HTML `dt`): Status
- `section_01_definition_04` — **Definition** (HTML `dd`): Illustrative concept

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_01_image_01_alt` (**Text**): Animated Automation with purpose project concept

### 02. The challenge

Section metadata: aria-label: `The challenge`.

- `section_02_copy_01` — **Copy** (HTML `p`): The challenge
- `section_02_heading_01` — **Heading** (HTML `h2`): Good people spending time on repetitive coordination.
- `section_02_copy_02` — **Copy** (HTML `p`): An operations concept exploring how structured intake, assisted routing, and human review could reduce repetitive coordination.
- `section_02_copy_03` — **Copy** (HTML `p`): The hypothetical team moves information between inboxes, documents, spreadsheets, and internal tools. Duplicated effort is visible, but inconsistent intake and unclear ownership create the underlying friction.
- `section_02_copy_04` — **Copy** (HTML `p`): The brief in four moves
- `section_02_list_item_01` — **List Item** (HTML `li`): 01 Observe triggers, handoffs, and exceptions
- `section_02_list_item_02` — **List Item** (HTML `li`): 02 Separate deterministic rules from judgement
- `section_02_list_item_03` — **List Item** (HTML `li`): 03 Prototype one contained operational workflow
- `section_02_list_item_04` — **List Item** (HTML `li`): 04 Define controls, fallbacks, and useful measures
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01

### 03. The response

Section metadata: aria-label: `The response`.

- `section_03_copy_01` — **Copy** (HTML `p`): The response
- `section_03_heading_01` — **Heading** (HTML `h2`): A connected flow with visible human control.
- `section_03_copy_02` — **Copy** (HTML `p`): Strategy, content, interface design, and technology connect around one clear experience.
- `section_03_heading_02` — **Heading** (HTML `h3`): Structure information at the start.
- `section_03_copy_03` — **Copy** (HTML `p`): Relevant information arrives in one consistent format instead of being reconstructed from disconnected messages.
- `section_03_heading_03` — **Heading** (HTML `h3`): Assist the repeatable decisions.
- `section_03_copy_04` — **Copy** (HTML `p`): Rules and AI-supported classification suggest the next step while exceptions remain visible.
- `section_03_heading_04` — **Heading** (HTML `h3`): Keep people accountable.
- `section_03_copy_05` — **Copy** (HTML `p`): People approve sensitive or uncertain outputs before they move into downstream systems.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01 / INTAKE
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02 / ROUTE
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03 / REVIEW

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Experience direction

Section metadata: aria-label: `Experience direction`.

- `section_04_caption_01` — **Caption** (HTML `figcaption`): Responsive product and marketing interface direction
- `section_04_copy_01` — **Copy** (HTML `p`): Experience direction
- `section_04_heading_01` — **Heading** (HTML `h2`): Operational clarity without automation theatre.
- `section_04_copy_02` — **Copy** (HTML `p`): A simple operational view highlights progress, exceptions, ownership, and opportunities to improve the workflow over time.
- `section_04_heading_02` — **Heading** (HTML `h3`): Clear hierarchy
- `section_04_copy_03` — **Copy** (HTML `p`): A focused narrative, useful proof points, and intentional calls to action help visitors understand where to go next.
- `section_04_heading_03` — **Heading** (HTML `h3`): Responsive by default
- `section_04_copy_04` — **Copy** (HTML `p`): Content and interactions adapt around real screen sizes, accessibility needs, and different reading contexts.
- `section_04_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_04_inline_text_02` — **Inline Text** (HTML `span`): 02

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_01_alt` (**Text**): Animated responsive experience direction for Automation with purpose

Repeated content: 2 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 05. Workflow artefacts and delivery

Section metadata: aria-label: `Workflow artefacts and delivery`.

- `section_05_copy_01` — **Copy** (HTML `p`): Workflow artefacts
- `section_05_heading_01` — **Heading** (HTML `h2`): Make the work visible before automating it.
- `section_05_copy_02` — **Copy** (HTML `p`): The concept maps the current friction, future flow, and human controls before defining implementation.
- `section_05_heading_02` — **Heading** (HTML `h3`): Work reconstructed at every step.
- `section_05_list_item_01` — **List Item** (HTML `li`): Inbox request
- `section_05_list_item_02` — **List Item** (HTML `li`): Manual data copy
- `section_05_list_item_03` — **List Item** (HTML `li`): Unclear routing
- `section_05_list_item_04` — **List Item** (HTML `li`): Status follow-up
- `section_05_heading_03` — **Heading** (HTML `h3`): One visible flow with review.
- `section_05_list_item_05` — **List Item** (HTML `li`): Structured intake
- `section_05_list_item_06` — **List Item** (HTML `li`): Assisted classification
- `section_05_list_item_07` — **List Item** (HTML `li`): Human approval
- `section_05_list_item_08` — **List Item** (HTML `li`): Tracked action
- `section_05_copy_03` — **Copy** (HTML `p`): Formatting, classification suggestions, notifications, and status updates.
- `section_05_copy_04` — **Copy** (HTML `p`): Sensitive outputs, low-confidence classifications, and downstream actions.
- `section_05_copy_05` — **Copy** (HTML `p`): Missing data, exceptions, unavailable integrations, and manual ownership.
- `section_05_copy_06` — **Copy** (HTML `p`): Illustrative deliverables
- `section_05_list_item_09` — **List Item** (HTML `li`): 01 Current-state workflow and exception map
- `section_05_list_item_10` — **List Item** (HTML `li`): 02 Future-state service blueprint and controls
- `section_05_list_item_11` — **List Item** (HTML `li`): 03 Interactive prototype and integration plan
- `section_05_list_item_12` — **List Item** (HTML `li`): 04 Validation dashboard and operational handover
- `section_05_copy_07` — **Copy** (HTML `p`): Illustrative timeline · Scope dependent
- `section_05_list_item_13` — **List Item** (HTML `li`): Weeks 01–02 Observe and map Triggers, handoffs, exceptions, data, and baseline measures.
- `section_05_list_item_14` — **List Item** (HTML `li`): Weeks 03–04 Design and prototype Future flow, controls, integrations, and one complete slice.
- `section_05_list_item_15` — **List Item** (HTML `li`): Weeks 05–06 Validate and refine Real scenarios, review behaviour, fallbacks, and measurement.
- `section_05_list_item_16` — **List Item** (HTML `li`): Week 07 Document and hand over Operating guidance, ownership, and phased rollout plan.
- `section_05_inline_text_01` — **Inline Text** (HTML `span`): Current state · Fragmented
- `section_05_inline_text_02` — **Inline Text** (HTML `span`): Proposed state · Connected
- `section_05_inline_text_03` — **Inline Text** (HTML `span`): Automate
- `section_05_inline_text_04` — **Inline Text** (HTML `span`): Review
- `section_05_inline_text_05` — **Inline Text** (HTML `span`): Fallback

Repeated content: 2 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 06. Proposed success measures

Section metadata: aria-label: `Proposed success measures`.

- `section_06_copy_01` — **Copy** (HTML `p`): Proposed success measures
- `section_06_heading_01` — **Heading** (HTML `h2`): What a live project would validate.
- `section_06_copy_02` — **Copy** (HTML `p`): Evaluation criteria for a future engagement, not reported results from this concept.
- `section_06_heading_02` — **Heading** (HTML `h3`): Comprehension
- `section_06_copy_03` — **Copy** (HTML `p`): Do handling time and manual handoffs decrease against the baseline?
- `section_06_heading_03` — **Heading** (HTML `h3`): Action
- `section_06_copy_04` — **Copy** (HTML `p`): Are review changes, errors, fallbacks, and ownership visible?
- `section_06_heading_04` — **Heading** (HTML `h3`): Experience quality
- `section_06_copy_05` — **Copy** (HTML `p`): Do team members find the workflow easier to control and improve?
- `section_06_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_06_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_06_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 07. Next concept

Section metadata: aria-label: `Next concept`.

- `section_07_link_label_01` — **Link Label** (HTML `a`): Next case concept Commerce without friction. Explore a commerce journey designed around discovery, reassurance, and confident action. Explore the next concept

Link destinations:
- `section_07_link_01_url` — Next case concept Commerce without friction. Explore a commerce journey designed around discovery, reassurance, and confident action. Explore the next concept → `commerce-project.html`

Images/media:
- `section_07_image_01` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_07_image_01_alt` (**Text**): Animated next project concept

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
