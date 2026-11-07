# Alify Custom WordPress Theme

A backend-first theme foundation. The front-end designs and rendering have intentionally **not** been implemented yet, per project direction.

## Included structure

- Public custom post types: Services, Work, Case Studies, Industries, FAQs, Pricing, Testimonials.
- Category and tag taxonomies for each custom post type.
- Blog remains WordPress core Posts, Categories, Tags, and the default single-post system.
- Navigation locations: Primary Menu and Footer Menu.
- Optional ACF Pro integration: Theme Settings options pages and starter settings/form field groups. The theme continues to load if ACF Pro is not activated; its options pages appear after ACF Pro is installed and active.
- Admin-managed Form, Form Template, and Form Entry post types. Form fields/configuration use an ACF repeater; entries have admin columns and a submitted-data detail box.
- WordPress permalink template files for custom post type archives, singles, and taxonomy archives, plus page-template placeholders for the requested standard pages. These are intentionally blank placeholders until frontend designs are supplied.

## Requested page templates

Use the page editor's Template selector to choose Home Page, About Us, Contact Us, Start Project, or Legal Page. Set the Home Page under **Settings → Reading** as the static front page.

## Important notes

- After activating the theme, visit **Settings → Permalinks** and save once to refresh rewrite rules.
- The forms area is currently a backend data/configuration scaffold only. There is no public form renderer, submission endpoint, validation, email delivery, or spam protection yet, because frontend work was explicitly deferred.
- The form entry type is private and is not exposed in public search or REST API.
- The duplicated Testimonials request was treated as one content type.

## Imported static-site source

The complete source snapshot from `alifywork/alify-web`, branch `arena/08a66435-alify-web`, is preserved in `frontend-source/`. It is kept as a separate directory so none of its static files overwrite this WordPress theme's PHP entry points or theme documentation. The snapshot includes the original HTML pages, assets, and project documentation; it is not yet converted into WordPress templates or wired to the ACF content model.
