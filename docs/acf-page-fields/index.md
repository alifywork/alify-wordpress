# ACF Field Inventory — `index`

Source: [`frontend-source/index.html`](../../frontend-source/index.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

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

- `section_01_copy_01` — **Copy** (HTML `p`): Independent digital studio
- `section_01_heading_01` — **Heading** (HTML `h1`): Digital experiences that move brands forward.
- `section_01_copy_02` — **Copy** (HTML `p`): We unite strategy, thoughtful design, and creative technology to build meaningful digital experiences for ambitious brands.
- `section_01_link_label_01` — **Link Label** (HTML `a`): Start a project
- `section_01_link_label_02` — **Link Label** (HTML `a`): View case studies

Link destinations:
- `section_01_link_01_url` — Start a project → `start-project.html`
- `section_01_link_02_url` — View case studies → `case-studies.html`

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
