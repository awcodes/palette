---
title: Styling
description: The CSS classes Palette exposes for customizing the picker, the select options and the infolist entry.
---

# Styling

Palette puts a stable class on each part of its markup so you can restyle the components from your theme without overriding the views.

## ColorPicker

| Class | Applies to |
|---|---|
| `palette-color-picker` | The container holding the swatches. |
| `palette-color-picker-item` | Each individual swatch. |
| `palette-color-picker-item-active` | The currently selected swatch. |

## ColorPickerSelect

| Class | Applies to |
|---|---|
| `palette-select-option` | Each option in the dropdown — the swatch and its label. |

## ColorEntry

| Class | Applies to |
|---|---|
| `palette-entry-item` | The swatch rendered in an infolist. |

## Example

Because these classes sit alongside Palette's own utility classes, target them from your theme's CSS:

```css
.palette-color-picker {
    gap: 0.5rem;
}

.palette-color-picker-item-active {
    outline: 2px solid var(--primary-600);
}
```

Sizing is better handled through the `size()` modifier than in CSS — see [Components](components.md).
