<?php

namespace Awcodes\Palette\Infolists\Components;

use Awcodes\Palette\Concerns\HasSize;
use Filament\Infolists\Components\Entry;

class ColorEntry extends Entry
{
    use HasSize;

    protected string $view = 'palette::infolists.components.color-entry';
}
