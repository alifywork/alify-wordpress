# ACF Field Inventory — `identity-project`

Source: [`frontend-source/identity-project.html`](../../frontend-source/identity-project.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | A distinct new identity — Alify |
| `meta_description` | Textarea | An identity concept connecting strategic positioning, a distinctive mark, and a flexible visual language. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Projects / Brand identity |
| `hero_title` | Text | Make the brand recognisable everywhere. |
| `hero_description` | Textarea | An identity concept connecting strategic positioning, a distinctive mark, and a flexible visual language. |
| `hero_background` | Select/Image | neon-lines-14.webp |
| `hero_variant` | Select | soft-focus |

## Main content fields

### 01. Project overview

Section metadata: aria-label: `Project overview`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Concept project · Brand identity
- `section_01_element_02` — **text** (h2): A distinct new identity.
- `section_01_element_03` — **textarea** (p): A brand identity concept designed to turn a clear strategic idea into a coherent system ac
- `section_01_element_04` — **textarea** (p): Illustrative concept created to demonstrate our approach—not a verified client engagement.
- `section_01_element_05` — **text** (dt): Sector
- `section_01_element_06` — **textarea** (dd): Brand identity
- `section_01_element_07` — **text** (dt): Scope
- `section_01_element_08` — **textarea** (dd): Positioning, identity, digital direction
- `section_01_element_09` — **text** (dt): Focus
- `section_01_element_10` — **textarea** (dd): Recognition, coherence, flexibility
- `section_01_element_11` — **text** (dt): Status
- `section_01_element_12` — **textarea** (dd): Illustrative concept


Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/logo-design.svg`
  - `section_01_image_01_alt` (**Text**): Animated A distinct new identity project concept

### 02. The challenge

Section metadata: aria-label: `The challenge`.

Structured section fields:
- `section_02_element_01` — **text** (span): 01
- `section_02_element_02` — **textarea** (p): The challenge
- `section_02_element_03` — **text** (h2): A new offer needs more than a new mark.
- `section_02_element_04` — **textarea** (p): A brand identity concept designed to turn a clear strategic idea into a coherent system ac
- `section_02_element_05` — **textarea** (p): The concept begins with a business that has evolved beyond its original identity. The chal
- `section_02_element_06` — **textarea** (p): The brief in four moves


List group 01: 4 source items (li)
- List repeater `section_02_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_01_items.element_01` — **text** (span): 01

### 03. The response

Section metadata: aria-label: `The response`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): The response
- `section_03_element_02` — **text** (h2): One recognisable idea. A flexible identity system.
- `section_03_element_03` — **textarea** (p): Strategy, content, interface design, and technology connect around one clear experience.


Repeater `section_03_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Experience direction

Section metadata: aria-label: `Experience direction`.

Structured section fields:
- `section_04_element_01` — **textarea** (figcaption): Responsive product and marketing interface direction
- `section_04_element_02` — **textarea** (p): Experience direction
- `section_04_element_03` — **text** (h2): A system built for real touchpoints.
- `section_04_element_04` — **textarea** (p): The identity extends into responsive digital patterns so the brand feels consistent wherev


Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_04_image_01_alt` (**Text**): Animated responsive experience direction for A distinct new identity

Repeater `section_04_cards` — 2 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 05. Project deliverables and timeline

Section metadata: aria-label: `Project deliverables and timeline`.

Structured section fields:
- `section_05_element_01` — **textarea** (p): Artefacts and delivery
- `section_05_element_02` — **wysiwyg** (h2): The system behind the final screens.
- `section_05_element_03` — **textarea** (p): Illustrative deliverables and a sample sequence showing how this concept could become a re
- `section_05_element_04` — **textarea** (p): Illustrative deliverables
- `section_05_element_05` — **textarea** (p): Illustrative timeline · Scope dependent


List group 01: 4 source items (li)
- List repeater `section_05_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_list_01_items.element_01` — **text** (span): 01

List group 02: 4 source items (li)
- List repeater `section_05_list_02_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_list_02_items.element_01` — **text** (span): Weeks 01–02
  - `section_05_list_02_items.element_02` — **text** (strong): Discover and define
  - `section_05_list_02_items.element_03` — **textarea** (p): Context, audience, content, constraints, and success measures.

Project group 03: 2 source items (figure)
- Project repeater `section_05_project_03_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_05_project_03_items.element_01` — **textarea** (figcaption): Journey and content study
  - `section_05_project_03_items.image_01` and `section_05_project_03_items.image_01_alt` — image and alternative text

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
- `section_07_element_01` — **wysiwyg** (a): Next case concept Property, made personal. Explore a property experience that balances vis


Link destinations:
- `section_07_link_01_url` — Next case concept Property, made personal. Explore a property experience that balances visual storytelling with practical decision-making. Explore the next concept → `property-project.html`

Images/media:
- `section_07_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_07_image_01_alt` (**Text**): Animated next project concept

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
