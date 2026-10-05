<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Resources\Pages;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Awcodes\Palette\Infolists\Components\ColorEntry;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
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
            self::palette(ColorPicker::make('color'))
                ->extraFieldWrapperAttributes(['data-focus' => 'color-picker']),
            self::palette(ColorPickerSelect::make('select_color')),
            self::palette(ColorPicker::make('color_as_key'))->storeAsKey(),
            self::palette(ColorPickerSelect::make('select_color_as_key'))->storeAsKey()
                ->extraFieldWrapperAttributes(['data-focus' => 'color-picker-select']),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Page colors')
                ->columns(4)
                ->columnSpanFull()
                ->extraAttributes(['data-focus' => 'color-entries', 'class' => 'max-w-3xl'])
                ->schema([
                    self::palette(ColorEntry::make('color')),
                    self::palette(ColorEntry::make('select_color')),
                    self::palette(ColorEntry::make('color_as_key')),
                    self::palette(ColorEntry::make('select_color_as_key')),
                ]),
            TextEntry::make('title'),
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

    /**
     * Apply the palette from the Components documentation, so the screenshots match its examples.
     *
     * @template TComponent of ColorPicker|ColorPickerSelect|ColorEntry
     *
     * @param  TComponent  $component
     * @return TComponent
     */
    public static function palette(ColorPicker | ColorPickerSelect | ColorEntry $component): ColorPicker | ColorPickerSelect | ColorEntry
    {
        // A closure, because colors() documents its array as array<Color>, which rejects the hex and class values
        // the documentation's palette mixes in. Both forms are evaluated the same way.
        return $component
            ->colors(fn (): array => [
                'indigo' => Color::Indigo,
                'badass' => Color::hex('#bada55'),
                'salmon' => '#fa8072',
                'bg-gradient-secondary' => 'bg-gradient-secondary',
            ])
            ->shades([
                'badass' => 300,
            ])
            ->labels([
                'bg-gradient-secondary' => 'Gradient Secondary',
            ])
            ->withBlack(swap: '#111111')
            ->withWhite(swap: '#f5f5f5');
    }
}
