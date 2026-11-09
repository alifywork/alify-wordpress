# ACF Field Inventory — `terms-and-conditions`

Source: [`frontend-source/terms-and-conditions.html`](../../frontend-source/terms-and-conditions.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

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

- `section_01_copy_01` — **Copy** (HTML `p`): Terms overview
- `section_01_heading_01` — **Heading** (HTML `h2`): Clear information, without the fine-print maze.
- `section_01_copy_02` — **Copy** (HTML `p`): On this page
- `section_01_list_item_01` — **List Item** (HTML `li`): Using this website
- `section_01_list_item_02` — **List Item** (HTML `li`): Information and project concepts
- `section_01_list_item_03` — **List Item** (HTML `li`): Inquiries and proposals
- `section_01_list_item_04` — **List Item** (HTML `li`): Intellectual property
- `section_01_list_item_05` — **List Item** (HTML `li`): Third-party services
- `section_01_list_item_06` — **List Item** (HTML `li`): Liability and changes
- `section_01_copy_03` — **Copy** (HTML `p`): Last updated: 6 November 2026. This general website template should be reviewed against the final business operations and applicable legal requirements before publication.
- `section_01_heading_02` — **Heading** (HTML `h2`): Using this website
- `section_01_copy_04` — **Copy** (HTML `p`): You may use this website for lawful informational and inquiry purposes. You must not attempt to disrupt the website, gain unauthorised access, introduce malicious code, scrape it abusively, or infringe the rights of others.
- `section_01_heading_03` — **Heading** (HTML `h2`): Information and project concepts
- `section_01_copy_05` — **Copy** (HTML `p`): Website content is provided for general information. Concept projects, illustrative case studies, demo testimonials, and engagement descriptions are not representations of verified client results or binding service commitments.
- `section_01_heading_04` — **Heading** (HTML `h2`): Inquiries and proposals
- `section_01_copy_06` — **Copy** (HTML `p`): Sending an inquiry does not create a client relationship. Services begin only when both parties accept a separate proposal or agreement defining scope, fees, timing, responsibilities, intellectual property, confidentiality, and other relevant terms.
- `section_01_heading_05` — **Heading** (HTML `h2`): Intellectual property
- `section_01_copy_07` — **Copy** (HTML `p`): The ALIFY name, website design, original content, code, and assets are protected by applicable rights unless stated otherwise. Third-party software, fonts, icons, and materials remain subject to their respective licences.
- `section_01_heading_06` — **Heading** (HTML `h2`): Third-party services
- `section_01_copy_08` — **Copy** (HTML `p`): The website may link to or rely on third-party services. We are not responsible for third-party availability, content, policies, or practices, and you should review their terms independently.
- `section_01_heading_07` — **Heading** (HTML `h2`): Liability and changes
- `section_01_copy_09` — **Copy** (HTML `p`): To the extent permitted by law, the website is provided without guarantees of uninterrupted availability or fitness for a particular purpose. Nothing excludes liability that cannot legally be excluded. These terms may be updated from time to time.

Link destinations:
- `section_01_link_01_url` — Using this website → `#legal-1`
- `section_01_link_02_url` — Information and project concepts → `#legal-2`
- `section_01_link_03_url` — Inquiries and proposals → `#legal-3`
- `section_01_link_04_url` — Intellectual property → `#legal-4`
- `section_01_link_05_url` — Third-party services → `#legal-5`
- `section_01_link_06_url` — Liability and changes → `#legal-6`

Repeated content: 6 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
