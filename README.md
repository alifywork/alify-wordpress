# Alify Custom WordPress Theme

A custom WordPress theme scaffold with the supplied Alify static front-end converted into PHP templates. The imported design is the visual fallback; WordPress content and optional ACF Pro Flexible Content can provide dynamic replacements.

## Content model

- Public custom post types: Services, Work, Case Studies, Industries, FAQs, Pricing, Testimonials.
- Each custom post type has its own hierarchical category taxonomy and non-hierarchical tag taxonomy.
- Blog uses WordPress core Posts, Categories, Tags, and the default single-post system.
- Navigation locations: Primary Menu and Footer Menu.
- Admin-managed Form, Form Template, and Form Entry post types. ACF Pro provides form field configuration and settings; entries have admin columns and a submitted-data detail box.

## Front-end conversion

- All 39 supplied HTML page bodies are converted to PHP view partials in `template-parts/source-pages/` and routed through WordPress page, archive, single, and taxonomy templates.
- The original complete source snapshot from `alifywork/alify-web`, branch `arena/08a66435-alify-web`, remains under `frontend-source/` for reference.
- Bootstrap grid, Font Awesome, GSAP/ScrollTrigger, all source CSS/JavaScript, fonts, and images are served locally from the imported assets; no CDN is required.
- Static `.html` links and relative media paths are translated to WordPress permalinks and theme asset URLs.
- Populated archives use live WordPress loops. If a CPT/blog archive is empty, the imported archive view is displayed as a visual starter.
- Matching source slugs display their supplied design by default. Adding WordPress editor content or ACF Page Sections replaces the static body; ACF hero fields can override the imported hero.

## ACF Pro

ACF Pro is optional for theme activation. When active, it adds Theme Settings and fields for general details, header/footer settings, forms, and a Flexible Content page builder with text, image/text, card grid, FAQ, and CTA layouts. Without ACF Pro, imported static views and WordPress editor content still work.

## Setup

1. Activate the theme and install/activate ACF Pro if desired.
2. Create WordPress Pages or CPT entries with matching source slugs to make the corresponding designs reachable. Examples: pages `about`, `contact`, `start-project`, `privacy-policy`; Services `web-development`, `seo`; archive URLs are registered with their CPTs.
3. Assign Primary and Footer menus under **Appearance → Menus**. Assigned WordPress menus replace the source navigation; otherwise the supplied navigation remains.
4. Set the static homepage and optional Posts page under **Settings → Reading**.
5. Save **Settings → Permalinks** once after activation to refresh rewrite rules.

## Form limitation

Contact and Start Project keep the supplied client-side `mailto:` flow. Public form rendering, server-side submission/validation, entry creation, email delivery, and spam protection are not connected yet. The Forms/Entries admin structures are ready for that next step. The duplicated Testimonials item from the original request is implemented once.
