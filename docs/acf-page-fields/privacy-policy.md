# ACF Field Inventory — `privacy-policy`

Source: [`frontend-source/privacy-policy.html`](../../frontend-source/privacy-policy.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

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

- `section_01_copy_01` — **Copy** (HTML `p`): Review required before publication
- `section_01_heading_01` — **Heading** (HTML `h2`): Complete this notice with verified business and legal details.
- `section_01_copy_02` — **Copy** (HTML `p`): On this page
- `section_01_list_item_01` — **List Item** (HTML `li`): Information we collect
- `section_01_list_item_02` — **List Item** (HTML `li`): How information is used
- `section_01_list_item_03` — **List Item** (HTML `li`): Legal bases and retention
- `section_01_list_item_04` — **List Item** (HTML `li`): Sharing and processors
- `section_01_list_item_05` — **List Item** (HTML `li`): Your rights and choices
- `section_01_list_item_06` — **List Item** (HTML `li`): Contact and updates
- `section_01_copy_03` — **Copy** (HTML `p`): Review required before publication. This template contains prompts, not verified legal or business facts. Complete each section, confirm actual data practices and applicable requirements with qualified counsel, and replace this template before publication.
- `section_01_heading_02` — **Heading** (HTML `h2`): Information we collect
- `section_01_copy_04` — **Copy** (HTML `p`): Describe the personal information this website actually collects, including information submitted through forms and any technical or usage data collected by services you have enabled. Remove categories that do not apply, and identify any additional collection points.
- `section_01_heading_03` — **Heading** (HTML `h2`): How information is used
- `section_01_copy_05` — **Copy** (HTML `p`): Explain the specific purposes for which the business uses each category of information. State whether information is sold, shared, or used for advertising only after confirming the actual practices; do not retain this template wording as a factual statement.
- `section_01_heading_04` — **Heading** (HTML `h2`): Legal bases and retention
- `section_01_copy_06` — **Copy** (HTML `p`): Identify the legal basis or bases that apply in each relevant jurisdiction. Set out the real retention periods or criteria used for each information category, and confirm any statutory record-keeping requirements with qualified counsel.
- `section_01_heading_05` — **Heading** (HTML `h2`): Sharing and processors
- `section_01_copy_07` — **Copy** (HTML `p`): Name the service providers and recipient categories that actually receive personal information, explain their roles and relevant safeguards, and remove any provider or safeguard that is not in use or cannot be confirmed.
- `section_01_heading_06` — **Heading** (HTML `h2`): Your rights and choices
- `section_01_copy_08` — **Copy** (HTML `p`): List the rights available to people in the jurisdictions where the business operates, the procedure for exercising them, and the relevant supervisory authority where applicable. Confirm each right and process against the applicable law before publication.
- `section_01_heading_07` — **Heading** (HTML `h2`): Contact and updates
- `section_01_copy_09` — **Copy** (HTML `p`): Replace this sentence with a monitored contact method and explain how people can submit privacy requests. Describe the actual process for updating this notice, and keep the revision date accurate.

Link destinations:
- `section_01_link_01_url` — Information we collect → `#legal-1`
- `section_01_link_02_url` — How information is used → `#legal-2`
- `section_01_link_03_url` — Legal bases and retention → `#legal-3`
- `section_01_link_04_url` — Sharing and processors → `#legal-4`
- `section_01_link_05_url` — Your rights and choices → `#legal-5`
- `section_01_link_06_url` — Contact and updates → `#legal-6`

Repeated content: 6 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
