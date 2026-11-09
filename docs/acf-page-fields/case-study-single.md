# ACF Field Inventory — `case-study-single`

Source: [`frontend-source/case-study-single.html`](../../frontend-source/case-study-single.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

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

Structured section fields:
- `section_01_element_01` — **textarea** (p): Concept project · AI workflow
- `section_01_element_02` — **text** (h2): Automation with purpose.
- `section_01_element_03` — **textarea** (p): An operations concept exploring how structured intake, assisted routing, and human review
- `section_01_element_04` — **textarea** (p): Illustrative concept created to demonstrate our approach—not a verified client engagement.
- `section_01_element_05` — **text** (dt): Sector
- `section_01_element_06` — **textarea** (dd): AI workflow
- `section_01_element_07` — **text** (dt): Scope
- `section_01_element_08` — **textarea** (dd): Workflow research, service design, prototype
- `section_01_element_09` — **text** (dt): Focus
- `section_01_element_10` — **textarea** (dd): Intake, routing, review, reporting
- `section_01_element_11` — **text** (dt): Status
- `section_01_element_12` — **textarea** (dd): Illustrative concept


Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_01_image_01_alt` (**Text**): Animated Automation with purpose project concept

### 02. The challenge

Section metadata: aria-label: `The challenge`.

Structured section fields:
- `section_02_element_01` — **text** (span): 01
- `section_02_element_02` — **textarea** (p): The challenge
- `section_02_element_03` — **text** (h2): Good people spending time on repetitive coordination.
- `section_02_element_04` — **textarea** (p): An operations concept exploring how structured intake, assisted routing, and human review
- `section_02_element_05` — **textarea** (p): The hypothetical team moves information between inboxes, documents, spreadsheets, and inte
- `section_02_element_06` — **textarea** (p): The brief in four moves


List group 01: 4 source items (li)
- List repeater `section_02_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_01_items.element_01` — **text** (span): 01

### 03. The response

Section metadata: aria-label: `The response`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): The response
- `section_03_element_02` — **text** (h2): A connected flow with visible human control.
- `section_03_element_03` — **textarea** (p): Strategy, content, interface design, and technology connect around one clear experience.


Repeater `section_03_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Experience direction

Section metadata: aria-label: `Experience direction`.

Structured section fields:
- `section_04_element_01` — **textarea** (figcaption): Responsive product and marketing interface direction
- `section_04_element_02` — **textarea** (p): Experience direction
- `section_04_element_03` — **text** (h2): Operational clarity without automation theatre.
- `section_04_element_04` — **textarea** (p): A simple operational view highlights progress, exceptions, ownership, and opportunities to


Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_01_alt` (**Text**): Animated responsive experience direction for Automation with purpose

Repeater `section_04_cards` — 2 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 05. Workflow artefacts and delivery

Section metadata: aria-label: `Workflow artefacts and delivery`.

Structured section fields:
- `section_05_element_01` — **textarea** (p): Workflow artefacts
- `section_05_element_02` — **wysiwyg** (h2): Make the work visible before automating it.
- `section_05_element_03` — **textarea** (p): The concept maps the current friction, future flow, and human controls before defining imp
- `section_05_element_04` — **text** (span): Automate
- `section_05_element_05` — **textarea** (p): Formatting, classification suggestions, notifications, and status updates.
- `section_05_element_06` — **text** (span): Review
- `section_05_element_07` — **textarea** (p): Sensitive outputs, low-confidence classifications, and downstream actions.
- `section_05_element_08` — **text** (span): Fallback
- `section_05_element_09` — **textarea** (p): Missing data, exceptions, unavailable integrations, and manual ownership.
- `section_05_element_10` — **textarea** (p): Illustrative deliverables
- `section_05_element_11` — **textarea** (p): Illustrative timeline · Scope dependent


Repeater `section_05_cards` — 2 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

List group 01: 4 source items (li)
- List repeater `section_05_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_list_01_items.element_01` — **text** (span): 01

List group 02: 4 source items (li)
- List repeater `section_05_list_02_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_list_02_items.element_01` — **text** (span): Weeks 01–02
  - `section_05_list_02_items.element_02` — **text** (strong): Observe and map
  - `section_05_list_02_items.element_03` — **textarea** (p): Triggers, handoffs, exceptions, data, and baseline measures.

### 06. Proposed success measures

Section metadata: aria-label: `Proposed success measures`.

Structured section fields:
- `section_06_element_01` — **textarea** (p): Proposed success measures
- `section_06_element_02` — **text** (h2): What a live project would validate.
- `section_06_element_03` — **textarea** (p): Evaluation criteria for a future engagement, not reported results from this concept.


Repeater `section_06_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 07. Next concept

Section metadata: aria-label: `Next concept`.

Structured section fields:
- `section_07_element_01` — **wysiwyg** (a): Next case concept Commerce without friction. Explore a commerce journey designed around di


Link destinations:
- `section_07_link_01_url` — Next case concept Commerce without friction. Explore a commerce journey designed around discovery, reassurance, and confident action. Explore the next concept → `commerce-project.html`

Images/media:
- `section_07_image_01` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_07_image_01_alt` (**Text**): Animated next project concept

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
