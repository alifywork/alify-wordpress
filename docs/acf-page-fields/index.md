# ACF Field Inventory — `index`

Source: [`frontend-source/index.html`](../../frontend-source/index.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

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

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
