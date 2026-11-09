# ACF Field Inventory — `technical-seo-experience`

Source: [`frontend-source/technical-seo-experience.html`](../../frontend-source/technical-seo-experience.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Technical SEO is experience design too. — ALIFY Journal |
| `meta_description` | Textarea | Why crawlability, performance, structure, and accessible content serve both search visibility and people. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / SEO |
| `hero_title` | Text | Technical SEO is experience design too. |
| `hero_description` | Textarea | Why crawlability, performance, structure, and accessible content serve both search visibility and people. |
| `hero_background` | Select/Image | neon-lines-11.webp |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

Structured section fields:
- `section_01_element_01` — **text** (span): SEO
- `section_01_element_02` — **text** (span): 6 min read
- `section_01_element_03` — **text** (span): By ALIFY Growth Team
- `section_01_element_04` — **text** (span): 23 October 2026
- `section_01_element_05` — **text** (a): Back to the journal
- `section_01_element_06` — **textarea** (p): Technical SEO is sometimes separated from design as though search engines and people need


Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/seo.svg`
  - `section_01_image_01_alt` (**Text**): Animated SEO article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): On this page
- `section_02_element_02` — **wysiwyg** (a): 01 Make important content reachable
- `section_02_element_03` — **wysiwyg** (a): 02 Treat performance as part of the content
- `section_02_element_04` — **wysiwyg** (a): 03 Structure meaning before metadata
- `section_02_element_05` — **wysiwyg** (a): 04 Maintain visibility after launch
- `section_02_element_06` — **text** (a): Discuss your project
- `section_02_element_07` — **wysiwyg** (figcaption): Visual framework Technical quality as a connected loop
- `section_02_element_08` — **textarea** (p): Search visibility improves alongside the usefulness of the experience.
- `section_02_element_09` — **wysiwyg** (blockquote): “The best technical SEO improvements often make the experience clearer for people at the s
- `section_02_element_10` — **textarea** (p): Key takeaways
- `section_02_element_11` — **text** (h2): Keep these four points.


Link destinations:
- `section_02_link_01_url` — 01 Make important content reachable → `#article-point-1`
- `section_02_link_02_url` — 02 Treat performance as part of the content → `#article-point-2`
- `section_02_link_03_url` — 03 Structure meaning before metadata → `#article-point-3`
- `section_02_link_04_url` — 04 Maintain visibility after launch → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

List group 01: 4 source items (li)
- List repeater `section_02_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_01_items.element_01` — **textarea** (li): Crawl and discover

List group 02: 4 source items (li)
- List repeater `section_02_list_02_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_list_02_items.element_01` — **textarea** (li): Connect search discovery to useful navigation.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

Structured section fields:
- `section_03_element_01` — **wysiwyg** (a): Previous article Where automation creates useful space.
- `section_03_element_02` — **wysiwyg** (a): Next article Build campaigns around the next decision.


Link destinations:
- `section_03_link_01_url` — Previous article Where automation creates useful space. → `useful-automation.html`
- `section_03_link_02_url` — Next article Build campaigns around the next decision. → `campaign-next-decision.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Continue reading
- `section_04_element_02` — **text** (h2): Related perspectives.
- `section_04_element_03` — **textarea** (p): Explore another connected discipline.
- `section_04_element_04` — **wysiwyg** (a): Web development A practical guide to planning a website that can grow. Read next
- `section_04_element_05` — **wysiwyg** (a): Digital marketing Build campaigns around the next decision. Read next


Link destinations:
- `section_04_link_01_url` — Web development A practical guide to planning a website that can grow. Read next → `planning-scalable-website.html`
- `section_04_link_02_url` — Digital marketing Build campaigns around the next decision. Read next → `campaign-next-decision.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
