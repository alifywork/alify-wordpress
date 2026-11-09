# ACF Field Inventory — `blog`

Source: [`frontend-source/blog.html`](../../frontend-source/blog.html)

> This archive's SEO, hero, and section fields are in Theme Settings → Archive Pages. On populated archives, saved static edits render after live results; bundled article cards are omitted while WordPress drives cards/search/pagination.

Shared header/footer navigation and global contact/social settings are configured once in Theme Settings; they are not repeated as page-specific fields.

## SEO metadata

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `seo_title` | Text | Journal — Alify |
| `meta_description` | Textarea | Practical ALIFY perspectives on digital strategy, design, technology, and growth. |

## Hero

| ACF field | Suggested ACF type | Current source value |
|---|---|---|
| `hero_eyebrow` | Text | Journal / Ideas and perspectives |
| `hero_title` | Text | Think clearly. Build thoughtfully. |
| `hero_description` | Textarea | Notes and practical perspectives from the intersection of strategy, design, technology, and growth. |
| `hero_background` | Select/Image | neon-lines-04.webp |

## Main content fields

### 01. Featured article

Section metadata: aria-label: `Featured article`.

- `section_01_copy_01` — **Copy** (HTML `p`): The ALIFY journal
- `section_01_heading_01` — **Heading** (HTML `h2`): Useful ideas for building better digital.
- `section_01_copy_02` — **Copy** (HTML `p`): Practical notes on strategy, design, technology, and growth—written to help you make clearer decisions.
- `section_01_heading_02` — **Heading** (HTML `h2`): Why clarity is a conversion strategy.
- `section_01_copy_03` — **Copy** (HTML `p`): Conversion is often discussed as a button, a headline, or a persuasion technique. In practice, it is usually the result of something quieter: people understanding enough to take the next step with confidence.
- `section_01_link_label_01` — **Link Label** (HTML `a`): Read the featured article
- `section_01_inline_text_01` — **Inline Text** (HTML `span`): Featured · Experience design
- `section_01_inline_text_02` — **Inline Text** (HTML `span`): 6 min read

Link destinations:
- `section_01_link_01_url` — [image/icon-only link] → `blog-single.html`
- `section_01_link_02_url` — Read the featured article → `blog-single.html`

Images/media:
- `section_01_image_01` (**Image**): `assets/images/services/ui-ux-design.svg`
  - `section_01_image_01_alt` (**Text**): Animated experience design editorial illustration

Repeated content: 1 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 02. Latest articles

Section metadata: aria-label: `Latest articles`.

Interaction/filter data: `data-filter` = `all`; `data-filter` = `strategy`; `data-filter` = `technology`; `data-filter` = `growth`; `data-category` = `technology`; `data-category` = `technology`; `data-category` = `growth`; `data-category` = `growth`; `data-category` = `strategy`.

- `section_02_copy_01` — **Copy** (HTML `p`): Browse the journal
- `section_02_heading_01` — **Heading** (HTML `h2`): Explore by discipline.
- `section_02_copy_02` — **Copy** (HTML `p`): Filter the collection by the kind of challenge you are thinking about.
- `section_02_field_label_01` — **Field Label** (HTML `label`): Search articles
- `section_02_button_label_01` — **Button Label** (HTML `button`): All articles
- `section_02_button_label_02` — **Button Label** (HTML `button`): Strategy
- `section_02_button_label_03` — **Button Label** (HTML `button`): Technology
- `section_02_button_label_04` — **Button Label** (HTML `button`): Growth
- `section_02_heading_02` — **Heading** (HTML `h3`): A practical guide to planning a website that can grow.
- `section_02_copy_03` — **Copy** (HTML `p`): A practical framework for content, components, technology, and decisions that support the next phase.
- `section_02_link_label_01` — **Link Label** (HTML `a`): Read the perspective
- `section_02_heading_03` — **Heading** (HTML `h3`): Where automation creates useful space.
- `section_02_copy_04` — **Copy** (HTML `p`): How to find repetitive workflows worth improving without removing necessary human judgement.
- `section_02_link_label_02` — **Link Label** (HTML `a`): Read the perspective
- `section_02_heading_04` — **Heading** (HTML `h3`): Technical SEO is experience design too.
- `section_02_copy_05` — **Copy** (HTML `p`): Why crawlability, performance, structure, and accessible content serve both search visibility and people.
- `section_02_link_label_03` — **Link Label** (HTML `a`): Read the perspective
- `section_02_heading_05` — **Heading** (HTML `h3`): Build campaigns around the next decision.
- `section_02_copy_06` — **Copy** (HTML `p`): A practical way to connect channel creative, landing experiences, and measurement around real audience intent.
- `section_02_link_label_04` — **Link Label** (HTML `a`): Read the perspective
- `section_02_heading_06` — **Heading** (HTML `h3`): A brand identity should work before it impresses.
- `section_02_copy_07` — **Copy** (HTML `p`): How strategy, recognition, and a flexible visual language turn a logo into a useful identity system.
- `section_02_link_label_05` — **Link Label** (HTML `a`): Read the perspective
- `section_02_copy_08` — **Copy** (HTML `p`): No matching articles found. Try another search or discipline.
- `section_02_inline_text_01` — **Inline Text** (HTML `span`): Web development
- `section_02_inline_text_02` — **Inline Text** (HTML `span`): 7 min read
- `section_02_inline_text_03` — **Inline Text** (HTML `span`): AI automation
- `section_02_inline_text_04` — **Inline Text** (HTML `span`): 5 min read
- `section_02_inline_text_05` — **Inline Text** (HTML `span`): SEO
- `section_02_inline_text_06` — **Inline Text** (HTML `span`): 6 min read
- `section_02_inline_text_07` — **Inline Text** (HTML `span`): Digital marketing
- `section_02_inline_text_08` — **Inline Text** (HTML `span`): 5 min read
- `section_02_inline_text_09` — **Inline Text** (HTML `span`): Brand identity
- `section_02_inline_text_10` — **Inline Text** (HTML `span`): 6 min read

Link destinations:
- `section_02_link_01_url` — Read A practical guide to planning a website that can grow. → `planning-scalable-website.html`
- `section_02_link_02_url` — A practical guide to planning a website that can grow. → `planning-scalable-website.html`
- `section_02_link_03_url` — Read the perspective → `planning-scalable-website.html`
- `section_02_link_04_url` — Read Where automation creates useful space. → `useful-automation.html`
- `section_02_link_05_url` — Where automation creates useful space. → `useful-automation.html`
- `section_02_link_06_url` — Read the perspective → `useful-automation.html`
- `section_02_link_07_url` — Read Technical SEO is experience design too. → `technical-seo-experience.html`
- `section_02_link_08_url` — Technical SEO is experience design too. → `technical-seo-experience.html`
- `section_02_link_09_url` — Read the perspective → `technical-seo-experience.html`
- `section_02_link_10_url` — Read Build campaigns around the next decision. → `campaign-next-decision.html`
- `section_02_link_11_url` — Build campaigns around the next decision. → `campaign-next-decision.html`
- `section_02_link_12_url` — Read the perspective → `campaign-next-decision.html`
- `section_02_link_13_url` — Read A brand identity should work before it impresses. → `identity-that-works.html`
- `section_02_link_14_url` — A brand identity should work before it impresses. → `identity-that-works.html`
- `section_02_link_15_url` — Read the perspective → `identity-that-works.html`

Images/media:
- `section_02_image_01` (**Image**): `assets/images/services/web-development.svg`
  - `section_02_image_01_alt` (**Text**): Animated Web development editorial illustration
- `section_02_image_02` (**Image**): `assets/images/services/ai-automation.svg`
  - `section_02_image_02_alt` (**Text**): Animated AI automation editorial illustration
- `section_02_image_03` (**Image**): `assets/images/services/seo.svg`
  - `section_02_image_03_alt` (**Text**): Animated SEO editorial illustration
- `section_02_image_04` (**Image**): `assets/images/services/digital-marketing.svg`
  - `section_02_image_04_alt` (**Text**): Animated Digital marketing editorial illustration
- `section_02_image_05` (**Image**): `assets/images/services/logo-design.svg`
  - `section_02_image_05_alt` (**Text**): Animated Brand identity editorial illustration

Repeated content: 5 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 03. Editorial principles

Section metadata: aria-label: `Editorial principles`.

- `section_03_copy_01` — **Copy** (HTML `p`): Our editorial approach
- `section_03_heading_01` — **Heading** (HTML `h2`): Less noise. More useful thinking.
- `section_03_heading_02` — **Heading** (HTML `h3`): Practical over performative
- `section_03_copy_02` — **Copy** (HTML `p`): Ideas that help frame a decision, improve a process, or ask a better question.
- `section_03_heading_03` — **Heading** (HTML `h3`): Connected disciplines
- `section_03_copy_03` — **Copy** (HTML `p`): Strategy, design, content, and technology considered as parts of one experience.
- `section_03_heading_04` — **Heading** (HTML `h3`): Honest about trade-offs
- `section_03_copy_04` — **Copy** (HTML `p`): No universal formulas. Context, constraints, and priorities shape the right answer.
- `section_03_inline_text_01` — **Inline Text** (HTML `span`): 01
- `section_03_inline_text_02` — **Inline Text** (HTML `span`): 02
- `section_03_inline_text_03` — **Inline Text** (HTML `span`): 03

Repeated content: 3 `<article>` item(s) detected. Implement as an ACF Repeater/Flexible Content layout where editors need to add, remove, or reorder items; expose each item's heading, copy, image/alt, link label, and link URL as subfields when present.

### 04. Discuss your project

Section metadata: aria-label: `Discuss your project`.

- `section_04_copy_01` — **Copy** (HTML `p`): Bring us the real challenge
- `section_04_heading_01` — **Heading** (HTML `h2`): Turn the thinking into a useful next step.
- `section_04_copy_02` — **Copy** (HTML `p`): If an article connects with a problem you are facing, we can help you apply the thinking to your own context.
- `section_04_link_label_01` — **Link Label** (HTML `a`): Start a conversation

Link destinations:
- `section_04_link_01_url` — Start a conversation → `contact.html`

## Shared implementation notes

- Each top-level section is edited in one page-specific WYSIWYG field with Visual and Text tabs; the Text tab accepts HTML. The source section wrapper/layout remains theme-controlled.
- Link destinations and images/alt text have separate optional ACF overrides; leave them blank to retain the section HTML's original values.
- Repeated cards, FAQ items, process steps, statistics, and testimonials are edited together in their containing section HTML so the current page design is preserved.
- Form action/nonces, field names, required flags, choice values, and server validation remain theme-controlled; don't remove these form-control attributes while editing section HTML.
