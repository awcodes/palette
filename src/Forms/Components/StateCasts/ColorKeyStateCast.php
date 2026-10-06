<?php

declare(strict_types=1);

namespace Awcodes\Palette\Forms\Components\StateCasts;

use Filament\Schemas\Components\StateCasts\Contracts\StateCast;
use Filament\Schemas\Components\StateCasts\OptionStateCast;

/**
 * A stored colour is the full colour array unless the field uses storeAsKey(). The select's option cast drops
 * arrays, so the array is reduced to its key before that cast runs.
 */
class ColorKeyStateCast implements StateCast
{
    public function __construct(
        protected OptionStateCast $optionStateCast = new OptionStateCast,
    ) {}

    public function get(mixed $state): mixed
    {
        return $this->optionStateCast->get($state);
    }

    public function set(mixed $state): mixed
    {
        if (is_array($state)) {
            $state = $state['key'] ?? null;
        }

        return $this->optionStateCast->set($state);
    }
}
