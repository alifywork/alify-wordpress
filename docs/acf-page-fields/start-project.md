# ACF Field Inventory — `start-project`

Source: [`frontend-source/start-project.html`](../../frontend-source/start-project.html)

> This page has structured fields for individual headings, paragraphs, labels, links, and images within each source section. Repeated cards and list items use template-matched ACF Repeater subfields where the source layout repeats; all other content uses separate template-specific fields.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Start a Project — Alify |
| `meta_description` | Textarea | Start a project with Alify and turn your next idea into a thoughtful digital experience. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Start a project |
| `hero_title` | Text | Have an idea? Let’s build something exceptional. |
| `hero_description` | Textarea | Share your goals, challenges, and ambitions with us. Together, we can turn your next idea into a memorable digital experience. |
| `hero_background` | Select/Image | neon-lines-04.webp |

## Main content fields

### 01. Project brief form

Section metadata: aria-label: `Project brief form`.

Structured section fields:
- `section_01_element_01` — **textarea** (p): Project inquiry
- `section_01_element_02` — **text** (h2): Give us the useful details.
- `section_01_element_03` — **textarea** (p): The more context you share, the more useful our first response can be. Indicative ranges a
- `section_01_element_04` — **text** (a): Need a smaller conversation?


Link destinations:
- `section_01_link_01_url` — Need a smaller conversation? → `contact.html`

Form `section_01_form_01` — individual fields for labels/copy plus protected theme controls:
- `section_01_form_01_element_01` — **text** (label): Your name
- `section_01_form_01_element_02` — **text** (label): Work email
- `section_01_form_01_element_03` — **text** (label): Company or project
- `section_01_form_01_element_04` — **text** (label): Current website or brief link
- `section_01_form_01_element_05` — **text** (legend): Which services are relevant?
- `section_01_form_01_element_06` — **wysiwyg** (label): Web Development
- `section_01_form_01_element_07` — **wysiwyg** (label): SEO
- `section_01_form_01_element_08` — **wysiwyg** (label): Digital Marketing
- `section_01_form_01_element_09` — **wysiwyg** (label): AI Automation
- `section_01_form_01_element_10` — **wysiwyg** (label): UI UX Design
- `section_01_form_01_element_11` — **wysiwyg** (label): Logo Design
- `section_01_form_01_element_12` — **text** (label): Indicative budget
- `section_01_form_01_element_13` — **text** (label): Ideal timing
- `section_01_form_01_element_14` — **text** (label): What should this project achieve?
- `section_01_form_01_element_15` — **text** (label): Anything else we should know?
- `section_01_form_01_element_16` — **wysiwyg** (label): I have read the privacy policy and agree that ALIFY may use these details to respond to my
- `section_01_form_01_element_17` — **text** (button): Prepare project email
- `section_01_form_01_element_18` — **textarea** (p): This opens your email app with the inquiry pre-filled. Attach any private brief files ther
- Form controls, choices, validation, and submission behavior remain theme-managed.
- `section_01_form_01_field_01` — `type=text`, `name=name`, `id=project-name`, `label=Your name`, `required`, `autocomplete=name`
- `section_01_form_01_field_02` — `type=email`, `name=email`, `id=project-email`, `label=Work email`, `required`, `autocomplete=email`
- `section_01_form_01_field_03` — `type=text`, `name=company`, `id=project-company`, `label=Company or project`, `required`, `autocomplete=organization`
- `section_01_form_01_field_04` — `type=url`, `name=websiteOrBrief`, `id=project-website`, `label=Current website or brief link`, `placeholder=https://`
- `section_01_form_01_field_05` — `type=checkbox`, `name=web`
- `section_01_form_01_field_06` — `type=checkbox`, `name=seo`
- `section_01_form_01_field_07` — `type=checkbox`, `name=marketing`
- `section_01_form_01_field_08` — `type=checkbox`, `name=automation`
- `section_01_form_01_field_09` — `type=checkbox`, `name=uiux`
- `section_01_form_01_field_10` — `type=checkbox`, `name=logo`
- `section_01_form_01_field_11` — `type=select`, `name=budget`, `id=project-budget`, `label=Indicative budget`, `required`
  - Options: `Select a range`; `Under $3,000`; `$3,000–$7,500`; `$7,500–$15,000`; `$15,000+`; `Not defined yet`
- `section_01_form_01_field_12` — `type=select`, `name=timeline`, `id=project-timeline`, `label=Ideal timing`, `required`
  - Options: `Select a timeline`; `As soon as practical`; `Within 1–3 months`; `Within 3–6 months`; `Exploring for later`
- `section_01_form_01_field_13` — `type=textarea`, `name=goals`, `id=project-goal`, `label=What should this project achieve?`, `required`
- `section_01_form_01_field_14` — `type=textarea`, `name=additionalContext`, `id=project-context`, `label=Anything else we should know?`
- `section_01_form_01_field_15` — `type=checkbox`, `name=privacyConsent`, `required`

List group 01: 3 source items (li)
- List repeater `section_01_list_01_items` — add, remove, or reorder rows while the theme retains the source layout.
  - `section_01_list_01_items.element_01` — **textarea** (li): Your goals and desired outcome

### 02. Project next steps

Section metadata: aria-label: `Project next steps`.

Structured section fields:
- `section_02_element_01` — **textarea** (p): After you submit
- `section_02_element_02` — **text** (h2): What the first steps look like.
- `section_02_element_03` — **textarea** (p): A practical route from brief to kickoff, with responsibilities clear at every stage.


Repeater `section_02_cards` — 4 starter rows; each row has individual content, link URL, and image/alt subfields. Add, remove, or reorder rows in ACF.

### 03. Alternative contact

Section metadata: aria-label: `Alternative contact`.

Structured section fields:
- `section_03_element_01` — **textarea** (p): Not ready for a full brief?
- `section_03_element_02` — **text** (h2): Start with a smaller conversation.
- `section_03_element_03` — **textarea** (p): If the scope is still unclear, send a short note instead. We can help frame the challenge
- `section_03_element_04` — **text** (a): Go to general contact


Link destinations:
- `section_03_link_01_url` — Go to general contact → `contact.html`

## Shared implementation notes

- Every section has separate fields for its headings, paragraphs, labels, and other text blocks; rich text blocks use individual WYSIWYG controls. The original wrappers and layout remain theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards and homogeneous lists use ACF Repeaters with per-item content, link, and image/alt subfields; content and list wrappers remain in the source template.
- Form controls and server validation remain theme-controlled; section wrappers and layout are not editor fields.
