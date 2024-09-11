<?php

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class TestComponent extends TestForm
{
    public function form(Form $form): Form
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
