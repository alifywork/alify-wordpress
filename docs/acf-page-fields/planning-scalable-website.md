# ACF Field Inventory — `planning-scalable-website`

Source: [`frontend-source/planning-scalable-website.html`](../../frontend-source/planning-scalable-website.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | A practical guide to planning a website that can grow. — ALIFY Journal |
| `meta_description` | Textarea | A practical framework for content, components, technology, and decisions that support the next phase. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Web development |
| `hero_title` | Text | Plan a website that can grow. |
| `hero_description` | Textarea | A practical framework for content, components, technology, and decisions that support the next phase. |
| `hero_background` | Select/Image | neon-lines-03.webp |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

- `section_01_link_label_01` — **Link Label** (HTML `a`): Back to the journal
- `section_01_copy_01` — **Copy** (HTML `p`): A scalable website is not defined by a particular platform. It is the result of clear content, reusable patterns, maintainable technology, and a team that understands how the system should evolve.
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): Web development
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 7 min read
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): By ALIFY Technology Team
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): 30 October 2026

Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_01_image_01_alt` (**Text**): Animated Web development article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

- `section_02_copy_01` — **Copy** (HTML `p`): On this page
- `section_02_link_label_01` — **Link Label** (HTML `a`): 01 Begin with content and responsibilities
- `section_02_link_label_02` — **Link Label** (HTML `a`): 02 Design reusable patterns, not isolated pages
- `section_02_link_label_03` — **Link Label** (HTML `a`): 03 Choose technology around the operating reality
- `section_02_link_label_04` — **Link Label** (HTML `a`): 04 Leave room for measured improvement
- `section_02_link_label_05` — **Link Label** (HTML `a`): Discuss your project
- `section_02_heading_01` — **Heading** (HTML `h2`): Begin with content and responsibilities
- `section_02_copy_02` — **Copy** (HTML `p`): List the information the organisation needs to publish, who owns it, and how often it changes. This reveals the content types and editing workflows the website actually needs.
- `section_02_copy_03` — **Copy** (HTML `p`): A smaller, well-understood content model is usually more valuable than a complex system built for hypothetical futures.
- `section_02_heading_02` — **Heading** (HTML `h2`): Design reusable patterns, not isolated pages
- `section_02_copy_04` — **Copy** (HTML `p`): Pages are instances of a broader system. Identify repeated story, card, media, form, and navigation patterns before refining individual screens.
- `section_02_copy_05` — **Copy** (HTML `p`): Reusable patterns improve consistency and make future pages faster to produce without making every page look identical.
- `section_02_caption_01` — **Caption** (HTML `figcaption`): Visual framework A maintainable website model
- `section_02_list_item_01` — **List Item** (HTML `li`): Content types
- `section_02_list_item_02` — **List Item** (HTML `li`): Reusable components
- `section_02_list_item_03` — **List Item** (HTML `li`): Page compositions
- `section_02_list_item_04` — **List Item** (HTML `li`): Measured iteration
- `section_02_copy_06` — **Copy** (HTML `p`): The system supports new pages without making every page identical.
- `section_02_heading_03` — **Heading** (HTML `h2`): Choose technology around the operating reality
- `section_02_copy_07` — **Copy** (HTML `p`): The right platform depends on editing needs, integrations, internal skills, performance expectations, and long-term ownership.
- `section_02_copy_08` — **Copy** (HTML `p`): Technical discovery should expose these constraints early so the recommendation supports the team rather than impressing only during the demo.
- `section_02_heading_04` — **Heading** (HTML `h2`): Leave room for measured improvement
- `section_02_copy_09` — **Copy** (HTML `p`): Launch with a useful baseline and a clear way to learn from real behaviour. Analytics, feedback, accessibility checks, and performance monitoring inform the next priorities.
- `section_02_copy_10` — **Copy** (HTML `p`): A website stays scalable when change is expected and managed, not when every possible feature is built on day one.
- `section_02_quote_01` — **Quote** (HTML `blockquote`): “Scalability comes from understandable content and reusable decisions, not from building every future feature today.”
- `section_02_copy_11` — **Copy** (HTML `p`): Key takeaways
- `section_02_heading_05` — **Heading** (HTML `h2`): Keep these four points.
- `section_02_list_item_05` — **List Item** (HTML `li`): Model real content and ownership first.
- `section_02_list_item_06` — **List Item** (HTML `li`): Build a reusable design and development system.
- `section_02_list_item_07` — **List Item** (HTML `li`): Choose technology around team and operational needs.
- `section_02_list_item_08` — **List Item** (HTML `li`): Plan iteration as part of the launch.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Link destinations:
- `section_02_link_01_url` — 01 Begin with content and responsibilities → `#article-point-1`
- `section_02_link_02_url` — 02 Design reusable patterns, not isolated pages → `#article-point-2`
- `section_02_link_03_url` — 03 Choose technology around the operating reality → `#article-point-3`
- `section_02_link_04_url` — 04 Leave room for measured improvement → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

- `section_03_link_label_01` — **Link Label** (HTML `a`): Previous article Why clarity is a conversion strategy.
- `section_03_link_label_02` — **Link Label** (HTML `a`): Next article Where automation creates useful space.

Link destinations:
- `section_03_link_01_url` — Previous article Why clarity is a conversion strategy. → `blog-single.html`
- `section_03_link_02_url` — Next article Where automation creates useful space. → `useful-automation.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

- `section_04_copy_01` — **Copy** (HTML `p`): Continue reading
- `section_04_heading_01` — **Heading** (HTML `h2`): Related perspectives.
- `section_04_copy_02` — **Copy** (HTML `p`): Explore another connected discipline.
- `section_04_link_label_01` — **Link Label** (HTML `a`): Experience design Why clarity is a conversion strategy. Read next
- `section_04_link_label_02` — **Link Label** (HTML `a`): SEO Technical SEO is experience design too. Read next

Link destinations:
- `section_04_link_01_url` — Experience design Why clarity is a conversion strategy. Read next → `blog-single.html`
- `section_04_link_02_url` — SEO Technical SEO is experience design too. Read next → `technical-seo-experience.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/seo.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
