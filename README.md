# Alify Custom WordPress Theme

A custom WordPress theme with the supplied Alify front-end converted into PHP templates. The imported design is the initial visual content; WordPress editor content and optional ACF Pro Flexible Content can replace it.

## Content model

- Public CPTs: Services, Work, Case Studies, Industries, FAQs, Pricing, and Testimonials.
- Each CPT has its own hierarchical category taxonomy and non-hierarchical tag taxonomy.
- Blog uses WordPress core Posts, Categories, Tags, and single-post templates.
- Primary and Footer navigation locations are registered and connected to the converted header/footer. The WordPress Primary Menu merges with the supplied desktop/mobile mega menus instead of removing them.
- Forms, Form Templates, and private Form Entries are admin-managed post types.

## Front-end conversion

- All 39 supplied HTML page bodies are converted to PHP view partials under `template-parts/source-pages/`; WordPress page, archive, single, and taxonomy templates route to them.
- The original complete source snapshot from `alifywork/alify-web`, branch `arena/08a66435-alify-web`, remains under `frontend-source/` for reference.
- Bootstrap grid, Font Awesome, GSAP/ScrollTrigger, source CSS/JavaScript, fonts, and images are loaded locally; there is no CDN dependency.
- Page-hero headings and accessible basic header/footer navigation remain available without JavaScript; when enabled, scripts enhance the server-rendered hero and render the full interactive header/footer components.
- Static `.html` links and relative asset paths are mapped to WordPress permalinks and theme asset URLs. Without an SEO plugin, source-derived excerpts and archive descriptions provide fallback meta descriptions.
- Populated CPT/blog archives use live WordPress loops. Empty CPT/blog archives fall back to the source archive design. Search results use a searchable archive grid that preserves the relevant post types; 404 pages offer search, services, and home links.
- Matching source slugs use their supplied design by default. WordPress editor content or ACF Page Sections can replace the static body; ACF hero fields can override the imported hero.

## ACF Pro

ACF Pro is optional for activation. When active it adds Theme Settings and fields for general details, header/footer, forms, and a Flexible Content builder (text, image/text, card grid, FAQ, CTA). Theme Settings, form definitions, and Form Templates are restricted to users with the `manage_options` capability. Forms use a repeater-based field builder; a Form can use a reusable Form Template when it has no fields of its own. ACF is not required for the starter source layouts or source inquiry forms.

## First-time setup

1. Activate the theme and optionally activate ACF Pro.
2. Go to **Appearance → Alify Setup** and click **Create / Repair Starter Pages & Content**. This creates the Pages, Services, Work, Case Studies, Industries, and Blog posts required by the source links, along with the source hero and main body as editable WordPress content and source-derived excerpts. It also copies supported raster artwork into the WordPress Media Library and assigns matching featured images where available; SVG illustrations, fonts, CSS, and JavaScript remain in the local theme bundle. It is safe to rerun and preserves matching records, existing body content, featured images, and editor-authored excerpts. Imported records retain a source-identity marker, so changing a starter record’s public slug does not make setup create a duplicate.
3. Set the homepage and Posts page under **Settings → Reading** if they are not already selected.
4. Assign Primary and Footer menus under **Appearance → Menus**. Without assigned menus, the supplied navigation remains as a fallback.
5. Rewrite rules are flushed once on theme activation. If URLs return 404 later, save **Settings → Permalinks** to refresh them again.

The importer extracts each source page hero and main body into the WordPress editor once, while preserving the converted PHP view as the default presentation. In the Alify Page Presentation box, choose **WordPress editor content** to publish your edited body, or leave **Original Alify design** selected. Rerunning setup never overwrites a non-empty body or excerpt. ACF Page Sections remain available as a structured alternative, and dynamic archive cards display editable excerpts.

## Forms and entries

- The homepage, Contact, and Start Project inquiry forms submit to WordPress and save validated submissions as private Form Entries. Contact and Start Project retain their on-page review step; the homepage form includes a privacy-consent checkbox and direct submission.
- Submissions include a nonce, required-field/email/URL validation, privacy consent, honeypot, and basic per-IP rate limiting. Notifications use `wp_mail()` and the configured Forms notification email (or WordPress admin email).
- Create reusable forms under **Forms**, configure fields in ACF Pro, then place `[alify_form id="123"]` in page content or an ACF text section. A Form Template can provide its field list.
- View submissions under **Form Entries**; entry access and CSV export are restricted to users with the site administrator capability. Export from **Form Entries → Export CSV**. The export contains personal information; handle it securely.
- Serve forms over HTTPS and configure SMTP in production; `wp_mail()` delivery depends on the WordPress host. Submissions are still stored as entries if mail delivery fails.
- CRM delivery, file attachments, production-grade bot protection, and submission monitoring require deployment-specific services and configuration; the theme does not claim these are enabled.
- If full-page caching is enabled, exclude pages containing forms so cached nonce fields do not expire. Form entries are retained until an administrator deletes them; apply your own retention schedule and secure any CSV exports.
- Privacy, cookie, and terms pages are starter copy, not legal advice. Review them against the actual business entity, data processors, retention, jurisdictions, and user-rights process before launch.
