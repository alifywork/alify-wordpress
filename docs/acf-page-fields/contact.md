# ACF Field Inventory — `contact`

Source: [`frontend-source/contact.html`](../../frontend-source/contact.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Contact Us — Alify |
| `meta_description` | Textarea | Contact Alify to discuss your next brand, website, or digital experience. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Contact us |
| `hero_title` | Text | Let’s start a meaningful conversation. |
| `hero_description` | Textarea | Tell us what you are working on, where you want to go, and how we can help you move forward. |
| `hero_background` | Select/Image | neon-lines-03.webp |

## Main content fields

### 01. Contact form

Section metadata: aria-label: `Contact form`.

- `section_01_copy_01` — **Copy** (HTML `p`): Let’s talk
- `section_01_heading_01` — **Heading** (HTML `h2`): Tell us what you’re working on.
- `section_01_copy_02` — **Copy** (HTML `p`): A rough idea is enough to begin. Share the challenge, what you want to change, and where you think we can help.
- `section_01_list_item_01` — **List Item** (HTML `li`): A focused first response
- `section_01_list_item_02` — **List Item** (HTML `li`): No hard sell
- `section_01_list_item_03` — **List Item** (HTML `li`): A clear recommended next step
- `section_01_link_label_01` — **Link Label** (HTML `a`): hello@alify.com
- `section_01_field_label_01` — **Field Label** (HTML `label`): Name
- `section_01_field_label_02` — **Field Label** (HTML `label`): Work email
- `section_01_field_label_03` — **Field Label** (HTML `label`): Company
- `section_01_field_label_04` — **Field Label** (HTML `label`): What can we help with?
- `section_01_field_label_05` — **Field Label** (HTML `label`): Tell us about the challenge
- `section_01_field_label_06` — **Field Label** (HTML `label`): I have read the privacy policy and agree that ALIFY may use these details to respond to my inquiry.
- `section_01_button_label_01` — **Button Label** (HTML `button`): Prepare email
- `section_01_copy_03` — **Copy** (HTML `p`): Submitting opens your email app with these details pre-filled.

Link destinations:
- `section_01_link_01_url` — hello@alify.com → `mailto:hello@alify.com`

Form `section_01_form_01` — separate WYSIWYG field for labels and safe HTML; keep the `ALIFY_CONTROL_XX` placeholders so the validated server-owned controls are restored in place:
- `section_01_form_01_field_01` — `type=text`, `name=name`, `id=contact-name`, `label=Name`, `required`, `autocomplete=name`
- `section_01_form_01_field_02` — `type=email`, `name=email`, `id=contact-email`, `label=Work email`, `required`, `autocomplete=email`
- `section_01_form_01_field_03` — `type=text`, `name=company`, `id=contact-company`, `label=Company`, `autocomplete=organization`
- `section_01_form_01_field_04` — `type=select`, `name=service`, `id=contact-service`, `label=What can we help with?`, `required`
  - Options: `Choose a service`; `Web Development`; `SEO`; `Digital Marketing`; `AI Automation`; `UI UX Design`; `Logo Design`; `Not sure yet`
- `section_01_form_01_field_05` — `type=textarea`, `name=message`, `id=contact-message`, `label=Tell us about the challenge`, `required`
- `section_01_form_01_field_06` — `type=checkbox`, `name=privacyConsent`, `required`

### 02. Contact next steps

Section metadata: aria-label: `Contact next steps`.

- `section_02_copy_01` — **Copy** (HTML `p`): What happens next
- `section_02_heading_01` — **Heading** (HTML `h2`): A simple start, without the hard sell.
- `section_02_copy_02` — **Copy** (HTML `p`): Three clear steps from your first note to a useful recommendation.
- `section_02_heading_02` — **Heading** (HTML `h3`): We read the context
- `section_02_copy_03` — **Copy** (HTML `p`): We review your note, links, and goals so the first conversation can be useful.
- `section_02_heading_03` — **Heading** (HTML `h3`): We arrange a conversation
- `section_02_copy_04` — **Copy** (HTML `p`): We discuss the problem, priorities, timing, and the people involved.
- `section_02_heading_04` — **Heading** (HTML `h3`): You receive a clear route
- `section_02_copy_05` — **Copy** (HTML `p`): We outline the recommended scope, approach, investment, and next steps.
- `section_02_heading_05` — **Heading** (HTML `h3`): You decide what follows
- `section_02_copy_06` — **Copy** (HTML `p`): Take the time you need to review the route and align your team.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. Contact FAQs

Section metadata: aria-label: `Contact FAQs`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

- `section_03_copy_01` — **Copy** (HTML `p`): Before you ask
- `section_03_heading_01` — **Heading** (HTML `h2`): A few quick answers.
- `section_03_copy_02` — **Copy** (HTML `p`): Search the essentials or filter by topic.
- `section_03_field_label_01` — **Field Label** (HTML `label`): Search frequently asked questions
- `section_03_button_label_01` — **Button Label** (HTML `button`): All
- `section_03_button_label_02` — **Button Label** (HTML `button`): Projects
- `section_03_button_label_03` — **Button Label** (HTML `button`): Process
- `section_03_button_label_04` — **Button Label** (HTML `button`): Support
- `section_03_button_label_05` — **Button Label** (HTML `button`): Do I need a finished brief?
- `section_03_copy_03` — **Copy** (HTML `p`): No. A clear description of the challenge and desired outcome is enough for an initial conversation.
- `section_03_button_label_06` — **Button Label** (HTML `button`): Can I share an existing website or prototype?
- `section_03_copy_04` — **Copy** (HTML `p`): Yes. Include accessible links in your message so we can understand the current experience.
- `section_03_button_label_07` — **Button Label** (HTML `button`): What if I am not sure which service I need?
- `section_03_copy_05` — **Copy** (HTML `p`): Choose “Not sure yet”. We will help identify the problem before recommending a capability.
- `section_03_copy_06` — **Copy** (HTML `p`): No matching questions found. Try another search or topic.

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
