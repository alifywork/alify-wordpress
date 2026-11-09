# ACF Field Inventory — `terms-and-conditions`

Source: [`frontend-source/terms-and-conditions.html`](../../frontend-source/terms-and-conditions.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Terms & Conditions — Alify |
| `meta_description` | Textarea | Read the terms and conditions for using the Alify website and services. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Legal / Terms & conditions |
| `hero_title` | Text | The terms that guide our work together. |
| `hero_description` | Textarea | Review the terms and conditions that apply when using the Alify website and engaging with our services. |
| `hero_background` | Select/Image | neon-lines-09.webp |
| `hero_variant` | Select | close-up |

## Main content fields

### 01. Terms overview

Section metadata: aria-label: `Terms overview`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Terms overview
- `section_01_element_02` — **text** (h2): Clear information, without the fine-print maze.
- `section_01_element_03` — **textarea** (p): On this page
- `section_01_element_04` — **textarea** (p): Last updated: 6 November 2026. This general website template should be reviewed against th


Repeater `section_01_cards` — 6 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

List group 01: 6 source items (li)
- List repeater `section_01_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_01_list_01_items.element_01` — **text** (a): Using this website
  - `section_01_list_01_items.link_01_url` — URL for Using this website

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
