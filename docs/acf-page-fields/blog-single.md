# ACF Field Inventory — `blog-single`

Source: [`frontend-source/blog-single.html`](../../frontend-source/blog-single.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Why clarity is a conversion strategy. — ALIFY Journal |
| `meta_description` | Textarea | How clear hierarchy, useful content, and intentional journeys help people make confident decisions. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Experience design |
| `hero_title` | Text | Why clarity is a conversion strategy. |
| `hero_description` | Textarea | How clear hierarchy, useful content, and intentional journeys help people make confident decisions. |
| `hero_background` | Select/Image | neon-lines-06.webp |
| `hero_variant` | Select | close-up |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

Structured section fields:
- `section_01_element_01` — **text** (span): Experience design
- `section_01_element_02` — **text** (span): 6 min read
- `section_01_element_03` — **text** (span): By ALIFY Design Team
- `section_01_element_04` — **text** (span): 6 November 2026
- `section_01_element_05` — **text** (a): Back to the journal
- `section_01_element_06` — **textarea** (p): Conversion is often discussed as a button, a headline, or a persuasion technique. In pract


Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_01_image_01_alt` (**Text**): Animated Experience design article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): On this page
- `section_02_element_02` — **wysiwyg** (a): 01 Start with the decision, not the page
- `section_02_element_03` — **wysiwyg** (a): 02 Make the hierarchy do the work
- `section_02_element_04` — **wysiwyg** (a): 03 Remove uncertainty before adding persuasion
- `section_02_element_05` — **wysiwyg** (a): 04 Design the next step as part of the story
- `section_02_element_06` — **text** (a): Discuss your project
- `section_02_element_07` — **wysiwyg** (figcaption): Visual framework A clearer decision hierarchy
- `section_02_element_08` — **textarea** (p): Each layer answers the next question instead of competing for attention.
- `section_02_element_09` — **wysiwyg** (blockquote): “The strongest digital experiences make the important thing easier to understand—and the n
- `section_02_element_10` — **textarea** (p): Key takeaways
- `section_02_element_11` — **text** (h2): Keep these four points.


Link destinations:
- `section_02_link_01_url` — 01 Start with the decision, not the page → `#article-point-1`
- `section_02_link_02_url` — 02 Make the hierarchy do the work → `#article-point-2`
- `section_02_link_03_url` — 03 Remove uncertainty before adding persuasion → `#article-point-3`
- `section_02_link_04_url` — 04 Design the next step as part of the story → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

List group 01: 4 source items (li)
- List repeater `section_02_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_01_items.element_01` — **textarea** (li): Relevance

List group 02: 4 source items (li)
- List repeater `section_02_list_02_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_02_items.element_01` — **textarea** (li): Define the visitor decision before designing the page.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

Structured section fields:
- `section_03_element_01` — **wysiwyg** (a): Previous article A brand identity should work before it impresses.
- `section_03_element_02` — **wysiwyg** (a): Next article A practical guide to planning a website that can grow.


Link destinations:
- `section_03_link_01_url` — Previous article A brand identity should work before it impresses. → `identity-that-works.html`
- `section_03_link_02_url` — Next article A practical guide to planning a website that can grow. → `planning-scalable-website.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Continue reading
- `section_04_element_02` — **text** (h2): Related perspectives.
- `section_04_element_03` — **textarea** (p): Explore another connected discipline.
- `section_04_element_04` — **wysiwyg** (a): Brand identity A brand identity should work before it impresses. Read next
- `section_04_element_05` — **wysiwyg** (a): Digital marketing Build campaigns around the next decision. Read next


Link destinations:
- `section_04_link_01_url` — Brand identity A brand identity should work before it impresses. Read next → `identity-that-works.html`
- `section_04_link_02_url` — Digital marketing Build campaigns around the next decision. Read next → `campaign-next-decision.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/logo-design.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
