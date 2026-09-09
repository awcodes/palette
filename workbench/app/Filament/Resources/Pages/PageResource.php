<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Resources\Pages;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Awcodes\Palette\Infolists\Components\ColorEntry;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Workbench\App\Filament\Resources\Pages\Pages\EditPage;
use Workbench\App\Filament\Resources\Pages\Pages\ListPages;
use Workbench\App\Filament\Resources\Pages\Pages\ViewPage;
use Workbench\App\Models\Page;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedSwatch;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            ColorPicker::make('color')->colors(self::colors()),
            ColorPickerSelect::make('select_color')->colors(self::colors()),
            ColorPicker::make('color_as_key')->colors(self::colors())->storeAsKey(),
            ColorPickerSelect::make('select_color_as_key')->colors(self::colors())->storeAsKey(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            ColorEntry::make('color')->colors(self::colors()),
            ColorEntry::make('select_color')->colors(self::colors()),
            ColorEntry::make('color_as_key')->colors(self::colors()),
            ColorEntry::make('select_color_as_key')->colors(self::colors()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([TextColumn::make('title')]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'view' => ViewPage::route('/{record}'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }

    private static function colors(): array
    {
        return [
            'indigo' => Color::Indigo,
            'rose' => Color::Rose,
            'emerald' => Color::Emerald,
            'amber' => Color::Amber,
        ];
    }
}
