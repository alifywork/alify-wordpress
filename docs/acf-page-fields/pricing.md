# ACF Field Inventory — `pricing`

Source: [`frontend-source/pricing.html`](../../frontend-source/pricing.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Pricing — Alify |
| `meta_description` | Textarea | Explore flexible pricing and engagement options for working with Alify. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Pricing |
| `hero_title` | Text | Clear options for ambitious ideas. |
| `hero_description` | Textarea | Explore flexible engagement options designed around different goals, project sizes, and stages of growth. |
| `hero_background` | Select/Image | neon-lines-01.webp |
| `hero_variant` | Select | mirror-right |

## Main content fields

### 01. Engagement options

Section metadata: aria-label: `Engagement options`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Engagement options
- `section_01_element_02` — **wysiwyg** (h2): A clear starting point. A scope shaped around you.
- `section_01_element_03` — **textarea** (p): No one-size-fits-all packages. Your proposal reflects scope, complexity, timing, and the t


Repeater `section_01_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 02. Compare engagements

Section metadata: aria-label: `Compare engagements`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): Compare engagements
- `section_02_element_02` — **wysiwyg** (h2): Choose the level of continuity you need.
- `section_02_element_03` — **textarea** (p): The difference is how we plan and work together—not the care applied to the deliverable.
- `section_02_element_04` — **text** (th): Engagement
- `section_02_element_05` — **text** (th): Best for
- `section_02_element_06` — **text** (th): Planning
- `section_02_element_07` — **text** (th): Delivery
- `section_02_element_08` — **text** (th): After launch
- `section_02_element_09` — **text** (th): Launch
- `section_02_element_10` — **textarea** (td): Defined project
- `section_02_element_11` — **textarea** (td): Fixed scope
- `section_02_element_12` — **textarea** (td): Milestone based
- `section_02_element_13` — **textarea** (td): Handover or support
- `section_02_element_14` — **text** (th): Grow
- `section_02_element_15` — **textarea** (td): Ongoing priorities
- `section_02_element_16` — **textarea** (td): Monthly roadmap
- `section_02_element_17` — **textarea** (td): Continuous
- `section_02_element_18` — **textarea** (td): Iteration included
- `section_02_element_19` — **text** (th): Partner
- `section_02_element_20` — **textarea** (td): Existing teams
- `section_02_element_21` — **textarea** (td): Shared roadmap
- `section_02_element_22` — **textarea** (td): Embedded
- `section_02_element_23` — **textarea** (td): Knowledge transfer


### 03. Always included

Section metadata: aria-label: `Always included`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Always included
- `section_03_element_02` — **wysiwyg** (h2): The essentials do not depend on a package.
- `section_03_element_03` — **textarea** (p): Clear ownership, thoughtful implementation, and a useful handover are part of every releva


Repeater `section_03_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Pricing questions

Section metadata: aria-label: `Pricing questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`; `data-category` = `projects`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Pricing questions
- `section_04_element_02` — **text** (h2): Before we talk numbers.
- `section_04_element_03` — **wysiwyg** (label): Search frequently asked questions
- `section_04_element_04` — **text** (button): All
- `section_04_element_05` — **text** (button): Projects
- `section_04_element_06` — **text** (button): Process
- `section_04_element_07` — **text** (button): Support
- `section_04_element_08` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 4 source items (div)
- Faq repeater `section_04_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_04_faq_01_items.element_01` — **text** (button): Why are fixed prices not shown?
  - `section_04_faq_01_items.element_02` — **textarea** (p): A meaningful price depends on the actual scope, content, integrations, timeline, and colla
  - `section_04_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
