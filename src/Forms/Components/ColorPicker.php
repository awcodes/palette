<?php

namespace Awcodes\Palette\Forms\Components;

use Awcodes\Palette\Concerns\HasSize;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Field;

class ColorPicker extends Field
{
    use Concerns\CanStoreAsKey;
    use Concerns\HasColors;
    use HasExtraInputAttributes;
    use HasSize;

    protected string $view = 'palette::forms.components.color-picker';

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->afterStateHydrated(function (ColorPicker $component, string | array | null $state) {
                if (! $state) {
                    return;
                }

                if (is_array($state)) {
                    $component->state($state['key'] ?? null);

                    return;
                }

                $component->state($state);
            })
            ->dehydrateStateUsing(function (ColorPicker $component, string | array | null $state) {
                if (! $state) {
                    return null;
                }

                if (is_string($state) && ! $this->shouldStoreAsKey()) {
                    return $component->getColors()[$state];
                }

                return $state;
            });
    }
}
