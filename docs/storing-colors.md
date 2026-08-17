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

The field-level modifier always wins over the config. With `store_as_key` enabled globally, an individual field can still opt out and store the full array:

```php
ColorPicker::make('color')
    ->storeAsKey(false),
```

A field that never calls `storeAsKey()` follows the config value.

## Reading a stored color

`ColorEntry` handles both shapes. Given a full array it renders it directly. Given a key, it resolves that key against its own colors — so pass the entry the same palette you gave the field:

```php
use Awcodes\Palette\Infolists\Components\ColorEntry;
use Filament\Support\Colors\Color;

ColorEntry::make('color')
    ->colors([
        'badass' => Color::hex('#bada55'),
    ])
    ->shades([
        'badass' => 300,
    ]),
```

Without a matching entry in `colors()` there is nothing to resolve the key to, so the entry renders nothing rather than a broken swatch. The same applies when the column is empty. See [Components](components.md).
