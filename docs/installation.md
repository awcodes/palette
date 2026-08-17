---
title: Installation
description: Install Palette, register its views with your Filament theme, and publish the config file.
---

# Installation

## Install the package

Install Palette via Composer:

```bash
composer require awcodes/palette
```

## Register the views with your theme

Palette ships Blade views with Tailwind classes, so your theme has to scan them or the components will render unstyled.

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels, follow the [Filament custom theme instructions](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) first.

Once you have a custom theme, add Palette's views to your theme's CSS file — or your app's CSS file if you are using the standalone packages:

```css
@source '../../../../vendor/awcodes/palette/resources/**/*.blade.php';
```

The path is relative to the CSS file it appears in. The four levels of `../` assume the default theme location at `resources/css/filament/admin/theme.css`; adjust it if your theme lives elsewhere.

## Publish the config file

Palette works without publishing its config. Publish it only if you want to change a default:

```bash
php artisan vendor:publish --tag="palette-config"
```

The published file has a single option:

```php
return [
    'store_as_key' => false,
];
```

Setting `store_as_key` to `true` makes every Palette field store just the color's key instead of the full color array. See [Storing colors](storing-colors.md) for what that changes.

## Next

With the package installed and your theme scanning its views, add a component to a form — see [Components](components.md).
