# ACF Field Inventory — `cookie-policy`

Source: [`frontend-source/cookie-policy.html`](../../frontend-source/cookie-policy.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Cookie Policy — Alify |
| `meta_description` | Textarea | Read the Alify cookie policy and learn about your cookie choices. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Legal / Cookie policy |
| `hero_title` | Text | A clear view of how cookies are used. |
| `hero_description` | Textarea | Understand the cookies and similar technologies used on our website, along with the choices available to you. |
| `hero_background` | Select/Image | neon-lines-12.webp |
| `hero_variant` | Select | soft-focus |

## Main content fields

### 01. Cookie overview

Section metadata: aria-label: `Cookie overview`.

- `section_01_copy_01` — **Copy** (HTML `p`): Cookie overview
- `section_01_heading_01` — **Heading** (HTML `h2`): Clear information, without the fine-print maze.
- `section_01_copy_02` — **Copy** (HTML `p`): On this page
- `section_01_list_item_01` — **List Item** (HTML `li`): What cookies are
- `section_01_list_item_02` — **List Item** (HTML `li`): Cookies we may use
- `section_01_list_item_03` — **List Item** (HTML `li`): Current interface storage
- `section_01_list_item_04` — **List Item** (HTML `li`): Managing your choices
- `section_01_list_item_05` — **List Item** (HTML `li`): Third-party cookies
- `section_01_list_item_06` — **List Item** (HTML `li`): Updates and contact
- `section_01_copy_03` — **Copy** (HTML `p`): Last updated: 6 November 2026. This general website template should be reviewed against the final business operations and applicable legal requirements before publication.
- `section_01_heading_02` — **Heading** (HTML `h2`): What cookies are
- `section_01_copy_04` — **Copy** (HTML `p`): Cookies are small text files stored by a website on your device. Similar technologies, such as local storage or pixels, can remember preferences, support functionality, and help understand website usage.
- `section_01_heading_03` — **Heading** (HTML `h2`): Cookies we may use
- `section_01_copy_05` — **Copy** (HTML `p`): Essential storage supports security and core functionality. Preference storage remembers choices such as dismissing an interface element. Analytics cookies may be introduced only when an analytics service is configured and, where required, consent has been obtained.
- `section_01_heading_04` — **Heading** (HTML `h2`): Current interface storage
- `section_01_copy_06` — **Copy** (HTML `p`): The current website uses session storage to remember dismissal of the mobile project prompt for the browsing session. This is functional interface storage rather than advertising tracking.
- `section_01_heading_05` — **Heading** (HTML `h2`): Managing your choices
- `section_01_copy_07` — **Copy** (HTML `p`): You can control or delete cookies through your browser settings. Blocking essential storage may affect website functionality. Browser help pages explain how to review stored data and change permissions.
- `section_01_heading_06` — **Heading** (HTML `h2`): Third-party cookies
- `section_01_copy_08` — **Copy** (HTML `p`): Embedded content, analytics, fonts, or external services may set their own cookies if added or activated. Their providers’ notices explain the relevant purposes and controls.
- `section_01_heading_07` — **Heading** (HTML `h2`): Updates and contact
- `section_01_copy_09` — **Copy** (HTML `p`): We will revise this notice when cookie usage changes. Questions can be sent to hello@alify.com . The latest revision date appears above.

Link destinations:
- `section_01_link_01_url` — What cookies are → `#legal-1`
- `section_01_link_02_url` — Cookies we may use → `#legal-2`
- `section_01_link_03_url` — Current interface storage → `#legal-3`
- `section_01_link_04_url` — Managing your choices → `#legal-4`
- `section_01_link_05_url` — Third-party cookies → `#legal-5`
- `section_01_link_06_url` — Updates and contact → `#legal-6`
- `section_01_link_07_url` — hello@alify.com → `mailto:hello@alify.com`

Repeated content: 6 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
