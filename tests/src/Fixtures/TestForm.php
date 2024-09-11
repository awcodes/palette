<?php

namespace Awcodes\Palette\Tests\Fixtures;

use Awcodes\Palette\Tests\Models\Page;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class TestForm extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

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
