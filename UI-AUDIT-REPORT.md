# Alify WordPress UI Audit and Remediation

## Scope and evidence

This report records source-level follow-up work against the supplied live UI audit and the current theme checkout. The live audit text supplied with the task is dated **2026-11-09**. Its route counts, HTTP responses, browser observations, and responsive results are attributed to that report; they were not reproduced in this workspace. The current workspace does not include the referenced `http://alify.local/` WordPress installation, PHP runtime, or browser.

Accordingly, this report distinguishes code changes from claims needing confirmation in the target WordPress environment. No forms were submitted in this work.

## Findings addressed in source

### Healthcare and Real Estate URL mapping

The bundled Healthcare and Real Estate views, their source links, and their images exist. The generic URL resolver could select a colliding Page/attachment-style slug or construct a bare root path. `alify_resolve_source_url()` now explicitly routes `healthcare` and `real-estate` to `/industries/healthcare/` and `/industries/real-estate/`, matching the registered Industries archive rewrite. The starter manifest creates those as published Industry records when setup runs.

**Still requires live verification:** install/activate the updated theme, run Alify Setup if records are absent, refresh permalinks if needed, and confirm both URLs render Industry pages rather than attachments.

### Privacy Policy route and starter copy

The supplied audit reports a guest-facing privacy URL failure and WordPress-generated “Suggested text” content. When the Privacy Policy source view encounters that standard WordPress placeholder marker, it now bypasses the placeholder body and renders the bundled privacy-template view instead. That template has a main landmark and explicit review-required guidance. Its statements have been replaced with prompts to document verified business practices; it no longer asserts specific collection, sale, retention, processor, or rights practices as facts.

The Forms setting may still point to a page selected by the site administrator. The URL and visitor access for that configured page must be checked on the target site. This change does **not** create or claim an approved legal notice. The privacy, Terms & Conditions, and Cookie Policy content must be completed and reviewed against actual operations and applicable law before launch.

### Blog search/filter and archive cards

The dynamic archive now renders the first result as a visually featured card within the same WordPress loop as all other results. Taxonomy filters and search are server-side controls over the archive query, so the featured result is included in filtering/search rather than being left outside the result set. Archive cards have named image links; thumbnail images receive meaningful alternative text (attachment alt text when present, otherwise the post title). Pagination is retained, and empty archives/searches receive a helpful message.

This common archive UI applies to Blog and the public post-type archives: Work, Case Studies, Services, Industries, FAQs, Pricing, and Testimonials. Populated-data appearance and filter behavior still need browser verification with actual WordPress records.

### Published WordPress demo content

Alify Setup now checks for the canonical, unchanged WordPress `Sample Page` and `Hello world!` records. It moves a record to Draft only when its post type, slug, title, publication status, and default body all match. Edited/custom records are preserved. This cleanup runs when an administrator explicitly runs **Appearance → Alify Setup**; it does not silently alter content during theme activation.

### Homepage, Contact, and Start a Project forms

Source inquiry markup now inserts homepage consent inside the form, immediately before its submit/footer block (or before the form actions as a fallback), rather than after `</form>`. Contact and Start a Project keep their consent controls before the submit action. The homepage consent checkbox and link receive compact, responsive styles. Existing server-side required-consent validation is retained.

No form submission or live responsive check was performed.

## Route/search/accessibility observations from the supplied live report

The supplied report describes 39 configured routes plus `/sample-page/` and `/hello-world/`, and responsive checks at 1440, 1024, 768, 390, and 320 pixels. It reports the two Industry paths rendering image attachments, the Privacy Policy guest/admin issue, Blog featured-story filtering omission, and an unnamed featured Work image link. It also reports that Contact/Start a Project required-field/consent checks remained invalid until complete, no duplicate IDs or unlabeled visible controls, and no console errors. These remain **reported observations**, not independently verified results from this coding workspace.

## Validation limits and next checks

- No local WordPress runtime or browser is available in this workspace; live routes, dashboard menus, HTTP statuses, screenshots, breakpoints, and actual query/filter responses were not exercised.
- Do not treat a successful source check as proof that the target WordPress site's permalinks, selected Privacy Policy page, published Industry records, or admin capabilities are configured correctly.
- After deployment, verify guest access to the policy URL and both Industry URLs, Blog/Work filters and searches including featured results, empty/populated archives, image-link accessible names, and mobile widths. Review legal copy before publication. Do not submit forms merely as a test.
