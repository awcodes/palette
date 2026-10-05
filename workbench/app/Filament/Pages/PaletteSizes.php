<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Pages;

use Awcodes\Palette\Forms\Components\ColorPicker;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Workbench\App\Filament\Resources\Pages\PageResource;

/**
 * @property-read Schema $form
 */
class PaletteSizes extends Page
{
    /** @var array<string, mixed>|null */
    public ?array $data = [];

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedArrowsPointingOut;

    protected static ?string $title = 'Sizes';

    public function mount(): void
    {
        // Each size starts on a different colour, so the selected state shows on every row.
        $this->form->fill([
            'xs' => 'indigo',
            'sm' => 'badass',
            'md' => 'salmon',
            'lg' => 'bg-gradient-secondary',
            'xl' => 'indigo',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Swatch sizes')
                    ->extraAttributes(['data-focus' => 'sizes', 'class' => 'max-w-xl'])
                    ->schema(
                        collect(['xs', 'sm', 'md', 'lg', 'xl'])
                            ->map(fn (string $size): ColorPicker => PageResource::palette(ColorPicker::make($size))
                                ->label("size('{$size}')")
                                ->size($size))
                            ->all(),
                    ),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([EmbeddedSchema::make('form')]);
    }
}
