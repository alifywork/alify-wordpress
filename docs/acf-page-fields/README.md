# ACF Page Field Inventories

Generated from all 39 bundled source pages in `frontend-source/*.html` by `tools/generate-acf-page-field-docs.py`.

The companion `inc/acf-page-field-data.json` is the runtime schema used to register the page-specific ACF fields and preserve each source section as its default HTML.
Every singular source page has a page-specific ACF field group registered in PHP. Its fields follow that page's actual sections, with separate headings, copy, CTA/link destinations, and images/alt text. Repeated cards, FAQs, and homogeneous lists use per-item ACF Repeaters where the source template repeats. The same source single layouts and fields are available on Blog Posts, Services, Work, Case Studies, and Industries unless a record has a more specific source mapping. Source-managed pages hide the generic Flexible Content builder and standard content editor; the generic fallback appears only when no source-template group matches. Template wrappers and layout remain theme-controlled. The eight dynamic archive pages have corresponding SEO, hero, and section fields under Theme Settings → Archive Pages. On populated archives, saved static section edits render after live results; bundled article cards are omitted while WordPress drives cards, search, and pagination. Forms expose separate copy/label editing while theme-owned control markup and validation stay fixed. ACF Pro is required for the Repeater and options-page features.

The source defaults and renderer mappings are generated into `inc/acf-page-field-data.json`. Shared Theme Settings and the generic Flexible Content builder remain defined in `inc/acf.php`. The ACF groups are local PHP registrations; no ACF export plugin or generated database JSON is required.

## Pages

- [`about`](about.md)
- [`ai-automation`](ai-automation.md)
- [`blog-single`](blog-single.md)
- [`blog`](blog.md)
- [`campaign-next-decision`](campaign-next-decision.md)
- [`case-studies`](case-studies.md)
- [`case-study-single`](case-study-single.md)
- [`commerce-project`](commerce-project.md)
- [`contact`](contact.md)
- [`cookie-policy`](cookie-policy.md)
- [`digital-marketing`](digital-marketing.md)
- [`ecommerce`](ecommerce.md)
- [`faqs`](faqs.md)
- [`healthcare`](healthcare.md)
- [`identity-project`](identity-project.md)
- [`identity-that-works`](identity-that-works.md)
- [`index`](index.md)
- [`industries`](industries.md)
- [`industry-single`](industry-single.md)
- [`logo-design`](logo-design.md)
- [`planning-scalable-website`](planning-scalable-website.md)
- [`pricing`](pricing.md)
- [`privacy-policy`](privacy-policy.md)
- [`project-single`](project-single.md)
- [`projects`](projects.md)
- [`property-project`](property-project.md)
- [`real-estate`](real-estate.md)
- [`seo`](seo.md)
- [`service-single`](service-single.md)
- [`services`](services.md)
- [`start-project`](start-project.md)
- [`startups`](startups.md)
- [`technical-seo-experience`](technical-seo-experience.md)
- [`terms-and-conditions`](terms-and-conditions.md)
- [`testimonials`](testimonials.md)
- [`ui-ux-design`](ui-ux-design.md)
- [`useful-automation`](useful-automation.md)
- [`web-development`](web-development.md)
- [`wellness-project`](wellness-project.md)
