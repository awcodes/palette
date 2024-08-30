<?php

namespace Awcodes\Palette\Forms\Components\Concerns;

use Awcodes\Palette\Facades\Palette;
use Closure;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Collection;

trait HasColors
{
    protected array | Closure | null $colors = null;

    protected array | Closure | null $shades = null;

    protected bool | Closure | null $hasWhite = null;

    protected bool | Closure | null $hasBlack = null;

    protected ?string $swapWhite = null;

    protected ?string $swapBlack = null;

    /**
     * @param  array<Color>|Closure  $colors
     */
    public function colors(array | Closure $colors): static
    {
        $this->colors = $colors;

        return $this;
    }

    public function shades(array | Closure $shades): static
    {
        $this->shades = $shades;

        return $this;
    }

    public function withWhite(bool | Closure $hasWhite = true, ?string $swap = null): static
    {
        $this->hasWhite = $hasWhite;
        $this->swapWhite = $swap;

        return $this;
    }

    public function withBlack(bool | Closure $hasBlack = true, ?string $swap = null): static
    {
        $this->hasBlack = $hasBlack;
        $this->swapBlack = $swap;

        return $this;
    }

    public function getColors(): array | Collection
    {
        $colors = $this->evaluate($this->colors) ?? FilamentColor::getColors();

        if ($this->hasWhite()) {
            $colors['white'] = $this->swapWhite ?? '#ffffff';
        }

        if ($this->hasBlack()) {
            $colors['black'] = $this->swapBlack ?? '#000000';
        }

        return Palette::processColors($colors, $this->getShades());
    }

    public function getShades(): array
    {
        return $this->evaluate($this->shades) ?? collect(FilamentColor::getColors())->mapWithKeys(function ($color, $key) {
            return [$key => 500];
        })->toArray();
    }

    public function hasWhite(): bool
    {
        return $this->evaluate($this->hasWhite) ?? false;
    }

    public function hasBlack(): bool
    {
        return $this->evaluate($this->hasBlack) ?? false;
    }
}
