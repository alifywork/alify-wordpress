# ACF Field Inventory — `technical-seo-experience`

Source: [`frontend-source/technical-seo-experience.html`](../../frontend-source/technical-seo-experience.html)

> Inventory phase only. This file records editable content slots and their current source values. It does not register fields or change the live WordPress content. The next implementation phase will define/register page-specific ACF groups and render these values through PHP.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Technical SEO is experience design too. — ALIFY Journal |
| `meta_description` | Textarea | Why crawlability, performance, structure, and accessible content serve both search visibility and people. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / SEO |
| `hero_title` | Text | Technical SEO is experience design too. |
| `hero_description` | Textarea | Why crawlability, performance, structure, and accessible content serve both search visibility and people. |
| `hero_background` | Select/Image | neon-lines-11.webp |

## Main content fields

### 01. Article introduction

Section metadata: aria-label: `Article introduction`.

- `section_01_link_label_01` — **Link Label** (HTML `a`): Back to the journal
- `section_01_copy_01` — **Copy** (HTML `p`): Technical SEO is sometimes separated from design as though search engines and people need different experiences. Many of the strongest technical improvements make the website clearer and more dependable for both.
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): SEO
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 6 min read
- `section_01_inline_text_03` — **Inline Text** (HTML `span`): By ALIFY Growth Team
- `section_01_inline_text_04` — **Inline Text** (HTML `span`): 23 October 2026

Link destinations:
- `section_01_link_01_url` — Back to the journal → `blog.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/seo.svg`
  - `section_01_image_01_alt` (**Text**): Animated SEO article illustration

### 02. Article content

Section metadata: aria-label: `Article content`.

- `section_02_copy_01` — **Copy** (HTML `p`): On this page
- `section_02_link_label_01` — **Link Label** (HTML `a`): 01 Make important content reachable
- `section_02_link_label_02` — **Link Label** (HTML `a`): 02 Treat performance as part of the content
- `section_02_link_label_03` — **Link Label** (HTML `a`): 03 Structure meaning before metadata
- `section_02_link_label_04` — **Link Label** (HTML `a`): 04 Maintain visibility after launch
- `section_02_link_label_05` — **Link Label** (HTML `a`): Discuss your project
- `section_02_heading_01` — **Heading** (HTML `h2`): Make important content reachable
- `section_02_copy_02` — **Copy** (HTML `p`): Logical navigation, descriptive internal links, and a clear URL structure help people and crawlers discover what matters.
- `section_02_copy_03` — **Copy** (HTML `p`): An orphaned page is not just a search issue. It is often evidence that the information architecture has lost sight of a useful journey.
- `section_02_heading_02` — **Heading** (HTML `h2`): Treat performance as part of the content
- `section_02_copy_04` — **Copy** (HTML `p`): Slow media, unnecessary scripts, and unstable layouts interrupt reading and action. They also weaken the technical quality signals search engines can evaluate.
- `section_02_copy_05` — **Copy** (HTML `p`): Performance budgets belong in design and development decisions from the beginning.
- `section_02_caption_01` — **Caption** (HTML `figcaption`): Visual framework Technical quality as a connected loop
- `section_02_list_item_01` — **List Item** (HTML `li`): Crawl and discover
- `section_02_list_item_02` — **List Item** (HTML `li`): Structure and render
- `section_02_list_item_03` — **List Item** (HTML `li`): Perform and engage
- `section_02_list_item_04` — **List Item** (HTML `li`): Measure and maintain
- `section_02_copy_06` — **Copy** (HTML `p`): Search visibility improves alongside the usefulness of the experience.
- `section_02_heading_03` — **Heading** (HTML `h2`): Structure meaning before metadata
- `section_02_copy_07` — **Copy** (HTML `p`): Headings, semantic HTML, descriptive labels, and accessible interactions give content a meaningful structure. Metadata should describe that structure accurately, not compensate for its absence.
- `section_02_copy_08` — **Copy** (HTML `p`): Clear content remains the foundation; technical markup helps machines interpret it.
- `section_02_heading_04` — **Heading** (HTML `h2`): Maintain visibility after launch
- `section_02_copy_09` — **Copy** (HTML `p`): Redirects, indexation, broken links, and template changes need monitoring as the site evolves.
- `section_02_copy_10` — **Copy** (HTML `p`): SEO is most resilient when it is part of ongoing content and engineering ownership rather than a one-time checklist.
- `section_02_quote_01` — **Quote** (HTML `blockquote`): “The best technical SEO improvements often make the experience clearer for people at the same time.”
- `section_02_copy_11` — **Copy** (HTML `p`): Key takeaways
- `section_02_heading_05` — **Heading** (HTML `h2`): Keep these four points.
- `section_02_list_item_05` — **List Item** (HTML `li`): Connect search discovery to useful navigation.
- `section_02_list_item_06` — **List Item** (HTML `li`): Include performance in design decisions.
- `section_02_list_item_07` — **List Item** (HTML `li`): Use semantic structure before relying on metadata.
- `section_02_list_item_08` — **List Item** (HTML `li`): Keep technical ownership active after launch.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 04

Link destinations:
- `section_02_link_01_url` — 01 Make important content reachable → `#article-point-1`
- `section_02_link_02_url` — 02 Treat performance as part of the content → `#article-point-2`
- `section_02_link_03_url` — 03 Structure meaning before metadata → `#article-point-3`
- `section_02_link_04_url` — 04 Maintain visibility after launch → `#article-point-4`
- `section_02_link_05_url` — Discuss your project → `start-project.html`

Repeated content: 4 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. More journal articles

Section metadata: aria-label: `More journal articles`.

- `section_03_link_label_01` — **Link Label** (HTML `a`): Previous article Where automation creates useful space.
- `section_03_link_label_02` — **Link Label** (HTML `a`): Next article Build campaigns around the next decision.

Link destinations:
- `section_03_link_01_url` — Previous article Where automation creates useful space. → `useful-automation.html`
- `section_03_link_02_url` — Next article Build campaigns around the next decision. → `campaign-next-decision.html`

### 04. Related articles

Section metadata: aria-label: `Related articles`.

- `section_04_copy_01` — **Copy** (HTML `p`): Continue reading
- `section_04_heading_01` — **Heading** (HTML `h2`): Related perspectives.
- `section_04_copy_02` — **Copy** (HTML `p`): Explore another connected discipline.
- `section_04_link_label_01` — **Link Label** (HTML `a`): Web development A practical guide to planning a website that can grow. Read next
- `section_04_link_label_02` — **Link Label** (HTML `a`): Digital marketing Build campaigns around the next decision. Read next

Link destinations:
- `section_04_link_01_url` — Web development A practical guide to planning a website that can grow. Read next → `planning-scalable-website.html`
- `section_04_link_02_url` — Digital marketing Build campaigns around the next decision. Read next → `campaign-next-decision.html`

Images/media:
- `section_04_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_04_image_01_alt` (**Text**): [empty alt — decorative or alt text needed]
- `section_04_image_02` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_04_image_02_alt` (**Text**): [empty alt — decorative or alt text needed]

## Shared implementation notes

- Keep field keys unique and stable; use these suggested `name` values as the page-group field names or prefix them consistently.
- Use Repeater/Flexible Content subfields for repeated cards, FAQs, process steps, statistics, testimonials, and similar collections instead of one field per current example item.
- Preserve accessibility metadata as editable values where it is content-dependent: image alt text, link labels, section labels, and form labels.
- Keep security-critical form action/nonces and consent validation in PHP; do not turn those implementation details into editor-editable fields.
