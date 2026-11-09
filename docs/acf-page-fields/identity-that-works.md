# ACF Field Inventory — `identity-that-works`

Source: [`frontend-source/identity-that-works.html`](../../frontend-source/identity-that-works.html)

> This page has a coded ACF field group. Section editors support both visual text formatting and raw HTML; optional link URLs, image replacements, and image alternative text are separate controls. The inventory below documents the source defaults and element map used by the theme.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | A brand identity should work before it impresses. — ALIFY Journal |
| `meta_description` | Textarea | How strategy, recognition, and a flexible visual language turn a logo into a useful identity system. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Brand identity |
| `hero_title` | Text | A brand identity should work before it impresses. |
| `hero_description` | Textarea | How strategy, recognition, and a flexible visual language turn a logo into a useful identity system. |
| `hero_background` | Select/Image | neon-lines-02.webp |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

- `section_01_link_label_01` — **Link Label** (HTML `a`): Back to the journal
- `section_01_copy_01` — **Copy** (HTML `p`): A distinctive mark matters, but an identity proves its value through use. It needs to make the brand recognisable, support communication, and remain coherent across real touchpoints.
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): Brand identity
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 6 min read
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): By ALIFY Brand Team
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): 3 November 2026

Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/logo-design.svg`
  - `section_01_image_01_alt` (**Text**): Animated Brand identity article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

- `section_02_copy_01` — **Copy** (HTML `p`): On this page
- `section_02_link_label_01` — **Link Label** (HTML `a`): 01 Start with a recognisable idea
- `section_02_link_label_02` — **Link Label** (HTML `a`): 02 Design for recognition at real sizes
- `section_02_link_label_03` — **Link Label** (HTML `a`): 03 Build a language around the mark
- `section_02_link_label_04` — **Link Label** (HTML `a`): 04 Make the system usable by others
- `section_02_link_label_05` — **Link Label** (HTML `a`): Discuss your project
- `section_02_heading_01` — **Heading** (HTML `h2`): Start with a recognisable idea
- `section_02_copy_02` — **Copy** (HTML `p`): Positioning, audience, personality, and competitive context provide the raw material for an ownable creative direction.
- `section_02_copy_03` — **Copy** (HTML `p`): Without that foundation, visual decisions can be attractive but interchangeable.
- `section_02_heading_02` — **Heading** (HTML `h2`): Design for recognition at real sizes
- `section_02_copy_04` — **Copy** (HTML `p`): A logo needs to work in a browser tab, on a mobile screen, in a presentation, and across everyday applications—not only in a large reveal.
- `section_02_copy_05` — **Copy** (HTML `p`): Test simplicity, proportion, contrast, and reproduction early in the process.
- `section_02_caption_01` — **Caption** (HTML `figcaption`): Visual framework Identity as a working system
- `section_02_list_item_01` — **List Item** (HTML `li`): Positioning
- `section_02_list_item_02` — **List Item** (HTML `li`): Logo suite
- `section_02_list_item_03` — **List Item** (HTML `li`): Visual language
- `section_02_list_item_04` — **List Item** (HTML `li`): Real applications
- `section_02_copy_06` — **Copy** (HTML `p`): A recognisable idea becomes useful through consistent application.
- `section_02_heading_03` — **Heading** (HTML `h2`): Build a language around the mark
- `section_02_copy_07` — **Copy** (HTML `p`): Typography, colour, imagery, layout, motion, and tone create the broader recognition system.
- `section_02_copy_08` — **Copy** (HTML `p`): A few strong, connected principles are more useful than a large collection of unrelated assets.
- `section_02_heading_04` — **Heading** (HTML `h2`): Make the system usable by others
- `section_02_copy_09` — **Copy** (HTML `p`): Guidelines should help people make good decisions with the identity. Clear examples, accessible files, and practical rules support consistent use.
- `section_02_copy_10` — **Copy** (HTML `p`): The identity succeeds when the team can apply it confidently without requiring the designer for every new asset.
- `section_02_quote_01` — **Quote** (HTML `blockquote`): “An identity becomes valuable when people can recognise it, use it, and build on it without starting again.”
- `section_02_copy_11` — **Copy** (HTML `p`): Key takeaways
- `section_02_heading_05` — **Heading** (HTML `h2`): Keep these four points.
- `section_02_list_item_05` — **List Item** (HTML `li`): Ground the creative idea in positioning.
- `section_02_list_item_06` — **List Item** (HTML `li`): Test recognition in real applications.
- `section_02_list_item_07` — **List Item** (HTML `li`): Build a connected visual and verbal language.
- `section_02_list_item_08` — **List Item** (HTML `li`): Give the team a system they can actually use.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Link destinations:
- `section_02_link_01_url` — 01 Start with a recognisable idea → `#article-point-1`
- `section_02_link_02_url` — 02 Design for recognition at real sizes → `#article-point-2`
- `section_02_link_03_url` — 03 Build a language around the mark → `#article-point-3`
- `section_02_link_04_url` — 04 Make the system usable by others → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

- `section_03_link_label_01` — **Link Label** (HTML `a`): Previous article Build campaigns around the next decision.
- `section_03_link_label_02` — **Link Label** (HTML `a`): Next article Why clarity is a conversion strategy.

Link destinations:
- `section_03_link_01_url` — Previous article Build campaigns around the next decision. → `campaign-next-decision.html`
- `section_03_link_02_url` — Next article Why clarity is a conversion strategy. → `blog-single.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

- `section_04_copy_01` — **Copy** (HTML `p`): Continue reading
- `section_04_heading_01` — **Heading** (HTML `h2`): Related perspectives.
- `section_04_copy_02` — **Copy** (HTML `p`): Explore another connected discipline.
- `section_04_link_label_01` — **Link Label** (HTML `a`): Experience design Why clarity is a conversion strategy. Read next
- `section_04_link_label_02` — **Link Label** (HTML `a`): Web development A practical guide to planning a website that can grow. Read next

Link destinations:
- `section_04_link_01_url` — Experience design Why clarity is a conversion strategy. Read next → `blog-single.html`
- `section_04_link_02_url` — Web development A practical guide to planning a website that can grow. Read next → `planning-scalable-website.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/web-development.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
