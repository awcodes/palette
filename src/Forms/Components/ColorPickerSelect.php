<?php

declare(strict_types=1);

namespace Awcodes\Palette\Forms\Components;

use Awcodes\Palette\Forms\Components\Concerns\CanStoreAsKey;
use Awcodes\Palette\Forms\Components\Concerns\HasColors;
use Closure;
use Exception;
use Filament\Forms\Components\Select;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;
use JsonException;

class ColorPickerSelect extends Select
{
    use CanStoreAsKey;
    use HasColors;

    protected bool|Closure $isHtmlAllowed = true;

    protected bool|Closure $isNative = false;

    /**
     * @throws JsonException
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->options($this->getOptions())
            ->afterStateHydrated(function (ColorPickerSelect $component, string|array|null $state): void {
                if (in_array($state, ['', '0', [], null], true)) {
                    return;
                }

                if (is_array($state)) {
                    $component->state($state['key'] ?? null);

                    return;
                }

                $component->state($state);
            })
            ->dehydrateStateUsing(function (ColorPickerSelect $component, string|array|null $state) {
                if (in_array($state, ['', '0', [], null], true)) {
                    return null;
                }

                if (is_string($state) && ! $this->shouldStoreAsKey()) {
                    return $component->getColors()[$state];
                }

                return $state;
            });
    }

    public function getOptions(): array
    {
        return collect($this->getColors())
            ->sortBy('label')
            ->mapWithKeys(fn (array $color): array => [$color['key'] => $this->getOptionView($color)])
            ->toArray();
    }

    public function getOptionView(array $color): string|Htmlable
    {
        return Blade::render('palette::forms.components.select-option', ['color' => $color]);
    }
}
