# ACF Field Inventory — `pricing`

Source: [`frontend-source/pricing.html`](../../frontend-source/pricing.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Pricing — Alify |
| `meta_description` | Textarea | Explore flexible pricing and engagement options for working with Alify. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Pricing |
| `hero_title` | Text | Clear options for ambitious ideas. |
| `hero_description` | Textarea | Explore flexible engagement options designed around different goals, project sizes, and stages of growth. |
| `hero_background` | Select/Image | neon-lines-01.webp |
| `hero_variant` | Select | mirror-right |

## Main content fields

### 01. Engagement options

Section metadata: aria-label: `Engagement options`.

- `section_01_copy_01` — **Copy** (HTML `p`): Engagement options
- `section_01_heading_01` — **Heading** (HTML `h2`): A clear starting point. A scope shaped around you.
- `section_01_copy_02` — **Copy** (HTML `p`): No one-size-fits-all packages. Your proposal reflects scope, complexity, timing, and the team required.
- `section_01_heading_02` — **Heading** (HTML `h3`): Launch
- `section_01_copy_03` — **Copy** (HTML `p`): A defined project for a clear, immediate need.
- `section_01_list_item_01` — **List Item** (HTML `li`): Discovery and focused brief
- `section_01_list_item_02` — **List Item** (HTML `li`): Defined deliverables and milestones
- `section_01_list_item_03` — **List Item** (HTML `li`): Design and implementation
- `section_01_list_item_04` — **List Item** (HTML `li`): Launch support and handover
- `section_01_link_label_01` — **Link Label** (HTML `a`): Scope a project
- `section_01_heading_03` — **Heading** (HTML `h3`): Grow
- `section_01_copy_04` — **Copy** (HTML `p`): Ongoing creative and digital support.
- `section_01_list_item_05` — **List Item** (HTML `li`): Agreed monthly priorities
- `section_01_list_item_06` — **List Item** (HTML `li`): Strategy, design, and build support
- `section_01_list_item_07` — **List Item** (HTML `li`): Regular progress check-ins
- `section_01_list_item_08` — **List Item** (HTML `li`): Continuous optimisation
- `section_01_link_label_02` — **Link Label** (HTML `a`): Discuss a partnership
- `section_01_heading_04` — **Heading** (HTML `h3`): Partner
- `section_01_copy_05` — **Copy** (HTML `p`): Extra expertise inside your existing team.
- `section_01_list_item_09` — **List Item** (HTML `li`): Embedded senior expertise
- `section_01_list_item_10` — **List Item** (HTML `li`): Flexible workstreams
- `section_01_list_item_11` — **List Item** (HTML `li`): Shared roadmap and rituals
- `section_01_list_item_12` — **List Item** (HTML `li`): Knowledge transfer
- `section_01_link_label_03` — **Link Label** (HTML `a`): Plan the engagement
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): 01 / FOCUSED
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 02 / CONTINUOUS
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): 03 / COLLABORATIVE

Link destinations:
- `section_01_link_01_url` — Scope a project → `start-project.html`
- `section_01_link_02_url` — Discuss a partnership → `contact.html`
- `section_01_link_03_url` — Plan the engagement → `contact.html`

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 02. Compare engagements

Section metadata: aria-label: `Compare engagements`.

- `section_02_copy_01` — **Copy** (HTML `p`): Compare engagements
- `section_02_heading_01` — **Heading** (HTML `h2`): Choose the level of continuity you need.
- `section_02_copy_02` — **Copy** (HTML `p`): The difference is how we plan and work together—not the care applied to the deliverable.
- `section_02_table_heading_01` — **Table Heading** (HTML `th`): Engagement
- `section_02_table_heading_02` — **Table Heading** (HTML `th`): Best for
- `section_02_table_heading_03` — **Table Heading** (HTML `th`): Planning
- `section_02_table_heading_04` — **Table Heading** (HTML `th`): Delivery
- `section_02_table_heading_05` — **Table Heading** (HTML `th`): After launch
- `section_02_table_heading_06` — **Table Heading** (HTML `th`): Launch
- `section_02_table_cell_01` — **Table Cell** (HTML `td`): Defined project
- `section_02_table_cell_02` — **Table Cell** (HTML `td`): Fixed scope
- `section_02_table_cell_03` — **Table Cell** (HTML `td`): Milestone based
- `section_02_table_cell_04` — **Table Cell** (HTML `td`): Handover or support
- `section_02_table_heading_07` — **Table Heading** (HTML `th`): Grow
- `section_02_table_cell_05` — **Table Cell** (HTML `td`): Ongoing priorities
- `section_02_table_cell_06` — **Table Cell** (HTML `td`): Monthly roadmap
- `section_02_table_cell_07` — **Table Cell** (HTML `td`): Continuous
- `section_02_table_cell_08` — **Table Cell** (HTML `td`): Iteration included
- `section_02_table_heading_08` — **Table Heading** (HTML `th`): Partner
- `section_02_table_cell_09` — **Table Cell** (HTML `td`): Existing teams
- `section_02_table_cell_10` — **Table Cell** (HTML `td`): Shared roadmap
- `section_02_table_cell_11` — **Table Cell** (HTML `td`): Embedded
- `section_02_table_cell_12` — **Table Cell** (HTML `td`): Knowledge transfer

### 03. Always included

Section metadata: aria-label: `Always included`.

- `section_03_copy_01` — **Copy** (HTML `p`): Always included
- `section_03_heading_01` — **Heading** (HTML `h2`): The essentials do not depend on a package.
- `section_03_copy_02` — **Copy** (HTML `p`): Clear ownership, thoughtful implementation, and a useful handover are part of every relevant engagement.
- `section_03_heading_02` — **Heading** (HTML `h3`): Clear scope and ownership
- `section_03_copy_03` — **Copy** (HTML `p`): Deliverables, review points, dependencies, and responsibilities are agreed before work starts.
- `section_03_heading_03` — **Heading** (HTML `h3`): Quality and accessibility
- `section_03_copy_04` — **Copy** (HTML `p`): Responsive, accessible, thoughtful implementation is part of every relevant deliverable.
- `section_03_heading_04` — **Heading** (HTML `h3`): Useful documentation
- `section_03_copy_05` — **Copy** (HTML `p`): A structured handover so decisions, assets, and next steps remain understandable.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Pricing questions

Section metadata: aria-label: `Pricing questions`.

Interaction/filter data: `data-faq-filter` = `all`; `data-faq-filter` = `projects`; `data-faq-filter` = `process`; `data-faq-filter` = `support`; `data-category` = `projects`; `data-category` = `process`; `data-category` = `support`; `data-category` = `projects`.

- `section_04_copy_01` — **Copy** (HTML `p`): Pricing questions
- `section_04_heading_01` — **Heading** (HTML `h2`): Before we talk numbers.
- `section_04_field_label_01` — **Field Label** (HTML `label`): Search frequently asked questions
- `section_04_button_label_01` — **Button Label** (HTML `button`): All
- `section_04_button_label_02` — **Button Label** (HTML `button`): Projects
- `section_04_button_label_03` — **Button Label** (HTML `button`): Process
- `section_04_button_label_04` — **Button Label** (HTML `button`): Support
- `section_04_button_label_05` — **Button Label** (HTML `button`): Why are fixed prices not shown?
- `section_04_copy_02` — **Copy** (HTML `p`): A meaningful price depends on the actual scope, content, integrations, timeline, and collaboration required. A short discovery conversation produces a more honest estimate.
- `section_04_button_label_06` — **Button Label** (HTML `button`): Can a project be split into phases?
- `section_04_copy_03` — **Copy** (HTML `p`): Yes. Phasing can prioritise the most valuable foundation first and create clear points for review, learning, and future investment.
- `section_04_button_label_07` — **Button Label** (HTML `button`): What affects the quote most?
- `section_04_copy_04` — **Copy** (HTML `p`): Scope, technical complexity, content readiness, custom integrations, the number of unique experiences, and delivery timing usually have the greatest impact.
- `section_04_button_label_08` — **Button Label** (HTML `button`): Is ongoing support required?
- `section_04_copy_05` — **Copy** (HTML `p`): No. We can hand over a documented system, provide ad-hoc support, or continue as an ongoing partner.
- `section_04_copy_06` — **Copy** (HTML `p`): No matching questions found. Try another search or topic.

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
