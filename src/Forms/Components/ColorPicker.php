<?php

namespace Awcodes\Palette\Forms\Components;

use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Field;

class ColorPicker extends Field
{
    use Concerns\HasColors;
    use \Awcodes\Palette\Concerns\HasSize;
    use HasExtraInputAttributes;

    protected string $view = 'palette::forms.components.color-picker';

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->afterStateHydrated(function (ColorPicker $component, $state) {
                if (! $state) {
                    return;
                }

                $component->state($state['key']);
            })
            ->dehydrateStateUsing(function (ColorPicker $component, $state) {
                if (! $state) {
                    return null;
                }

                return $component->getColors()[$state];
            });
    }
}
