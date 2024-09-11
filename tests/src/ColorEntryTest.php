<?php

use Awcodes\Palette\Infolists\Components\ColorEntry;
use Awcodes\Palette\Tests\Fixtures\TestEntryComponent;
use Awcodes\Palette\Tests\Fixtures\TestInfolist;
use Filament\Infolists\ComponentContainer;
use function Pest\Livewire\livewire;

it('sets the right size', function () {
    $field = (new ColorEntry('color'))
        ->container(ComponentContainer::make(TestInfolist::make()))
        ->size('sm');

    expect($field)
        ->getSize()->toBe('sm');
});

it('only excepts specific sizes', function () {
    $field = (new ColorEntry('color'))
        ->container(ComponentContainer::make(TestInfolist::make()))
        ->size('2xl');

    $field->getSize();

})->throws(Exception::class, "Size must be one of 'xs', 'sm', 'md', 'lg', 'xl'");

it('can render the entry component', function () {
    livewire(TestEntryComponent::class)
        ->assertSee('palette-entry-item')
        ->assertSee('size-12')
        ->assertSee('238, 246, 213');
});
