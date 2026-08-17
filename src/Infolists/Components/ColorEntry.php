<?php

declare(strict_types=1);

namespace Awcodes\Palette\Infolists\Components;

use Awcodes\Palette\Concerns\HasSize;
use Awcodes\Palette\Forms\Components\Concerns\HasColors;
use Filament\Infolists\Components\Entry;

class ColorEntry extends Entry
{
    use HasColors;
    use HasSize;

    protected string $view = 'palette::infolists.components.color-entry';

    /**
     * Resolve the entry's state to a full color array.
     *
     * The state is already a color array when the field stored one. When the
     * field used storeAsKey() the state is just the key, so it is looked up
     * against this entry's colors.
     *
     * @return array<string, mixed>|null
     */
    public function getColor(): ?array
    {
        $state = $this->getState();

        if (blank($state)) {
            return null;
        }

        if (is_array($state)) {
            return $state;
        }

        return $this->getColors()[$state] ?? null;
    }
}
