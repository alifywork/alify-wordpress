# ACF Field Inventory — `case-studies`

Source: [`frontend-source/case-studies.html`](../../frontend-source/case-studies.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Case Studies — Alify |
| `meta_description` | Textarea | Read Alify case studies exploring digital challenges, solutions, and results. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Case studies / Archive |
| `hero_title` | Text | See the thinking behind the experience. |
| `hero_description` | Textarea | Go beyond the visuals and explore how strategy, design, and technology come together to create lasting value. |
| `hero_background` | Select/Image | neon-lines-11.webp |

## Main content fields

### 01. Featured case concept

Section metadata: aria-label: `Featured case concept`.

- `section_01_copy_01` — **Copy** (HTML `p`): Featured case concept
- `section_01_heading_01` — **Heading** (HTML `h2`): From repetitive coordination to a connected workflow.
- `section_01_copy_02` — **Copy** (HTML `p`): Explore the operational thinking behind the concept—not just the final interface.
- `section_01_copy_03` — **Copy** (HTML `p`): Concept case study · AI workflow
- `section_01_heading_02` — **Heading** (HTML `h2`): Automation with purpose.
- `section_01_copy_04` — **Copy** (HTML `p`): An illustrative operations transformation showing how discovery, service design, and automation could connect a fragmented everyday workflow.
- `section_01_term_01` — **Term** (HTML `dt`): Challenge
- `section_01_definition_01` — **Definition** (HTML `dd`): Repetitive coordination
- `section_01_term_02` — **Term** (HTML `dt`): Response
- `section_01_definition_02` — **Definition** (HTML `dd`): Connected human-reviewed flow
- `section_01_term_03` — **Term** (HTML `dt`): Validate
- `section_01_definition_03` — **Definition** (HTML `dd`): Time, accuracy, confidence
- `section_01_link_label_01` — **Link Label** (HTML `a`): Read the concept case study

Link destinations:
- `section_01_link_01_url` — [image/icon-only link] → `case-study-single.html`
- `section_01_link_02_url` — Read the concept case study → `case-study-single.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_01_image_01_alt` (**Text**): Animated human-reviewed automation workflow

Repeated content: 1 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 02. Case study archive

Section metadata: aria-label: `Case study archive`.

Interaction/filter data: `data-filter` = `all`; `data-filter` = `product`; `data-filter` = `brand`; `data-filter` = `growth`; `data-category` = `product`; `data-category` = `product`; `data-category` = `brand`; `data-category` = `growth`.

- `section_02_copy_01` — **Copy** (HTML `p`): Case study archive
- `section_02_heading_01` — **Heading** (HTML `h2`): Challenge. Response. Validation.
- `section_02_copy_02` — **Copy** (HTML `p`): Illustrative concept case studies. Each story has its own dedicated destination and proposed success measures.
- `section_02_button_label_01` — **Button Label** (HTML `button`): All
- `section_02_button_label_02` — **Button Label** (HTML `button`): Product
- `section_02_button_label_03` — **Button Label** (HTML `button`): Brand
- `section_02_button_label_04` — **Button Label** (HTML `button`): Growth
- `section_02_link_label_01` — **Link Label** (HTML `a`): Concept case · Product Automation with purpose Challenge: Fragmented manual coordination. Response: One visible, human-reviewed workflow. Read the case
- `section_02_link_label_02` — **Link Label** (HTML `a`): Concept case · Product Fintech, reimagined Challenge: Technical language hides product value. Response: One clear story and flexible product system. Read the case
- `section_02_link_label_03` — **Link Label** (HTML `a`): Concept case · Brand A distinct new identity Challenge: An evolved offer outgrows its old identity. Response: A recognisable, flexible visual language. Read the case
- `section_02_link_label_04` — **Link Label** (HTML `a`): Concept case · Growth Commerce without friction Challenge: Choice and uncertainty slow decisions. Response: A connected discovery-to-purchase journey. Read the case

Link destinations:
- `section_02_link_01_url` — Concept case · Product Automation with purpose Challenge: Fragmented manual coordination. Response: One visible, human-reviewed workflow. Read the case → `case-study-single.html`
- `section_02_link_02_url` — Concept case · Product Fintech, reimagined Challenge: Technical language hides product value. Response: One clear story and flexible product system. Read the case → `project-single.html`
- `section_02_link_03_url` — Concept case · Brand A distinct new identity Challenge: An evolved offer outgrows its old identity. Response: A recognisable, flexible visual language. Read the case → `identity-project.html`
- `section_02_link_04_url` — Concept case · Growth Commerce without friction Challenge: Choice and uncertainty slow decisions. Response: A connected discovery-to-purchase journey. Read the case → `commerce-project.html`

Images/media:
- `section_02_image_01` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_02_image_01_alt` (**Text**): Automation case concept
- `section_02_image_02` (**Image**): `assets/images/services/web-development.svg`
  - `section_02_image_02_alt` (**Text**): Fintech case concept
- `section_02_image_03` (**Image**): `assets/images/services/logo-design.svg`
  - `section_02_image_03_alt` (**Text**): Identity case concept
- `section_02_image_04` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_02_image_04_alt` (**Text**): Commerce growth case concept

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. How we measure

Section metadata: aria-label: `How we measure`.

- `section_03_copy_01` — **Copy** (HTML `p`): How we measure
- `section_03_heading_01` — **Heading** (HTML `h2`): Success defined before the solution.
- `section_03_copy_02` — **Copy** (HTML `p`): A useful case study connects the work to business goals, human behaviour, and learning over time.
- `section_03_heading_02` — **Heading** (HTML `h3`): Business alignment
- `section_03_copy_03` — **Copy** (HTML `p`): The project begins with a clear connection to the commercial or operational goal.
- `section_03_heading_03` — **Heading** (HTML `h3`): Behaviour and outcomes
- `section_03_copy_04` — **Copy** (HTML `p`): Measures might include activation, conversion, completion, efficiency, or qualified inquiries.
- `section_03_heading_04` — **Heading** (HTML `h3`): Learning over time
- `section_03_copy_05` — **Copy** (HTML `p`): A launch is a point of learning. Measurement informs the next meaningful iteration.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
