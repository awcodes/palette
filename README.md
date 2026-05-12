# Palette

A color picker field for Filament Forms that uses preset color palettes.

[![Latest Version](https://img.shields.io/github/release/awcodes/palette.svg?style=flat-square&color=blue&label=Release)](https://github.com/awcodes/palette/releases)
[![MIT Licensed](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/palette.svg?style=flat-square&color=blue&label=Downloads)](https://packagist.org/packages/awcodes/palette)
[![GitHub Repo stars](https://img.shields.io/github/stars/awcodes/palette?style=flat-square&color=blue&label=Stars)](https://github.com/awcodes/palette/stargazers)

## Compatibility

| Package Version | Filament Version |
|-----------------|------------------|
| 1.x             | 3.x              |
| 2.x             | 4.x              |
| 3.x             | 5.x              |

<!-- [docs_start] -->

## Installation

You can install the package via composer:

```bash
composer require awcodes/palette
```

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels follow the instructions in the [Filament Docs](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) first.

After setting up a custom theme add the plugin's views to your theme css file or your app's css file if using the standalone packages.

```css
@source '../../../../vendor/awcodes/palette/resources/**/*.blade.php';
```

## Config

The plugin will work without publishing the config, but should you need to change any of the default settings you can publish the config file with the following Artisan command:

```bash
php artisan vendor:publish --tag="palette-config"
```

## Preparing your model

By default, Palette will store the selected color in your db as an array of data. Because of this you must cast the column in your model as `array` or `json`.

```php
protected $casts = [
    'content' => 'array', // or 'json'
];
```

The stored content will take the following shape:

```php
[
    'key' => 'primary',
    'property' => '--primary-500',
    'label' => 'Primary',
    'type' => 'rgb',
    'value' => '238, 246, 213',
]
```

### Storing the data as the color's key

Should you prefer to store only the key for the color you can do so either by using the `storeAsKey()` modifier on the `ColorPicker` or `ColorPickerSelect` fields or globally via the `palette.php` config file.

```php
use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Support\Colors\Color;

ColorPicker::make('color')
    ->storeAsKey(),
```

## Color Picker Field

Simply add the field to your form using the `ColorPicker` field and pass in an array of Filament Color objects.

Should you need to include black and white in your color palette, you can use the `withWhite` and `withBlack` methods. This will include black and white at the end of the color options. You can also use the 'swap' argument to swap out the hex value used for black and white.

> [!NOTE]
> Shades only work with Filament Color objects

```php
use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Support\Colors\Color;

ColorPicker::make('color')
    ->colors([
        'indigo' => Color::Indigo,
        'badass' => Color::hex('#bada55'),
        'salmon' => '#fa8072',
        'bg-gradient-secondary' => 'bg-gradient-secondary'
    ])
    ->shades([
        'badass' => 300
    ])
    ->labels([
        'bg-gradient-secondary' => 'Gradient Secondary'
    ])
    ->size('sm') // optional 'xs', 'sm', 'md', 'lg', 'xl'
    ->withBlack(swap: '#111111')
    ->withWhite(swap: '#f5f5f5'),
```

## Color Picker Select

Simply add the field to your form using the `ColorPickerSelect` field and pass in an array of Filament Color objects.

Should you need to include black and white in your color palette, you can use the `withWhite` and `withBlack` methods. This will include black and white at the end of the color options. You can also use the 'swap' argument to swap out the hex value used for black and white.

> [!NOTE]
> Shades only work with Filament Color objects

```php
use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Filament\Support\Colors\Color;

ColorPickerSelect::make('color')
    ->colors([
        'indigo' => Color::Indigo,
        'badass' => Color::hex('#bada55'),
        'salmon' => '#fa8072',
        'bg-gradient-secondary' => 'bg-gradient-secondary'
    ])
    ->shades([
        'badass' => 300
    ])
    ->labels([
        'bg-gradient-secondary' => 'Gradient Secondary'
    ])
    ->withBlack(swap: '#111111')
    ->withWhite(swap: '#f5f5f5'),
```

## Color Entry

Simply add the `ColorEntry` to your infolist schema.

```php
use Awcodes\Palette\Infolists\Components\ColorEntry;

ColorEntry::make('color')
    ->size('sm') // optional 'xs', 'sm', 'md', 'lg', 'xl'
```

## Style Hook Classes

Available classes for css customizations on the ColorPicker:

- for the main container: `palette-color-picker`
- for items: `palette-color-picker-item`
- for active/selected item: `palette-color-picker-item-active`

Available classes for css customizations on the ColorEntry:

- for the main container: `palette-entry-item`

<!-- [docs_end] -->

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Adam Weston](https://github.com/awcodes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
