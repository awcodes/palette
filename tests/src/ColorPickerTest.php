<?php

use Awcodes\Palette\Facades\Palette;
use Awcodes\Palette\Forms\Components\ColorPicker;
use Awcodes\Palette\Tests\Fixtures\TestComponent;
use Awcodes\Palette\Tests\Fixtures\TestForm;
use Awcodes\Palette\Tests\Models\Page;
use Filament\Forms\ComponentContainer;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

use function Pest\Livewire\livewire;

it('has default colors', function () {
    $field = (new ColorPicker('color'))
        ->container(ComponentContainer::make(TestForm::make()));

    expect($field)
        ->getColors()->toHaveKeys(array_keys(FilamentColor::getColors()));
});

it('supports custom colors', function () {
    $field = (new ColorPicker('color'))
        ->container(ComponentContainer::make(TestForm::make()))
        ->colors([
            'badass' => Color::hex('#bada55'),
            'salmon' => '#fa8072',
            'bg-gradient-secondary' => 'bg-gradient-secondary',
        ])
        ->shades([
            'badass' => 200,
        ]);

    $colors = $field->getColors();

    expect($colors)
        ->toHaveKeys(['badass', 'salmon', 'bg-gradient-secondary'])
        ->and($colors['badass']['property'])->toBe('--badass-200')
        ->and($colors['salmon']['property'])->toBe('--salmon')
        ->and($colors['bg-gradient-secondary']['property'])->toBe('--bg-gradient-secondary');
});

it('sets the right size', function () {
    $field = (new ColorPicker('color'))
        ->container(ComponentContainer::make(TestForm::make()))
        ->size('sm');

    expect($field)
        ->getSize()->toBe('sm');
});

it('adds white and black', function () {
    $field = (new ColorPicker('color'))
        ->container(ComponentContainer::make(TestForm::make()))
        ->withBlack()
        ->withWhite();

    expect($field)
        ->getColors()->toHaveKeys(['white', 'black']);
});

it('swaps white and black', function () {
    $field = (new ColorPicker('color'))
        ->container(ComponentContainer::make(TestForm::make()))
        ->withBlack(swap: '#ef4444')
        ->withWhite(swap: '#22c55e');

    $colors = $field->getColors();

    expect($colors)
        ->toHaveKeys(['black', 'white'])
        ->and($colors['black']['value'])->toBe('#ef4444')
        ->and($colors['white']['value'])->toBe('#22c55e');
});

it('can render the form component', function () {
    livewire(TestComponent::class)
        ->assertFormFieldExists('color')
        ->assertSee('palette-color-picker')
        ->assertSee('rgba(186, 218, 85, 1)');
});

it('can save correct data', function () {
    $page = Page::factory()->make();

    livewire(TestComponent::class)
        ->fillForm([
            'title' => $page->title,
            'slug' => $page->slug,
            'color' => 'badass',
            'color_as_key' => 'salmon',
        ])
        ->assertFormSet([
            'color' => 'badass',
            'color_as_key' => 'salmon',
        ])
        ->call('save')
        ->assertHasNoFormErrors()
        ->assertSet('data.color', 'badass')
        ->assertSet('data.color_as_key', 'salmon');

    $this->assertDatabaseHas(Page::class, [
        'color' => json_encode(Palette::buildColor('badass', Color::hex('#bada55'), [])),
        'color_as_key' => 'salmon',
    ]);
});

it('can update correct data', function () {
    $page = Page::factory()->create();

    livewire(TestComponent::class)
        ->fillForm([
            'title' => $page->title,
            'slug' => $page->slug,
            'color' => 'badass',
            'color_as_key' => 'salmon',
        ])
        ->assertFormSet([
            'color' => 'badass',
            'color_as_key' => 'salmon',
        ])
        ->fillForm([
            'color' => 'salmon',
            'color_as_key' => 'badass',
        ])
        ->call('update')
        ->assertHasNoFormErrors()
        ->assertSet('data.color', 'salmon')
        ->assertSet('data.color_as_key', 'badass');

    expect($page->refresh())
        ->color->toBe(Palette::buildColor('salmon', '#fa8072', []))
        ->color_as_key->toBe('badass');
});
