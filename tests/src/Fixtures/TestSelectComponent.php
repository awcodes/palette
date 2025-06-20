<?php

declare(strict_types=1);

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class TestSelectComponent extends TestForm
{
    public function form(Schema $form): Schema
    {
        return $form
            ->statePath('data')
            ->schema([
                TextInput::make('title'),
                TextInput::make('slug'),
                ColorPickerSelect::make('select_color')
                    ->colors([
                        ...collect(FilamentColor::getColors())->toArray(),
                        'badass' => Color::hex('#bada55'),
                        'salmon' => '#fa8072',
                    ])
                    ->shades(['badass' => 300, 'danger' => 800])
                    ->withWhite()
                    ->withBlack(),
                ColorPickerSelect::make('select_color_as_key')
                    ->colors([
                        ...collect(FilamentColor::getColors())->toArray(),
                        'badass' => Color::hex('#bada55'),
                        'salmon' => '#fa8072',
                    ])
                    ->shades(['badass' => 300, 'danger' => 800])
                    ->withWhite()
                    ->withBlack()
                    ->storeAsKey(),
            ]);
    }
}
