# ACF Field Inventory — `faqs`

Source: [`frontend-source/faqs.html`](../../frontend-source/faqs.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | FAQs — Alify |
| `meta_description` | Textarea | Frequently asked questions about working with Alify. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Frequently asked questions |
| `hero_title` | Text | Good questions deserve clear answers. |
| `hero_description` | Textarea | Find helpful answers about our process, services, timelines, collaboration, and what to expect when working with Alify. |
| `hero_background` | Select/Image | neon-lines-13.webp |

## Main content fields

### 01. Frequently asked questions

Section metadata: aria-label: `Frequently asked questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `process`; `data-category` = `process`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `support`; `data-category` = `support`; `data-category` = `support`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Frequently asked questions
- `section_01_element_02` — **text** (h2): Everything you might want to ask.
- `section_01_element_03` — **textarea** (p): Search the essentials or filter by topic to find a clear answer before we begin.
- `section_01_element_04` — **wysiwyg** (label): Search frequently asked questions
- `section_01_element_05` — **text** (button): All
- `section_01_element_06` — **text** (button): Projects
- `section_01_element_07` — **text** (button): Process
- `section_01_element_08` — **text** (button): Support
- `section_01_element_09` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 12 source items (div)
- Faq repeater `section_01_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_01_faq_01_items.element_01` — **text** (button): What services does ALIFY provide?
  - `section_01_faq_01_items.element_02` — **textarea** (p): Web development, SEO, digital marketing, AI automation, UI UX design, and logo design. The
  - `section_01_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
