<?php

declare(strict_types=1);

namespace Awcodes\Palette\Tests\Fixtures;

use Workbench\App\Models\Page;

class TestEditSelectComponent extends TestSelectComponent
{
    public function mount(): void
    {
        $this->form->fill(Page::query()->firstOrFail()->attributesToArray());
    }
}
