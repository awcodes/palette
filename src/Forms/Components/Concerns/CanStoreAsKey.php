<?php

declare(strict_types=1);

namespace Awcodes\Palette\Forms\Components\Concerns;

use Closure;

trait CanStoreAsKey
{
    protected bool|Closure|null $storeAsKey = null;

    public function storeAsKey(bool|Closure|null $condition = true): static
    {
        $this->storeAsKey = $condition;

        return $this;
    }

    public function shouldStoreAsKey(): bool
    {
        $storeAsKey = $this->evaluate($this->storeAsKey);

        if ($storeAsKey !== null) {
            return (bool) $storeAsKey;
        }

        return (bool) config('palette.store_as_key', false);
    }
}
