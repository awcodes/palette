<?php

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Filament\Forms\Form;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class TestSelectComponent extends TestForm
{
    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                ColorPickerSelect::make('color')
                    ->colors([
                        ...collect(FilamentColor::getColors())->toArray(),
                        'badass' => Color::hex('#bada55'),
                        'salmon' => '#fa8072',
                    ])
                    ->withWhite()
                    ->withBlack()
                    ->shades(['badass' => 300, 'danger' => 800]),
            ]);
    }
}
