# ACF Field Inventory — `blog-single`

Source: [`frontend-source/blog-single.html`](../../frontend-source/blog-single.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Why clarity is a conversion strategy. — ALIFY Journal |
| `meta_description` | Textarea | How clear hierarchy, useful content, and intentional journeys help people make confident decisions. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Experience design |
| `hero_title` | Text | Why clarity is a conversion strategy. |
| `hero_description` | Textarea | How clear hierarchy, useful content, and intentional journeys help people make confident decisions. |
| `hero_background` | Select/Image | neon-lines-06.webp |
| `hero_variant` | Select | close-up |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

- `section_01_link_label_01` — **Link Label** (HTML `a`): Back to the journal
- `section_01_copy_01` — **Copy** (HTML `p`): Conversion is often discussed as a button, a headline, or a persuasion technique. In practice, it is usually the result of something quieter: people understanding enough to take the next step with confidence.
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): Experience design
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 6 min read
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): By ALIFY Design Team
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): 6 November 2026

Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_01_image_01_alt` (**Text**): Animated Experience design article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

- `section_02_copy_01` — **Copy** (HTML `p`): On this page
- `section_02_link_label_01` — **Link Label** (HTML `a`): 01 Start with the decision, not the page
- `section_02_link_label_02` — **Link Label** (HTML `a`): 02 Make the hierarchy do the work
- `section_02_link_label_03` — **Link Label** (HTML `a`): 03 Remove uncertainty before adding persuasion
- `section_02_link_label_04` — **Link Label** (HTML `a`): 04 Design the next step as part of the story
- `section_02_link_label_05` — **Link Label** (HTML `a`): Discuss your project
- `section_02_heading_01` — **Heading** (HTML `h2`): Start with the decision, not the page
- `section_02_copy_02` — **Copy** (HTML `p`): Before designing a layout, define what the visitor is trying to decide. Are they choosing a service, evaluating fit, comparing options, or looking for reassurance? The answer determines which information deserves priority.
- `section_02_copy_03` — **Copy** (HTML `p`): A page becomes easier to use when its hierarchy reflects that decision. The main promise establishes relevance, supporting content answers the next questions, and the call to action arrives when the visitor has enough context to use it.
- `section_02_heading_02` — **Heading** (HTML `h2`): Make the hierarchy do the work
- `section_02_copy_04` — **Copy** (HTML `p`): Visual hierarchy is not just a styling exercise. Type size, spacing, grouping, imagery, and contrast tell people what to read first and how different pieces of information relate.
- `section_02_copy_05` — **Copy** (HTML `p`): When everything is equally loud, visitors have to construct that hierarchy themselves. A calm composition with one clear idea at a time reduces effort and makes the experience feel more trustworthy.
- `section_02_caption_01` — **Caption** (HTML `figcaption`): Visual framework A clearer decision hierarchy
- `section_02_list_item_01` — **List Item** (HTML `li`): Relevance
- `section_02_list_item_02` — **List Item** (HTML `li`): Understanding
- `section_02_list_item_03` — **List Item** (HTML `li`): Reassurance
- `section_02_list_item_04` — **List Item** (HTML `li`): Action
- `section_02_copy_06` — **Copy** (HTML `p`): Each layer answers the next question instead of competing for attention.
- `section_02_heading_03` — **Heading** (HTML `h2`): Remove uncertainty before adding persuasion
- `section_02_copy_07` — **Copy** (HTML `p`): Unclear scope, unfamiliar terminology, missing practical detail, and vague next steps create hesitation. More urgency rarely solves those problems. Useful answers do.
- `section_02_copy_08` — **Copy** (HTML `p`): Explain what happens, what is required, and what the visitor can expect. Specific language and visible process often create more momentum than another promotional claim.
- `section_02_heading_04` — **Heading** (HTML `h2`): Design the next step as part of the story
- `section_02_copy_09` — **Copy** (HTML `p`): A call to action should feel like a natural continuation of the content. “Discuss your project” is meaningful when the page has already explained the challenge, the approach, and the kind of conversation that follows.
- `section_02_copy_10` — **Copy** (HTML `p`): Clarity is measurable through better questions, more qualified inquiries, and visitors reaching the right destination—not simply through more clicks.
- `section_02_quote_01` — **Quote** (HTML `blockquote`): “The strongest digital experiences make the important thing easier to understand—and the next step easier to take.”
- `section_02_copy_11` — **Copy** (HTML `p`): Key takeaways
- `section_02_heading_05` — **Heading** (HTML `h2`): Keep these four points.
- `section_02_list_item_05` — **List Item** (HTML `li`): Define the visitor decision before designing the page.
- `section_02_list_item_06` — **List Item** (HTML `li`): Use hierarchy to reduce reading effort, not just to create visual impact.
- `section_02_list_item_07` — **List Item** (HTML `li`): Answer practical uncertainty before adding more persuasion.
- `section_02_list_item_08` — **List Item** (HTML `li`): Make the next step specific, contextual, and easy to understand.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Link destinations:
- `section_02_link_01_url` — 01 Start with the decision, not the page → `#article-point-1`
- `section_02_link_02_url` — 02 Make the hierarchy do the work → `#article-point-2`
- `section_02_link_03_url` — 03 Remove uncertainty before adding persuasion → `#article-point-3`
- `section_02_link_04_url` — 04 Design the next step as part of the story → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

- `section_03_link_label_01` — **Link Label** (HTML `a`): Previous article A brand identity should work before it impresses.
- `section_03_link_label_02` — **Link Label** (HTML `a`): Next article A practical guide to planning a website that can grow.

Link destinations:
- `section_03_link_01_url` — Previous article A brand identity should work before it impresses. → `identity-that-works.html`
- `section_03_link_02_url` — Next article A practical guide to planning a website that can grow. → `planning-scalable-website.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

- `section_04_copy_01` — **Copy** (HTML `p`): Continue reading
- `section_04_heading_01` — **Heading** (HTML `h2`): Related perspectives.
- `section_04_copy_02` — **Copy** (HTML `p`): Explore another connected discipline.
- `section_04_link_label_01` — **Link Label** (HTML `a`): Brand identity A brand identity should work before it impresses. Read next
- `section_04_link_label_02` — **Link Label** (HTML `a`): Digital marketing Build campaigns around the next decision. Read next

Link destinations:
- `section_04_link_01_url` — Brand identity A brand identity should work before it impresses. Read next → `identity-that-works.html`
- `section_04_link_02_url` — Digital marketing Build campaigns around the next decision. Read next → `campaign-next-decision.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/logo-design.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
