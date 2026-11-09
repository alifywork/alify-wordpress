# ACF Field Inventory — `contact`

Source: [`frontend-source/contact.html`](../../frontend-source/contact.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

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

Structured section fields:
- `section_01_element_01` — **textarea** (p): Let’s talk
- `section_01_element_02` — **text** (h2): Tell us what you’re working on.
- `section_01_element_03` — **textarea** (p): A rough idea is enough to begin. Share the challenge, what you want to change, and where y
- `section_01_element_04` — **text** (a): hello@alify.com


Link destinations:
- `section_01_link_01_url` — hello@alify.com → `mailto:hello@alify.com`

Form `section_01_form_01` — individual fields for labels/copy plus protected theme controls:
- `section_01_form_01_element_01` — **text** (label): Name
- `section_01_form_01_element_02` — **text** (label): Work email
- `section_01_form_01_element_03` — **text** (label): Company
- `section_01_form_01_element_04` — **text** (label): What can we help with?
- `section_01_form_01_element_05` — **text** (label): Tell us about the challenge
- `section_01_form_01_element_06` — **wysiwyg** (label): I have read the privacy policy and agree that ALIFY may use these details to respond to my
- `section_01_form_01_element_07` — **text** (button): Prepare email
- `section_01_form_01_element_08` — **textarea** (p): Submitting opens your email app with these details pre-filled.
- Form controls, choices, validation, and submission behavior remain theme-managed.
- `section_01_form_01_field_01` — `type=text`, `name=name`, `id=contact-name`, `label=Name`, `required`, `autocomplete=name`
- `section_01_form_01_field_02` — `type=email`, `name=email`, `id=contact-email`, `label=Work email`, `required`, `autocomplete=email`
- `section_01_form_01_field_03` — `type=text`, `name=company`, `id=contact-company`, `label=Company`, `autocomplete=organization`
- `section_01_form_01_field_04` — `type=select`, `name=service`, `id=contact-service`, `label=What can we help with?`, `required`
  - Options: `Choose a service`; `Web Development`; `SEO`; `Digital Marketing`; `AI Automation`; `UI UX Design`; `Logo Design`; `Not sure yet`
- `section_01_form_01_field_05` — `type=textarea`, `name=message`, `id=contact-message`, `label=Tell us about the challenge`, `required`
- `section_01_form_01_field_06` — `type=checkbox`, `name=privacyConsent`, `required`

List group 01: 3 source items (li)
- List repeater `section_01_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_01_list_01_items.element_01` — **textarea** (li): A focused first response

### 02. Contact next steps

Section metadata: aria-label: `Contact next steps`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): What happens next
- `section_02_element_02` — **text** (h2): A simple start, without the hard sell.
- `section_02_element_03` — **textarea** (p): Three clear steps from your first note to a useful recommendation.


Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. Contact FAQs

Section metadata: aria-label: `Contact FAQs`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Before you ask
- `section_03_element_02` — **text** (h2): A few quick answers.
- `section_03_element_03` — **textarea** (p): Search the essentials or filter by topic.
- `section_03_element_04` — **wysiwyg** (label): Search frequently asked questions
- `section_03_element_05` — **text** (button): All
- `section_03_element_06` — **text** (button): Projects
- `section_03_element_07` — **text** (button): Process
- `section_03_element_08` — **text** (button): Support
- `section_03_element_09` — **textarea** (p): No matching questions found. Try another search or topic.


Faq group 01: 3 source items (div)
- Faq repeater `section_03_faq_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_03_faq_01_items.element_01` — **text** (button): Do I need a finished brief?
  - `section_03_faq_01_items.element_02` — **textarea** (p): No. A clear description of the challenge and desired outcome is enough for an initial conv
  - `section_03_faq_01_items.attribute_data_category` — editable item filter/category value

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
