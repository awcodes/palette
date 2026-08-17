<?php

declare(strict_types=1);

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Infolists\Components\ColorEntry;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;

class TestEntryAsKeyComponent extends TestInfolist
{
    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->state([
                'color' => 'badass',
            ])
            ->schema([
                ColorEntry::make('color')
                    ->colors([
                        'badass' => Color::hex('#bada55'),
                    ])
                    ->shades([
                        'badass' => 300,
                    ])
                    ->size('xl'),
            ]);
    }
}
