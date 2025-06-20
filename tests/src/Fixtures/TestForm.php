<?php

declare(strict_types=1);

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Tests\Fixtures\Models\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Livewire\Component;

class TestForm extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public static function make(): static
    {
        return new static;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Page::create($data);
    }

    public function update(): void
    {
        $data = $this->form->getState();

        $page = Page::first();

        $page->update($data);
    }

    public function render(): string
    {
        return <<<'HTML'
        <div>{{ $this->form }}</div>
        HTML;
    }
}
