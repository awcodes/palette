---
title: Storing colors
description: How Palette saves a selected color, how to cast the column, and how to store only the color's key.
---

# Storing colors

## Casting the column

By default Palette stores the selected color as an array, so the column must be cast to `array` or `json` on your model:

```php
protected $casts = [
    'content' => 'array', // or 'json'
];
```

## The stored shape

A saved color looks like this:

```php
[
    'key' => 'primary',
    'property' => '--primary-500',
    'label' => 'Primary',
    'type' => 'rgb',
    'value' => '238, 246, 213',
]
```

Each key is derived as follows:

| Key | Meaning |
|---|---|
| `key` | The array key you gave the color in `colors()`. |
| `property` | A CSS custom property name — `--{key}` for a flat color, or `--{key}-{shade}` when the color came from a Filament color object. |
| `label` | The label from `labels()`, or the title-cased key. |
| `type` | One of `hex`, `rgb`, `oklch` or `class`, detected from the value. |
| `value` | The resolved color value at the selected shade. |

Storing the whole array means you can render the color without looking anything up — you have the value, a property name to bind it to, and a label to display.

The `class` type is what makes CSS-class colors work. A value like `bg-gradient-secondary` is not a color at all, so Palette marks it as a class and you apply it as one rather than as a value.

## Storing only the key

If you would rather store a plain string, use `storeAsKey()` on the field:

```php
use Awcodes\Palette\Forms\Components\ColorPicker;

ColorPicker::make('color')
    ->storeAsKey(),
```

The column then holds `'primary'` rather than the full array, so it does not need an `array` cast. You give up the resolved value, property and label — you will need to resolve the key against your palette yourself when rendering.

To apply it across every Palette field, set it in the config file instead:

```php
// config/palette.php
return [
    'store_as_key' => true,
];
```

> [!NOTE]
> The field-level modifier can only turn this behaviour on, not off. `shouldStoreAsKey()` returns `true` if the field opts in, and otherwise falls back to the config value — so when `store_as_key` is `true` globally, passing `storeAsKey(false)` on an individual field will not switch it back to storing the full array.

## Reading a stored color

> [!WARNING]
> `ColorEntry` requires the full array shape. It reads `label`, `value` and `type` off the stored state directly, so pointing it at a column written with `storeAsKey()` will fail rather than render a swatch.

If you store keys and still want a swatch in an infolist, resolve the key back to a color yourself — look it up in the same palette you passed to the field — and render it, or keep the full array for records that need to be displayed this way. See [Components](components.md).
