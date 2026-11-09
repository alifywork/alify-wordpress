# ACF Field Inventory — `about`

Source: [`frontend-source/about.html`](../../frontend-source/about.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | About Us — Alify |
| `meta_description` | Textarea | Learn about Alify, our independent digital studio, and our approach to design and technology. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | About us |
| `hero_title` | Text | Curious minds. Thoughtful work. Shared ambition. |
| `hero_description` | Textarea | Get to know the independent studio behind Alify and the ideas, values, and collaboration that shape our work. |
| `hero_background` | Select/Image | neon-lines-02.webp |

## Main content fields

### 01. Studio introduction

Section metadata: aria-label: `Studio introduction`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): The studio
- `section_01_element_02` — **wysiwyg** (h2): Small team energy. Full studio capability.
- `section_01_element_03` — **textarea** (p): ALIFY is an independent digital studio for teams that value clear thinking, expressive des


Images/media:
- `section_01_image_01` (**Image**): `assets/images/industries/startups-ventures.jpg`
  - `section_01_image_01_alt` (**Text**): Creative team collaborating around a studio table

List group 01: 5 source items (li)
- List repeater `section_01_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_01_list_01_items.element_01` — **textarea** (li): Strategy

### 02. Studio principles

Section metadata: aria-label: `Studio principles`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): What guides us
- `section_02_element_02` — **text** (h2): Principles before process.
- `section_02_element_03` — **textarea** (p): The values that shape our conversations, decisions, and craft.


Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. Our process

Section metadata: aria-label: `Our process`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): How we think
- `section_03_element_02` — **text** (h2): Connected disciplines. Better decisions.
- `section_03_element_03` — **textarea** (p): Brand, product, and technology inform one another throughout the work.


Repeater `section_03_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 04. Studio culture

Section metadata: aria-label: `Studio culture`.

Structured section fields:
- `section_04_element_01` — **textarea** (p): Our working style
- `section_04_element_02` — **wysiwyg** (h2): Enough structure. Never unnecessary layers.
- `section_04_element_03` — **textarea** (p): You speak with the people shaping and making the work. The team and process adapt to the b
- `section_04_element_04` — **text** (a): Start a conversation


Link destinations:
- `section_04_link_01_url` — Start a conversation → `contact.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/industries/technology-saas.jpg`
  - `section_04_image_01_alt` (**Text**): Digital colleagues reviewing a product together

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
