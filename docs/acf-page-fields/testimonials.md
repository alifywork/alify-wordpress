# ACF Field Inventory — `testimonials`

Source: [`frontend-source/testimonials.html`](../../frontend-source/testimonials.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Testimonials — Alify |
| `meta_description` | Textarea | Read testimonials about partnering with the Alify digital studio. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Testimonials |
| `hero_title` | Text | What thoughtful collaboration should feel like. |
| `hero_description` | Textarea | Explore illustrative perspectives and the partnership principles that shape a thoughtful ALIFY collaboration. |
| `hero_background` | Select/Image | neon-lines-14.webp |

## Main content fields

### 01. Client perspectives

Section metadata: aria-label: `Client perspectives`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Client perspectives · Demo content
- `section_01_element_02` — **wysiwyg** (h2): What good collaboration should feel like.
- `section_01_element_03` — **textarea** (p): Clear communication, shared ownership, thoughtful craft, and a result everyone can stand b
- `section_01_element_04` — **text** (span): 01 / FEATURED PERSPECTIVE
- `section_01_element_05` — **textarea** (blockquote): “The process made a complicated brief feel manageable. Every decision had a reason, and ev
- `section_01_element_06` — **textarea** (figcaption): Product lead · SaaS concept · Demo content
- `section_01_element_07` — **textarea** (p): These are illustrative testimonials for layout purposes. Replace them with verified client


### 02. More perspectives

Section metadata: aria-label: `More perspectives`.


Testimonial group 01: 5 source items (figure)
- Testimonial repeater `section_02_testimonial_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_02_testimonial_01_items.element_01` — **text** (span): 02
  - `section_02_testimonial_01_items.element_02` — **textarea** (blockquote): “The strongest outcome was clarity. The team connected our brand, website, and product sto
  - `section_02_testimonial_01_items.element_03` — **textarea** (figcaption): Founder · Startup concept · Demo content

### 03. Partnership principles

Section metadata: aria-label: `Partnership principles`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Beyond the testimonial
- `section_03_element_02` — **wysiwyg** (h2): The partnership principles behind the words.
- `section_03_element_03` — **textarea** (p): The experience of working together matters as much as the final presentation.


Repeater `section_03_cards` — 3 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Who we help

Section metadata: aria-label: `Who we help`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Who we help
- `section_04_element_02` — **wysiwyg** (h2): Different teams. The same care.
- `section_04_element_03` — **textarea** (p): From an early-stage founder to an established in-house team, we adapt the collaboration to
- `section_04_element_04` — **text** (a): Start a conversation


Link destinations:
- `section_04_link_01_url` — Start a conversation → `contact.html`

List group 01: 6 source items (li)
- List repeater `section_04_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_04_list_01_items.element_01` — **textarea** (li): Founders

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
