<?php

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Infolists\Components\ColorEntry;
use Filament\Infolists\Infolist;

class TestEntryComponent extends TestInfolist
{
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'color' => [
                    'key' => 'badass',
                    'property' => '--badass-300',
                    'label' => 'Badass',
                    'type' => 'rgb',
                    'value' => '238, 246, 213',
                ],
            ])
            ->schema([
                ColorEntry::make('color')
                    ->size('xl'),
            ]);
    }
}
