<?php

namespace Awcodes\Palette\Concerns;

use Closure;
use Exception;

trait HasSize
{
    protected string | Closure | null $size = null;

    public function size(string | Closure $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function getSize(): string
    {
        $size = $this->evaluate($this->size);

        if ($size && ! in_array($size, ['xs', 'sm', 'md', 'lg', 'xl'])) {
            throw new Exception("Size must be one of 'xs', 'sm', 'md', 'lg', 'xl'");
        }

        return $size ?? 'md';
    }
}
