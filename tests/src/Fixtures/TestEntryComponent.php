<?php

declare(strict_types=1);

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Infolists\Components\ColorEntry;
use Filament\Schemas\Schema;

class TestEntryComponent extends TestInfolist
{
    public function infolist(Schema $infolist): Schema
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
