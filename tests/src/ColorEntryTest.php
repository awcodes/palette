<?php

declare(strict_types=1);

use Awcodes\Palette\Infolists\Components\ColorEntry;
use Awcodes\Palette\Tests\Fixtures\TestEntryAsKeyComponent;
use Awcodes\Palette\Tests\Fixtures\TestEntryComponent;
use Awcodes\Palette\Tests\Fixtures\TestInfolist;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;

use function Pest\Livewire\livewire;

it('sets the right size', function () {
    $field = (new ColorEntry('color'))
        ->container(Schema::make(TestInfolist::make()))
        ->size('sm');

    expect($field)
        ->getSize()->toBe('sm');
});

it('only excepts specific sizes', function () {
    $field = (new ColorEntry('color'))
        ->container(Schema::make(TestInfolist::make()))
        ->size('2xl');

    $field->getSize();

})->throws(Exception::class, "Size must be one of 'xs', 'sm', 'md', 'lg', 'xl'");

it('can render the entry component', function () {
    livewire(TestEntryComponent::class)
        ->assertSee('palette-entry-item')
        ->assertSee('size-12')
        ->assertSee('238, 246, 213');
});

it('resolves a key stored by storeAsKey() against its colors', function () {
    $entry = (new ColorEntry('color'))
        ->container(Schema::make(TestInfolist::make()))
        ->colors([
            'badass' => Color::hex('#bada55'),
        ])
        ->shades([
            'badass' => 300,
        ])
        ->state('badass');

    expect($entry->getColor())
        ->toBeArray()
        ->and($entry->getColor()['key'])->toBe('badass')
        ->and($entry->getColor()['property'])->toBe('--badass-300')
        ->and($entry->getColor()['label'])->toBe('Badass');
});

it('can render the entry component from a stored key', function () {
    livewire(TestEntryAsKeyComponent::class)
        ->assertSee('palette-entry-item')
        ->assertSee('size-12');
});

it('passes a stored color array through untouched', function () {
    $color = [
        'key' => 'badass',
        'property' => '--badass-300',
        'label' => 'Badass',
        'type' => 'rgb',
        'value' => '238, 246, 213',
    ];

    $entry = (new ColorEntry('color'))
        ->container(Schema::make(TestInfolist::make()))
        ->state($color);

    expect($entry->getColor())->toBe($color);
});

it('returns null when there is no state', function () {
    $entry = (new ColorEntry('color'))
        ->container(Schema::make(TestInfolist::make()))
        ->state(null);

    expect($entry->getColor())->toBeNull();
});

it('returns null for a key that is not in its colors', function () {
    $entry = (new ColorEntry('color'))
        ->container(Schema::make(TestInfolist::make()))
        ->colors([
            'badass' => Color::hex('#bada55'),
        ])
        ->state('nope');

    expect($entry->getColor())->toBeNull();
});
