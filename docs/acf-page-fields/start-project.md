# ACF Field Inventory — `start-project`

Source: [`frontend-source/start-project.html`](../../frontend-source/start-project.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

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

- `section_01_copy_01` — **Copy** (HTML `p`): Project inquiry
- `section_01_heading_01` — **Heading** (HTML `h2`): Give us the useful details.
- `section_01_copy_02` — **Copy** (HTML `p`): The more context you share, the more useful our first response can be. Indicative ranges are enough at this stage.
- `section_01_list_item_01` — **List Item** (HTML `li`): Your goals and desired outcome
- `section_01_list_item_02` — **List Item** (HTML `li`): Relevant services and timing
- `section_01_list_item_03` — **List Item** (HTML `li`): An indicative investment range
- `section_01_link_label_01` — **Link Label** (HTML `a`): Need a smaller conversation?
- `section_01_field_label_01` — **Field Label** (HTML `label`): Your name
- `section_01_field_label_02` — **Field Label** (HTML `label`): Work email
- `section_01_field_label_03` — **Field Label** (HTML `label`): Company or project
- `section_01_field_label_04` — **Field Label** (HTML `label`): Current website or brief link
- `section_01_legend_01` — **Legend** (HTML `legend`): Which services are relevant?
- `section_01_field_label_05` — **Field Label** (HTML `label`): Web Development
- `section_01_field_label_06` — **Field Label** (HTML `label`): SEO
- `section_01_field_label_07` — **Field Label** (HTML `label`): Digital Marketing
- `section_01_field_label_08` — **Field Label** (HTML `label`): AI Automation
- `section_01_field_label_09` — **Field Label** (HTML `label`): UI UX Design
- `section_01_field_label_10` — **Field Label** (HTML `label`): Logo Design
- `section_01_field_label_11` — **Field Label** (HTML `label`): Indicative budget
- `section_01_field_label_12` — **Field Label** (HTML `label`): Ideal timing
- `section_01_field_label_13` — **Field Label** (HTML `label`): What should this project achieve?
- `section_01_field_label_14` — **Field Label** (HTML `label`): Anything else we should know?
- `section_01_field_label_15` — **Field Label** (HTML `label`): I have read the privacy policy and agree that ALIFY may use these details to respond to my inquiry.
- `section_01_button_label_01` — **Button Label** (HTML `button`): Prepare project email
- `section_01_copy_03` — **Copy** (HTML `p`): This opens your email app with the inquiry pre-filled. Attach any private brief files there.

Link destinations:
- `section_01_link_01_url` — Need a smaller conversation? → `contact.html`
- `section_01_link_02_url` — privacy policy → `privacy-policy.html`

Form `section_01_form_01`:
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

### 02. Project next steps

Section metadata: aria-label: `Project next steps`.

- `section_02_copy_01` — **Copy** (HTML `p`): After you submit
- `section_02_heading_01` — **Heading** (HTML `h2`): What the first steps look like.
- `section_02_copy_02` — **Copy** (HTML `p`): A practical route from brief to kickoff, with responsibilities clear at every stage.
- `section_02_heading_02` — **Heading** (HTML `h3`): Context review
- `section_02_copy_03` — **Copy** (HTML `p`): We read the brief and review any existing links or materials you share.
- `section_02_heading_03` — **Heading** (HTML `h3`): Focused conversation
- `section_02_copy_04` — **Copy** (HTML `p`): We clarify the challenge, priorities, scope, constraints, and decision-makers.
- `section_02_heading_04` — **Heading** (HTML `h3`): Recommendation
- `section_02_copy_05` — **Copy** (HTML `p`): You receive a proposed route with deliverables, responsibilities, timing, and investment.
- `section_02_heading_05` — **Heading** (HTML `h3`): Kickoff
- `section_02_copy_06` — **Copy** (HTML `p`): Once aligned, we confirm the plan, communication rhythm, and first working session.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. Alternative contact

Section metadata: aria-label: `Alternative contact`.

- `section_03_copy_01` — **Copy** (HTML `p`): Not ready for a full brief?
- `section_03_heading_01` — **Heading** (HTML `h2`): Start with a smaller conversation.
- `section_03_copy_02` — **Copy** (HTML `p`): If the scope is still unclear, send a short note instead. We can help frame the challenge before defining a project.
- `section_03_link_label_01` — **Link Label** (HTML `a`): Go to general contact

Link destinations:
- `section_03_link_01_url` — Go to general contact → `contact.html`

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
