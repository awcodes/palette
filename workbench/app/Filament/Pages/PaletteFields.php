<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Pages;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Workbench\App\Filament\Resources\Pages\PageResource;

/**
 * Both fields in one section, so each share card shows the swatch picker and the select's open dropdown together.
 *
 * @property-read Schema $form
 */
class PaletteFields extends Page
{
    /** @var array<string, mixed>|null */
    public ?array $data = [];

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedPaintBrush;

    protected static ?string $title = 'Fields';

    public function mount(): void
    {
        $this->form->fill([
            'picker' => 'indigo',
            'select' => 'salmon',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Palette')
                    ->extraAttributes(['data-focus' => 'fields', 'class' => 'max-w-xl'])
                    ->schema([
                        PageResource::palette(ColorPicker::make('picker'))
                            ->label('ColorPicker')
                            ->size('lg'),
                        PageResource::palette(ColorPickerSelect::make('select'))
                            ->label('ColorPickerSelect'),
                    ]),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([EmbeddedSchema::make('form')]);
    }
}
