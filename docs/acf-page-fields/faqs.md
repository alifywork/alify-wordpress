# ACF Field Inventory — `faqs`

Source: [`frontend-source/faqs.html`](../../frontend-source/faqs.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | FAQs — Alify |
| `meta_description` | Textarea | Frequently asked questions about working with Alify. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Frequently asked questions |
| `hero_title` | Text | Good questions deserve clear answers. |
| `hero_description` | Textarea | Find helpful answers about our process, services, timelines, collaboration, and what to expect when working with Alify. |
| `hero_background` | Select/Image | neon-lines-13.webp |

## Main content fields

### 01. Frequently asked questions

Section metadata: aria-label: `Frequently asked questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `process`; `data-category` = `process`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `projects`; `data-category` = `support`; `data-category` = `support`; `data-category` = `support`.

- `section_01_copy_01` — **Copy** (HTML `p`): Frequently asked questions
- `section_01_heading_01` — **Heading** (HTML `h2`): Everything you might want to ask.
- `section_01_copy_02` — **Copy** (HTML `p`): Search the essentials or filter by topic to find a clear answer before we begin.
- `section_01_field_label_01` — **Field Label** (HTML `label`): Search frequently asked questions
- `section_01_button_label_01` — **Button Label** (HTML `button`): All
- `section_01_button_label_02` — **Button Label** (HTML `button`): Projects
- `section_01_button_label_03` — **Button Label** (HTML `button`): Process
- `section_01_button_label_04` — **Button Label** (HTML `button`): Support
- `section_01_button_label_05` — **Button Label** (HTML `button`): What services does ALIFY provide?
- `section_01_copy_03` — **Copy** (HTML `p`): Web development, SEO, digital marketing, AI automation, UI UX design, and logo design. These capabilities can be combined into one connected engagement.
- `section_01_button_label_06` — **Button Label** (HTML `button`): Can you improve an existing digital product?
- `section_01_copy_04` — **Copy** (HTML `p`): Yes. We begin by understanding what is working, where the friction is, and whether focused improvements or a broader redesign is the better investment.
- `section_01_button_label_07` — **Button Label** (HTML `button`): Do you work with early-stage ideas?
- `section_01_copy_05` — **Copy** (HTML `p`): Yes. We can help shape positioning, identity, an MVP experience, and a practical digital foundation for launch.
- `section_01_button_label_08` — **Button Label** (HTML `button`): What happens at the start of a project?
- `section_01_copy_06` — **Copy** (HTML `p`): We align on the challenge, goals, audience, scope, responsibilities, timing, and success measures before creative production begins.
- `section_01_button_label_09` — **Button Label** (HTML `button`): How often will we see progress?
- `section_01_copy_07` — **Copy** (HTML `p`): Review points are agreed in the project plan. We prefer tangible progress and focused feedback over status meetings without decisions.
- `section_01_button_label_10` — **Button Label** (HTML `button`): What do you need from our team?
- `section_01_copy_08` — **Copy** (HTML `p`): Access to relevant context, timely feedback, a clear decision-maker, and any existing content or technical information needed for the scope.
- `section_01_button_label_11` — **Button Label** (HTML `button`): How long does a typical project take?
- `section_01_copy_09` — **Copy** (HTML `p`): Timing varies with scope and dependencies. After discovery we provide a schedule based on real deliverables, integrations, content readiness, and review availability.
- `section_01_button_label_12` — **Button Label** (HTML `button`): How much should we budget?
- `section_01_copy_10` — **Copy** (HTML `p`): Share a comfortable range if you can. It helps us recommend the most useful scope and discuss trade-offs openly.
- `section_01_button_label_13` — **Button Label** (HTML `button`): Can work be prioritised around a launch date?
- `section_01_copy_11` — **Copy** (HTML `p`): Yes. We can define a minimum viable first release and phase additional features or content around the agreed deadline.
- `section_01_button_label_14` — **Button Label** (HTML `button`): Will we be able to update the website?
- `section_01_copy_12` — **Copy** (HTML `p`): Where a content-managed solution is included, we provide an appropriate editing experience and handover guidance.
- `section_01_button_label_15` — **Button Label** (HTML `button`): Who owns the final work?
- `section_01_copy_13` — **Copy** (HTML `p`): Ownership and licensing are set out in the project agreement, including any third-party assets, fonts, software, or subscriptions.
- `section_01_button_label_16` — **Button Label** (HTML `button`): Can you support us after launch?
- `section_01_copy_14` — **Copy** (HTML `p`): Yes. Ongoing support can cover optimisation, new features, content, campaigns, maintenance, or periodic creative reviews.
- `section_01_copy_15` — **Copy** (HTML `p`): No matching questions found. Try another search or topic.

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
