<?php

namespace Awcodes\Palette;

use Illuminate\Support\Collection;

class Palette
{
    public function processColors(array $colors, ?array $shades = []): array | Collection
    {
        return collect($colors)->mapWithKeys(function ($color, $key) use ($shades) {
            return [$key => $this->buildColor($key, $color, $shades)];
        });
    }

    public function buildColor(string $key, array | string $color, array $shades): array
    {
        if (is_array($color)) {
            $value = isset($shades[$key]) ? $color[$shades[$key]] : $color[500];
            $shade = $shades[$key] ?? 500;
        } else {
            $value = $color;
            $shade = null;
        }

        $type = $this->determineType($value);

        return [
            'key' => $key,
            'property' => '--' . $key . ($shade ? '-' . $shade : ''),
            'label' => (string) str($key)->title()->replace('-', ' '),
            'type' => $type,
            'value' => $value,
        ];
    }

    public function determineType(string $value): string
    {
        if (preg_match('/(^#?[a-f0-9]{6})/', $value) === 1) {
            return 'hex';
        } elseif (preg_match("/([a-f0-9]{3}$)|(\d{1,3},\s\d{1,3},\s\d{1,3})/", $value) === 1) {
            return 'rgb';
        }

        return 'class';
    }
}
