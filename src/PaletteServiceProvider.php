<?php

declare(strict_types=1);

/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace Awcodes\Palette;

use Awcodes\Palette\Testing\TestsPalette;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Features\SupportTesting\Testable;
use ReflectionException;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PaletteServiceProvider extends PackageServiceProvider
{
    public static string $name = 'palette';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews();
    }

    /**
     * @throws ReflectionException
     */
    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make(
                id: 'palette-select-styles',
                path: __DIR__.'/../resources/dist/palette-select-styles.css'
            )->loadedOnRequest(),
        ], 'awcodes/palette');

        Testable::mixin(new TestsPalette);
    }
}
