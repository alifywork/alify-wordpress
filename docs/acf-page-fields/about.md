# ACF Field Inventory — `about`

Source: [`frontend-source/about.html`](../../frontend-source/about.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | About Us — Alify |
| `meta_description` | Textarea | Learn about Alify, our independent digital studio, and our approach to design and technology. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | About us |
| `hero_title` | Text | Curious minds. Thoughtful work. Shared ambition. |
| `hero_description` | Textarea | Get to know the independent studio behind Alify and the ideas, values, and collaboration that shape our work. |
| `hero_background` | Select/Image | neon-lines-02.webp |

## Main content fields

### 01. Studio introduction

Section metadata: aria-label: `Studio introduction`.

- `section_01_copy_01` — **Copy** (HTML `p`): The studio
- `section_01_heading_01` — **Heading** (HTML `h2`): Small team energy. Full studio capability.
- `section_01_copy_02` — **Copy** (HTML `p`): ALIFY is an independent digital studio for teams that value clear thinking, expressive design, and reliable technology. Strategy, design, and development stay in one connected process—from the first question to the final quality check.
- `section_01_list_item_01` — **List Item** (HTML `li`): Strategy
- `section_01_list_item_02` — **List Item** (HTML `li`): Identity
- `section_01_list_item_03` — **List Item** (HTML `li`): UI UX
- `section_01_list_item_04` — **List Item** (HTML `li`): Development
- `section_01_list_item_05` — **List Item** (HTML `li`): Growth

Images/media:
- `section_01_image_01` (**Image**): `assets/images/industries/startups-ventures.jpg`
  - `section_01_image_01_alt` (**Text**): Creative team collaborating around a studio table

### 02. Studio principles

Section metadata: aria-label: `Studio principles`.

- `section_02_copy_01` — **Copy** (HTML `p`): What guides us
- `section_02_heading_01` — **Heading** (HTML `h2`): Principles before process.
- `section_02_copy_02` — **Copy** (HTML `p`): The values that shape our conversations, decisions, and craft.
- `section_02_heading_02` — **Heading** (HTML `h3`): Curious before confident
- `section_02_copy_03` — **Copy** (HTML `p`): We ask the extra question, test the easy assumption, and look for the insight that changes the brief.
- `section_02_heading_03` — **Heading** (HTML `h3`): Clear at every step
- `section_02_copy_04` — **Copy** (HTML `p`): Straightforward communication, visible decisions, and no mystery around what happens next.
- `section_02_heading_04` — **Heading** (HTML `h3`): Craft with a purpose
- `section_02_copy_05` — **Copy** (HTML `p`): Every detail should make the experience clearer, stronger, or more distinctive.
- `section_02_heading_05` — **Heading** (HTML `h3`): Built around your goals
- `section_02_copy_06` — **Copy** (HTML `p`): The work is shaped around the outcome you need, not a predetermined agency package.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. Our process

Section metadata: aria-label: `Our process`.

- `section_03_copy_01` — **Copy** (HTML `p`): How we think
- `section_03_heading_01` — **Heading** (HTML `h2`): Connected disciplines. Better decisions.
- `section_03_copy_02` — **Copy** (HTML `p`): Brand, product, and technology inform one another throughout the work.
- `section_03_heading_02` — **Heading** (HTML `h3`): Understand the context
- `section_03_copy_03` — **Copy** (HTML `p`): Audience, market, goals, constraints, and the real problem beneath the requested deliverable.
- `section_03_heading_03` — **Heading** (HTML `h3`): Make the idea tangible
- `section_03_copy_04` — **Copy** (HTML `p`): Clear directions and useful prototypes create alignment before production accelerates.
- `section_03_heading_04` — **Heading** (HTML `h3`): Build with care
- `section_03_copy_05` — **Copy** (HTML `p`): Responsive implementation, accessible interactions, considered motion, and pragmatic choices.
- `section_03_heading_05` — **Heading** (HTML `h3`): Learn and refine
- `section_03_copy_06` — **Copy** (HTML `p`): Measure what matters, listen to users, and improve the experience beyond launch.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_03_inline_text_04` — **Inline Text** (HTML `span`): 04

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Studio culture

Section metadata: aria-label: `Studio culture`.

- `section_04_copy_01` — **Copy** (HTML `p`): Our working style
- `section_04_heading_01` — **Heading** (HTML `h2`): Enough structure. Never unnecessary layers.
- `section_04_copy_02` — **Copy** (HTML `p`): You speak with the people shaping and making the work. The team and process adapt to the brief, while content, accessibility, responsiveness, and performance remain part of the work from day one.
- `section_04_link_label_01` — **Link Label** (HTML `a`): Start a conversation

Link destinations:
- `section_04_link_01_url` — Start a conversation → `contact.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/industries/technology-saas.jpg`
  - `section_04_image_01_alt` (**Text**): Digital colleagues reviewing a product together

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
