<?php

declare(strict_types=1);

namespace Workbench\Database\Seeders;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Illuminate\Database\Seeder;
use Workbench\App\Filament\Resources\Pages\PageResource;
use Workbench\App\Models\Page;
use Workbench\Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        UserFactory::new()->create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => 'password']);

        // One page with a fixed colour in every field, so the documentation screenshots select the same swatches on
        // every build. The array columns hold exactly what the field stores; the key columns hold just the key.
        $colors = PageResource::palette(ColorPicker::make('color'))->getColors();

        Page::query()->create([
            'title' => 'Palette Workbench',
            'slug' => 'palette-workbench',
            'color' => $colors['indigo'],
            'select_color' => $colors['salmon'],
            'color_as_key' => 'badass',
            'select_color_as_key' => 'bg-gradient-secondary',
            'created_at' => '2026-01-01 09:00:00',
            'updated_at' => '2026-01-01 09:00:00',
        ]);
    }
}
