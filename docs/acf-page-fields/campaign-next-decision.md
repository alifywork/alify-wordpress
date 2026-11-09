# ACF Field Inventory — `campaign-next-decision`

Source: [`frontend-source/campaign-next-decision.html`](../../frontend-source/campaign-next-decision.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Build campaigns around the next decision. — ALIFY Journal |
| `meta_description` | Textarea | A practical way to connect channel creative, landing experiences, and measurement around real audience intent. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Digital marketing |
| `hero_title` | Text | Build campaigns around the next decision. |
| `hero_description` | Textarea | A practical way to connect channel creative, landing experiences, and measurement around real audience intent. |
| `hero_background` | Select/Image | neon-lines-12.webp |
| `hero_variant` | Select | mirror-right |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

Structured section fields:
- `section_01_element_01` — **text** (span): Digital marketing
- `section_01_element_02` — **text** (span): 5 min read
- `section_01_element_03` — **text** (span): By ALIFY Campaign Team
- `section_01_element_04` — **text** (span): 20 October 2026
- `section_01_element_05` — **text** (a): Back to the journal
- `section_01_element_06` — **textarea** (p): A campaign becomes more coherent when every element supports the same next decision. Chann


Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_01_image_01_alt` (**Text**): Animated Digital marketing article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): On this page
- `section_02_element_02` — **wysiwyg** (a): 01 Define the audience moment
- `section_02_element_03` — **wysiwyg** (a): 02 Make one promise consistently
- `section_02_element_04` — **wysiwyg** (a): 03 Design the destination before launch
- `section_02_element_05` — **wysiwyg** (a): 04 Measure decisions, not activity alone
- `section_02_element_06` — **text** (a): Discuss your project
- `section_02_element_07` — **wysiwyg** (figcaption): Visual framework One continuous campaign journey
- `section_02_element_08` — **textarea** (p): Measurement connects the destination back to the original audience intent.
- `section_02_element_09` — **wysiwyg** (blockquote): “A campaign works when the promise, destination, and next decision feel like one continuou
- `section_02_element_10` — **textarea** (p): Key takeaways
- `section_02_element_11` — **text** (h2): Keep these four points.


Link destinations:
- `section_02_link_01_url` — 01 Define the audience moment → `#article-point-1`
- `section_02_link_02_url` — 02 Make one promise consistently → `#article-point-2`
- `section_02_link_03_url` — 03 Design the destination before launch → `#article-point-3`
- `section_02_link_04_url` — 04 Measure decisions, not activity alone → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

List group 01: 4 source items (li)
- List repeater `section_02_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_01_items.element_01` — **textarea** (li): Audience moment

List group 02: 4 source items (li)
- List repeater `section_02_list_02_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_02_items.element_01` — **textarea** (li): Start with audience context and readiness.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

Structured section fields:
- `section_03_element_01` — **wysiwyg** (a): Previous article Technical SEO is experience design too.
- `section_03_element_02` — **wysiwyg** (a): Next article A brand identity should work before it impresses.


Link destinations:
- `section_03_link_01_url` — Previous article Technical SEO is experience design too. → `technical-seo-experience.html`
- `section_03_link_02_url` — Next article A brand identity should work before it impresses. → `identity-that-works.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Continue reading
- `section_04_element_02` — **text** (h2): Related perspectives.
- `section_04_element_03` — **textarea** (p): Explore another connected discipline.
- `section_04_element_04` — **wysiwyg** (a): SEO Technical SEO is experience design too. Read next
- `section_04_element_05` — **wysiwyg** (a): Experience design Why clarity is a conversion strategy. Read next


Link destinations:
- `section_04_link_01_url` — SEO Technical SEO is experience design too. Read next → `technical-seo-experience.html`
- `section_04_link_02_url` — Experience design Why clarity is a conversion strategy. Read next → `blog-single.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/seo.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
