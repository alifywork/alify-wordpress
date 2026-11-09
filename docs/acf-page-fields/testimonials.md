# ACF Field Inventory — `testimonials`

Source: [`frontend-source/testimonials.html`](../../frontend-source/testimonials.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Testimonials — Alify |
| `meta_description` | Textarea | Read testimonials about partnering with the Alify digital studio. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Testimonials |
| `hero_title` | Text | What thoughtful collaboration should feel like. |
| `hero_description` | Textarea | Explore illustrative perspectives and the partnership principles that shape a thoughtful ALIFY collaboration. |
| `hero_background` | Select/Image | neon-lines-14.webp |

## Main content fields

### 01. Client perspectives

Section metadata: aria-label: `Client perspectives`.

- `section_01_copy_01` — **Copy** (HTML `p`): Client perspectives · Demo content
- `section_01_heading_01` — **Heading** (HTML `h2`): What good collaboration should feel like.
- `section_01_copy_02` — **Copy** (HTML `p`): Clear communication, shared ownership, thoughtful craft, and a result everyone can stand behind.
- `section_01_quote_01` — **Quote** (HTML `blockquote`): “The process made a complicated brief feel manageable. Every decision had a reason, and every conversation moved the work forward.”
- `section_01_caption_01` — **Caption** (HTML `figcaption`): Product lead · SaaS concept · Demo content
- `section_01_copy_03` — **Copy** (HTML `p`): These are illustrative testimonials for layout purposes. Replace them with verified client quotes and attribution before publication.
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): 01 / FEATURED PERSPECTIVE

### 02. More perspectives

Section metadata: aria-label: `More perspectives`.

- `section_02_quote_01` — **Quote** (HTML `blockquote`): “The strongest outcome was clarity. The team connected our brand, website, and product story instead of treating them as separate tasks.”
- `section_02_caption_01` — **Caption** (HTML `figcaption`): Founder · Startup concept · Demo content
- `section_02_quote_02` — **Quote** (HTML `blockquote`): “Thoughtful questions early on saved us from making expensive assumptions later.”
- `section_02_caption_02` — **Caption** (HTML `figcaption`): Operations director · Automation concept · Demo content
- `section_02_quote_03` — **Quote** (HTML `blockquote`): “The work balanced creativity with practicality. It felt distinctive without losing sight of the people using it.”
- `section_02_caption_03` — **Caption** (HTML `figcaption`): Marketing lead · Retail concept · Demo content
- `section_02_quote_04` — **Quote** (HTML `blockquote`): “Progress was visible, feedback was specific, and the final system gave our team room to keep building.”
- `section_02_caption_04` — **Caption** (HTML `figcaption`): Digital manager · Services concept · Demo content
- `section_02_quote_05` — **Quote** (HTML `blockquote`): “A collaborative process with genuine care in the details—from content hierarchy to the smallest interaction.”
- `section_02_caption_05` — **Caption** (HTML `figcaption`): Product owner · Platform concept · Demo content
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): 02
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 03
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): 04
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 05
- `section_02_inline_text_05` — **Inline Text** (HTML `span`): 06

### 03. Partnership principles

Section metadata: aria-label: `Partnership principles`.

- `section_03_copy_01` — **Copy** (HTML `p`): Beyond the testimonial
- `section_03_heading_01` — **Heading** (HTML `h2`): The partnership principles behind the words.
- `section_03_copy_02` — **Copy** (HTML `p`): The experience of working together matters as much as the final presentation.
- `section_03_heading_02` — **Heading** (HTML `h3`): Direct and honest
- `section_03_copy_03` — **Copy** (HTML `p`): Useful conversations, candid recommendations, and clear visibility when priorities change.
- `section_03_heading_03` — **Heading** (HTML `h3`): Shared ownership
- `section_03_copy_04` — **Copy** (HTML `p`): We care about the outcome and expect collaboration, not a one-way handoff.
- `section_03_heading_04` — **Heading** (HTML `h3`): Reliable in the details
- `section_03_copy_05` — **Copy** (HTML `p`): Decisions documented, feedback organised, and quality considered throughout.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Who we help

Section metadata: aria-label: `Who we help`.

- `section_04_copy_01` — **Copy** (HTML `p`): Who we help
- `section_04_heading_01` — **Heading** (HTML `h2`): Different teams. The same care.
- `section_04_copy_02` — **Copy** (HTML `p`): From an early-stage founder to an established in-house team, we adapt the collaboration to your context. The constants are curiosity, clarity, and attention to useful detail.
- `section_04_list_item_01` — **List Item** (HTML `li`): Founders
- `section_04_list_item_02` — **List Item** (HTML `li`): Product teams
- `section_04_list_item_03` — **List Item** (HTML `li`): Marketing teams
- `section_04_list_item_04` — **List Item** (HTML `li`): Operations teams
- `section_04_list_item_05` — **List Item** (HTML `li`): Independent businesses
- `section_04_list_item_06` — **List Item** (HTML `li`): Growing organisations
- `section_04_link_label_01` — **Link Label** (HTML `a`): Start a conversation

Link destinations:
- `section_04_link_01_url` — Start a conversation → `contact.html`

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
