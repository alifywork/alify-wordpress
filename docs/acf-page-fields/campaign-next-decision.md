# ACF Field Inventory — `campaign-next-decision`

Source: [`frontend-source/campaign-next-decision.html`](../../frontend-source/campaign-next-decision.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Build campaigns around the next decision. — ALIFY Journal |
| `meta_description` | Textarea | A practical way to connect channel creative, landing experiences, and measurement around real audience intent. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Digital marketing |
| `hero_title` | Text | Build campaigns around the next decision. |
| `hero_description` | Textarea | A practical way to connect channel creative, landing experiences, and measurement around real audience intent. |
| `hero_background` | Select/Image | neon-lines-12.webp |
| `hero_variant` | Select | mirror-right |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

- `section_01_link_label_01` — **Link Label** (HTML `a`): Back to the journal
- `section_01_copy_01` — **Copy** (HTML `p`): A campaign becomes more coherent when every element supports the same next decision. Channel, creative, landing page, and measurement should feel like parts of one journey rather than separate deliverables.
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): Digital marketing
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 5 min read
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): By ALIFY Campaign Team
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): 20 October 2026

Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_01_image_01_alt` (**Text**): Animated Digital marketing article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

- `section_02_copy_01` — **Copy** (HTML `p`): On this page
- `section_02_link_label_01` — **Link Label** (HTML `a`): 01 Define the audience moment
- `section_02_link_label_02` — **Link Label** (HTML `a`): 02 Make one promise consistently
- `section_02_link_label_03` — **Link Label** (HTML `a`): 03 Design the destination before launch
- `section_02_link_label_04` — **Link Label** (HTML `a`): 04 Measure decisions, not activity alone
- `section_02_link_label_05` — **Link Label** (HTML `a`): Discuss your project
- `section_02_heading_01` — **Heading** (HTML `h2`): Define the audience moment
- `section_02_copy_02` — **Copy** (HTML `p`): Understand what the audience already knows, what they are trying to solve, and what would make the message relevant now.
- `section_02_copy_03` — **Copy** (HTML `p`): The same product may require different stories for first discovery, active comparison, and returning consideration.
- `section_02_heading_02` — **Heading** (HTML `h2`): Make one promise consistently
- `section_02_copy_04` — **Copy** (HTML `p`): The campaign idea should establish a clear promise that the destination immediately continues. A disconnect between ad and landing page creates avoidable doubt.
- `section_02_copy_05` — **Copy** (HTML `p`): Consistency does not mean repeating identical copy; it means preserving the same meaning and expectation.
- `section_02_caption_01` — **Caption** (HTML `figcaption`): Visual framework One continuous campaign journey
- `section_02_list_item_01` — **List Item** (HTML `li`): Audience moment
- `section_02_list_item_02` — **List Item** (HTML `li`): Creative promise
- `section_02_list_item_03` — **List Item** (HTML `li`): Landing reassurance
- `section_02_list_item_04` — **List Item** (HTML `li`): Next decision
- `section_02_copy_06` — **Copy** (HTML `p`): Measurement connects the destination back to the original audience intent.
- `section_02_heading_03` — **Heading** (HTML `h2`): Design the destination before launch
- `section_02_copy_07` — **Copy** (HTML `p`): The landing experience needs to answer the questions created by the campaign and provide a next step suited to the visitor’s readiness.
- `section_02_copy_08` — **Copy** (HTML `p`): Campaign planning should include content, design, development, tracking, and quality assurance together.
- `section_02_heading_04` — **Heading** (HTML `h2`): Measure decisions, not activity alone
- `section_02_copy_09` — **Copy** (HTML `p`): Clicks and impressions describe distribution. Qualified inquiries, signup quality, and progression through the journey reveal whether the campaign created useful action.
- `section_02_copy_10` — **Copy** (HTML `p`): Use those signals to refine the story and experience, not only the media budget.
- `section_02_quote_01` — **Quote** (HTML `blockquote`): “A campaign works when the promise, destination, and next decision feel like one continuous thought.”
- `section_02_copy_11` — **Copy** (HTML `p`): Key takeaways
- `section_02_heading_05` — **Heading** (HTML `h2`): Keep these four points.
- `section_02_list_item_05` — **List Item** (HTML `li`): Start with audience context and readiness.
- `section_02_list_item_06` — **List Item** (HTML `li`): Keep one promise from creative to destination.
- `section_02_list_item_07` — **List Item** (HTML `li`): Build the landing journey before launch.
- `section_02_list_item_08` — **List Item** (HTML `li`): Measure useful decisions, not just channel activity.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Link destinations:
- `section_02_link_01_url` — 01 Define the audience moment → `#article-point-1`
- `section_02_link_02_url` — 02 Make one promise consistently → `#article-point-2`
- `section_02_link_03_url` — 03 Design the destination before launch → `#article-point-3`
- `section_02_link_04_url` — 04 Measure decisions, not activity alone → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

- `section_03_link_label_01` — **Link Label** (HTML `a`): Previous article Technical SEO is experience design too.
- `section_03_link_label_02` — **Link Label** (HTML `a`): Next article A brand identity should work before it impresses.

Link destinations:
- `section_03_link_01_url` — Previous article Technical SEO is experience design too. → `technical-seo-experience.html`
- `section_03_link_02_url` — Next article A brand identity should work before it impresses. → `identity-that-works.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

- `section_04_copy_01` — **Copy** (HTML `p`): Continue reading
- `section_04_heading_01` — **Heading** (HTML `h2`): Related perspectives.
- `section_04_copy_02` — **Copy** (HTML `p`): Explore another connected discipline.
- `section_04_link_label_01` — **Link Label** (HTML `a`): SEO Technical SEO is experience design too. Read next
- `section_04_link_label_02` — **Link Label** (HTML `a`): Experience design Why clarity is a conversion strategy. Read next

Link destinations:
- `section_04_link_01_url` — SEO Technical SEO is experience design too. Read next → `technical-seo-experience.html`
- `section_04_link_02_url` — Experience design Why clarity is a conversion strategy. Read next → `blog-single.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/seo.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
