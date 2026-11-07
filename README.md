# Alify Custom WordPress Theme

A custom WordPress theme with the supplied Alify front-end converted into PHP templates. The imported design is the initial visual content; WordPress editor content and optional ACF Pro Flexible Content can replace it.

## Content model

- Public CPTs: Services, Work, Case Studies, Industries, FAQs, Pricing, and Testimonials.
- Each CPT has its own hierarchical category taxonomy and non-hierarchical tag taxonomy.
- Blog uses WordPress core Posts, Categories, Tags, and single-post templates.
- Primary and Footer navigation locations are registered and connected to the converted header/footer.
- Forms, Form Templates, and private Form Entries are admin-managed post types.

## Front-end conversion

- All 39 supplied HTML page bodies are converted to PHP view partials under `template-parts/source-pages/`; WordPress page, archive, single, and taxonomy templates route to them.
- The original complete source snapshot from `alifywork/alify-web`, branch `arena/08a66435-alify-web`, remains under `frontend-source/` for reference.
- Bootstrap grid, Font Awesome, GSAP/ScrollTrigger, source CSS/JavaScript, fonts, and images are loaded locally; there is no CDN dependency.
- Static `.html` links and relative asset paths are mapped to WordPress permalinks and theme asset URLs.
- Populated CPT/blog archives use live WordPress loops. Empty CPT/blog archives fall back to the source archive design.
- Matching source slugs use their supplied design by default. WordPress editor content or ACF Page Sections can replace the static body; ACF hero fields can override the imported hero.

## ACF Pro

ACF Pro is optional for activation. When active it adds Theme Settings and fields for general details, header/footer, forms, and a Flexible Content builder (text, image/text, card grid, FAQ, CTA). Forms use a repeater-based field builder; a Form can use a reusable Form Template when it has no fields of its own. ACF is not required for the starter source layouts or source inquiry forms.

## First-time setup

1. Activate the theme and optionally activate ACF Pro.
2. Go to **Appearance → Alify Setup** and click **Create / Repair Starter Pages & Content**. This creates the Pages, Services, Work, Case Studies, Industries, and Blog posts required by the source links. It is safe to rerun and does not overwrite matching content.
3. Set the homepage and Posts page under **Settings → Reading** if they are not already selected.
4. Assign Primary and Footer menus under **Appearance → Menus**. Without assigned menus, the supplied navigation remains as a fallback.
5. Save **Settings → Permalinks** once after activation to refresh rewrite rules.

The importer adds starter titles and slugs, not duplicated static HTML content. The PHP source views supply the initial presentation. Add editor content or ACF sections to customize an individual item.

## Forms and entries

- The supplied Contact and Start Project pages post securely to WordPress. They retain the on-page review step, then validate and save submissions as private Form Entries.
- Submissions include a nonce, required-field/email/URL validation, privacy consent, honeypot, and basic per-IP rate limiting. Notifications use `wp_mail()` and the configured Forms notification email (or WordPress admin email).
- Create reusable forms under **Forms**, configure fields in ACF Pro, then place `[alify_form id="123"]` in page content or an ACF text section. A Form Template can provide its field list.
- View submissions under **Form Entries**. Administrators can export them as CSV from **Form Entries → Export CSV**. The export contains personal information; handle it securely.
- Email delivery depends on the WordPress host's mail configuration; configure SMTP in production. Submissions are still stored as entries if mail delivery fails.
