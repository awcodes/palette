<?php

declare(strict_types=1);

namespace Workbench\Database\Factories;

use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Factories\Factory;
use Workbench\App\Models\Page;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'color' => null,
            'select_color' => null,
            'color_as_key' => null,
            'select_color_as_key' => null,
        ];
    }

    public function configured(): static
    {
        return $this->state(fn (): array => [
            'title' => 'Palette Workbench',
            'slug' => 'palette-workbench',
            'color' => $this->color('indigo', Color::Indigo),
            'select_color' => null,
            'color_as_key' => 'emerald',
            'select_color_as_key' => 'amber',
        ]);
    }

    private function color(string $key, array $shades): array
    {
        return [
            'key' => $key,
            'property' => "--{$key}-500",
            'label' => str($key)->headline()->toString(),
            'type' => 'rgb',
            'value' => $shades[500],
        ];
    }
}
