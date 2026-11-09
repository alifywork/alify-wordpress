# ACF Field Inventory — `privacy-policy`

Source: [`frontend-source/privacy-policy.html`](../../frontend-source/privacy-policy.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Privacy Notice Template — Alify |
| `meta_description` | Textarea | Privacy notice template for Alify. Complete and review the business-specific details before publication. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Legal / Review required |
| `hero_title` | Text | Privacy notice template. |
| `hero_description` | Textarea | Complete this template with verified details about the business and its actual data practices before publication. |
| `hero_background` | Select/Image | neon-lines-06.webp |
| `hero_variant` | Select | mirror-right |

## Main content fields

### 01. Privacy overview

Section metadata: aria-label: `Privacy overview`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Review required before publication
- `section_01_element_02` — **text** (h2): Complete this notice with verified business and legal details.
- `section_01_element_03` — **textarea** (p): On this page
- `section_01_element_04` — **textarea** (p): Review required before publication. This template contains prompts, not verified legal or


Repeater `section_01_cards` — 6 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

List group 01: 6 source items (li)
- List repeater `section_01_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_01_list_01_items.element_01` — **text** (a): Information we collect
  - `section_01_list_01_items.link_01_url` — URL for Information we collect

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
