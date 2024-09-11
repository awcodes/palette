<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace Awcodes\Palette;

use Awcodes\Palette\Testing\TestsPalette;
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
        Testable::mixin(new TestsPalette);
    }
}
