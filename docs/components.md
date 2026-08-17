---
title: Components
description: The ColorPicker and ColorPickerSelect form fields, the ColorEntry infolist entry, and the color options they share.
---

# Components

Palette provides two form components and one infolist component. The two form fields take exactly the same color options and differ only in how they present them.

## ColorPicker

A row of clickable swatches:

```php
use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Support\Colors\Color;

ColorPicker::make('color')
    ->colors([
        'indigo' => Color::Indigo,
        'badass' => Color::hex('#bada55'),
        'salmon' => '#fa8072',
        'bg-gradient-secondary' => 'bg-gradient-secondary',
    ])
    ->shades([
        'badass' => 300,
    ])
    ->labels([
        'bg-gradient-secondary' => 'Gradient Secondary',
    ])
    ->size('sm')
    ->withBlack(swap: '#111111')
    ->withWhite(swap: '#f5f5f5'),
```

## ColorPickerSelect

The same palette as a dropdown, with a swatch rendered beside each option. Useful where a row of swatches would be too wide, or where the palette is long enough that scanning a list is easier.

```php
use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Filament\Support\Colors\Color;

ColorPickerSelect::make('color')
    ->colors([
        'indigo' => Color::Indigo,
        'badass' => Color::hex('#bada55'),
        'salmon' => '#fa8072',
        'bg-gradient-secondary' => 'bg-gradient-secondary',
    ])
    ->shades([
        'badass' => 300,
    ])
    ->labels([
        'bg-gradient-secondary' => 'Gradient Secondary',
    ])
    ->withBlack(swap: '#111111')
    ->withWhite(swap: '#f5f5f5'),
```

Options are sorted alphabetically by label, regardless of the order you define them in.

> [!NOTE]
> `ColorPickerSelect` does not support `size()`. Sizing applies to swatch grids, not to select options.

## ColorEntry

Renders a stored color as a swatch in an infolist:

```php
use Awcodes\Palette\Infolists\Components\ColorEntry;

ColorEntry::make('color')
    ->size('sm'),
```

`ColorEntry` also accepts `colors()`, `shades()` and `labels()`. It only needs them when the column was written with `storeAsKey()` — then the state is just a key, and the entry resolves it against these colors. See [Storing colors](storing-colors.md).

## Defining colors

### colors()

Pass an array keyed by the name you want stored. Values may be:

- A Filament color object — `Color::Indigo`, or `Color::hex('#bada55')`. These carry a full shade range.
- A plain hex string — `'#fa8072'`. Stored as-is, with no shades.
- A CSS class name — `'bg-gradient-secondary'`. Useful for gradients and anything else a single color value cannot express.

If you never call `colors()`, Palette falls back to the colors registered with your panel via `FilamentColor::getColors()`. Passing an explicit array is usually what you want, since the registered set includes Filament's own semantic colors.

### shades()

Filament color objects contain a range of shades. `shades()` selects which one to use, keyed by color:

```php
->shades([
    'badass' => 300,
])
```

Any color you do not list uses shade `500`. A color given as a plain hex string or a CSS class has no shades at all, so an entry for it has no effect.

> [!NOTE]
> Shades only work with Filament color objects.

### labels()

By default, a color's label is derived from its key — title-cased, with dashes replaced by spaces, so `bg-gradient-secondary` becomes "Bg Gradient Secondary". Override it where that reads badly:

```php
->labels([
    'bg-gradient-secondary' => 'Gradient Secondary',
])
```

### withWhite() and withBlack()

Black and white are not part of Filament's registered colors, so Palette adds them on request. Both are appended to the end of the palette, after your own colors:

```php
->withWhite()
->withBlack(),
```

They default to `#ffffff` and `#000000`. Pass `swap` to substitute a softer value — useful when pure black and white are not in your design system:

```php
->withBlack(swap: '#111111')
->withWhite(swap: '#f5f5f5'),
```

### size()

Available on `ColorPicker` and `ColorEntry`. Accepts `xs`, `sm`, `md`, `lg` or `xl`, and defaults to `md`:

```php
->size('sm'),
```

> [!WARNING]
> Any other value throws an exception rather than falling back to the default, so avoid computing the size from user input without validating it first.
