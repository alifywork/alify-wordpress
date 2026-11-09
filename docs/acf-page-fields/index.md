# ACF Field Inventory — `index`

Source: [`frontend-source/index.html`](../../frontend-source/index.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Alify — Strategy, Design & Digital Experiences |
| `meta_description` | Textarea | Alify is an independent digital studio creating strategic brands, websites, and digital experiences. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Independent digital studio |
| `hero_title` | Text | Digital experiences that move brands forward. |
| `hero_description` | Textarea | We unite strategy, thoughtful design, and creative technology to build meaningful digital experiences for ambitious brands. |
| `hero_background` | Image/Select | assets/images/background/neon-lines-01.webp |

## Main content fields

### 01. Section 01

Structured section fields:
- `section_01_element_01` — **textarea** (p): Independent digital studio
- `section_01_element_02` — **text** (h1): Digital experiences that move brands forward.
- `section_01_element_03` — **textarea** (p): We unite strategy, thoughtful design, and creative technology to build meaningful digital
- `section_01_element_04` — **text** (a): Start a project
- `section_01_element_05` — **text** (a): View case studies


Link destinations:
- `section_01_link_01_url` — Start a project → `start-project.html`
- `section_01_link_02_url` — View case studies → `case-studies.html`

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
