# WordPress Admin Menu Fix Report

## Reported issue

The local WordPress installation showed missing **Settings** and Alify **Forms** menu items with this theme active. The reporter observed that the menus returned after changing themes. The issue is attributed to theme capability registration, but this workspace does not contain that WordPress installation, so I could not reproduce the dashboard behavior here.

## Source-level cause and fix

The theme registers `alify_form`, `alify_form_template`, and `alify_form_entry` as administrator-only custom post types. Primitive capabilities (such as `edit_posts`, `publish_posts`, and `delete_posts`) require `manage_options`. The `edit_post`, `read_post`, and `delete_post` meta-capabilities are kept as WordPress' recognized meta-capability names; they are not mapped directly to the global `manage_options` primitive. Assigning `manage_options` to those meta-capabilities can interfere with WordPress' global capability mapping and hide unrelated admin menus.

**Implemented in:** `inc/content-types.php`

Form definitions remain under **Forms**. Form Templates and private Form Entries are nested beneath it. Form management and entry access remain restricted to administrators.

## Verification status

- Source review confirms the form post types have an administrator capability boundary and do not assign `manage_options` to the meta-capability names.
- Static PHP syntax/grammar checks were run in earlier work for the current codebase; this environment has no PHP runtime or WordPress installation for an integration test.
- The current menu visibility, Settings access, capability mapping, and Forms/Form Templates/Entries interactions have **not** been re-tested in the reporter's live/local WordPress dashboard.

After installing the current theme, sign in as an administrator, reload the dashboard, confirm **Settings** and **Forms** are visible, and open Forms, Form Templates, Form Entries, and Forms Settings. Also test with a non-administrator account to confirm restricted menus and entry data remain inaccessible.
