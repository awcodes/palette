<?php

declare(strict_types=1);

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class TestComponent extends TestForm
{
    public function form(Schema $form): Schema
    {
        return $form
            ->statePath('data')
            ->schema([
                TextInput::make('title'),
                TextInput::make('slug'),
                ColorPicker::make('color')
                    ->colors([
                        ...FilamentColor::getColors(),
                        'badass' => Color::hex('#bada55'),
                        'salmon' => '#fa8072',
                        'bg-gradient-secondary' => 'bg-gradient-secondary',
                    ])
                    ->size('sm')
                    ->withBlack()
                    ->withWhite(),
                ColorPicker::make('color_as_key')
                    ->colors([
                        ...FilamentColor::getColors(),
                        'badass' => Color::hex('#bada55'),
                        'salmon' => '#fa8072',
                        'bg-gradient-secondary' => 'bg-gradient-secondary',
                    ])
                    ->size('sm')
                    ->withBlack()
                    ->withWhite()
                    ->storeAsKey(),
            ]);
    }
}
