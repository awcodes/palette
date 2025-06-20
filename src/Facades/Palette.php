<?php

declare(strict_types=1);

namespace Awcodes\Palette\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection processColors(array $colors, null | array $shades, null | array $labels)
 * @method static array buildColor(string $key, array | string $color, array $shades)
 * @method static string determineType(string $value)
 *
 * @see \Awcodes\Palette\Palette
 */
class Palette extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Awcodes\Palette\Palette::class;
    }
}
