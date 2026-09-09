<?php

declare(strict_types=1);

namespace Awcodes\Palette;

use Illuminate\Support\Collection;

class Palette
{
    public function processColors(array $colors, ?array $shades = [], ?array $labels = []): array | Collection
    {
        return collect($colors)->mapWithKeys(fn (array | string $color, string $key): array => [$key => $this->buildColor($key, $color, $shades, $labels)]);
    }

    public function buildColor(string $key, array | string $color, array $shades, array $labels): array
    {
        if (is_array($color)) {
            $value = isset($shades[$key]) ? $color[$shades[$key]] : $color[500];
            $shade = $shades[$key] ?? 500;
        } else {
            $value = $color;
            $shade = null;
        }

        $label = $labels[$key] ?? (string) str($key)->title()->replace('-', ' ');
        $type = $this->determineType($value);

        return [
            'key' => $key,
            'property' => '--' . $key . ($shade ? '-' . $shade : ''),
            'label' => $label,
            'type' => $type,
            'value' => $value,
        ];
    }

    public function determineType(string $value): string
    {
        if (preg_match('/^#?[a-fA-F0-9]{6}$/', $value) === 1) {
            return 'hex';
        }

        if (preg_match("/(\d{1,3},\s\d{1,3},\s\d{1,3})/", $value) === 1) {
            return 'rgb';
        }

        if (str_starts_with($value, 'oklch')) {
            return 'oklch';
        }

        return 'class';
    }
}
