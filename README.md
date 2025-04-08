# Former Model Brand Blocks

A cleanly structured WordPress plugin built using [WPPB.me](https://wppb.me/) that introduces Gutenberg-based content blocks tied to WooCommerce brands.

## Plugin Purpose

This plugin:

1. Registers a custom post type called **Brand Blocks**.
2. Connects each **Brand Block** to a specific WooCommerce brand.
3. Outputs the associated **Brand Block** on WooCommerce brand archive pages, replacing the default brand description.

## Installation

1. Upload and activate plugin.
2. Create new Brand Blocks in the **Brand Blocks** admin, as if you are creating a post.
3. From the Brand admin, you can now link a **Brand Block** post type. It will appear beneath the Brand title, and above the brand product grid, in place of the default description.


## Plugin Directory Structure

```
├── LICENSE.txt
├── README.txt
├── fm-brand-blocks.php
├── index.php
├── languages/
│   └── fm-brand-blocks.pot
├── uninstall.php
├── includes/
│   ├── class-fm-brand-blocks-activator.php
│   ├── class-fm-brand-blocks-deactivator.php
│   ├── class-fm-brand-blocks-i18n.php
│   ├── class-fm-brand-blocks-loader.php
│   ├── class-fm-brand-blocks.php
│   ├── class-fm-brand-blocks-cpt.php
│   └── index.php
├── admin/
│   ├── class-fm-brand-blocks-admin.php
│   ├── class-fm-brand-blocks-admin-brand-connection.php
│   ├── css/
│   │   └── fm-brand-blocks-admin.css
│   ├── index.php
│   ├── js/
│   │   └── fm-brand-blocks-admin.js
│   └── partials/
│       └── fm-brand-blocks-admin-display.php
└── public/
    ├── class-fm-brand-blocks-public.php
    ├── css/
    │   └── fm-brand-blocks-public.css
    ├── index.php
    ├── js/
    │   └── fm-brand-blocks-public.js
    └── partials/
        └── fm-brand-blocks-public-display.php
```

## How it Works

### 1. Registers the Custom Post Type

Located at: `includes/class-fm-brand-blocks-cpt.php`

This file defines a class (`FM_Brand_Blocks_CPT`) with a `register_post_type()` method to register a Gutenberg-enabled custom post type called **Brand Block**.

> ✅ _Explanation: This step defines how the Brand Block content type is created and managed._

### 2. Loads the CPT Class in the Bootstrap File

Located at: `fm-brand-blocks.php`

This ensures the CPT file is included and available to the plugin.

> ✅ _Explanation: This step includes the CPT class so WordPress knows about it when the plugin loads._

### 3. Registers the Hook to Initialize the CPT

Located in: `includes/class-fm-brand-blocks.php` inside the `define_public_hooks()` method.

Hooks the `register_post_type()` method to WordPress’s `init` action.

> ✅ _Explanation: This step actually runs the CPT registration when WordPress initializes._

### 4. Connects a Brand to a Brand Block

File: `admin/class-fm-brand-blocks-admin-brand-connection.php`

- Adds a dropdown to WooCommerce brand edit screens.
- Saves the selected Brand Block on update.

Hooks added in `includes/class-fm-brand-blocks.php`:

```php
$this->loader->add_action( 'pa_brand_edit_form_fields', $brand_connection, 'edit_brand_form_field' );
$this->loader->add_action( 'edited_pa_brand', $brand_connection, 'save_brand_block_connection' );
```

> ✅ _Explanation: This step enables associating a specific Brand Block with a WooCommerce brand._

### 5. Displays Brand Block on Brand Archive Pages

Method added in `public/class-fm-brand-blocks-public.php`:

```php
public function maybe_output_brand_block() {
    ...
}
```

Hooked into `woocommerce_archive_description`:

```php
$this->loader->add_action( 'woocommerce_archive_description', $plugin_public, 'maybe_output_brand_block' );
```

This replaces the brand archive description with the associated Brand Block content (if one is selected and published), falling back to the term description if not.

> ✅ _Explanation: This step displays the Brand Block on the front end instead of the brand description._

## Theme Considerations

- The plugin assumes the WooCommerce archive template displays `woocommerce_archive_description`.
- If you're using a customized `archive-product.php` (e.g., in a child theme like Astra), make sure it includes `do_action( 'woocommerce_archive_description' )`.
- Will require template editing on FSE block themes.

## To-Do

- Ensure default WooCommerce templates display brand descriptions if needed.
- Add support for WooCommerce category descriptions (optional).

## License

Licensed under GNU General Public License (GPL). See [LICENSE.txt](LICENSE.txt) for details.
