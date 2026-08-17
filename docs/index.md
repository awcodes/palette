---
title: Palette
description: A color picker field for Filament forms that offers a preset palette of colors rather than a free-form picker.
---

# Palette

Palette gives Filament forms a color picker restricted to a palette you define. Instead of a free-form picker that can produce any value, the user chooses from a fixed set of swatches — your brand colors, your theme's registered colors, or whatever list you pass in.

It is for content that has to stay on-brand. When an editor picks a heading color or a section background, you usually want them choosing from the design system rather than typing a hex value.

## What's included

Palette ships three components:

- **`ColorPicker`** — a row of clickable color swatches, for forms.
- **`ColorPickerSelect`** — the same palette as a searchable dropdown with a swatch beside each option, for forms where a row of swatches would be too wide.
- **`ColorEntry`** — renders a stored color as a swatch, for infolists.

All three read the same color definitions and understand the same stored format.

## Compatibility

| Package version | Filament version |
|---|---|
| 1.x | 3.x |
| 2.x | 4.x |
| 3.x | 4.x and 5.x |

## Where to go next

- [Installation](installation.md) — install the package and register its views with your theme.
- [Components](components.md) — the fields and entry, and the color options they share.
- [Storing colors](storing-colors.md) — how the selected color is saved, and how to store just the key instead.
- [Styling](styling.md) — the CSS classes available for customization.
