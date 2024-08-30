<?php

use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Awcodes\Palette\Tests\Fixtures\TestForm;
use Awcodes\Palette\Tests\Fixtures\TestSelectComponent;
use Filament\Forms\ComponentContainer;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

use function Pest\Livewire\livewire;

it('has default colors', function () {
    $field = (new ColorPickerSelect('color'))
        ->container(ComponentContainer::make(TestForm::make()));

    expect($field)
        ->getColors()->toHaveKeys(array_keys(FilamentColor::getColors()));
});

it('supports custom colors', function () {
    $field = (new ColorPickerSelect('color'))
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

it('adds white and black', function () {
    $field = (new ColorPickerSelect('color'))
        ->container(ComponentContainer::make(TestForm::make()))
        ->withBlack()
        ->withWhite();

    expect($field)
        ->getColors()->toHaveKeys(['white', 'black']);
});

it('swaps white and black', function () {
    $field = (new ColorPickerSelect('color'))
        ->container(ComponentContainer::make(TestForm::make()))
        ->withBlack(swap: '#ef4444')
        ->withWhite(swap: '#22c55e');

    $colors = $field->getColors();

    expect($colors)
        ->toHaveKeys(['black', 'white'])
        ->and($colors['black']['value'])->toBe('#ef4444')
        ->and($colors['white']['value'])->toBe('#22c55e');
});

it('can save correct data', function () {
    livewire(TestSelectComponent::class)
        ->fillForm([
            'color' => 'badass',
        ])
        ->assertFormSet([
            'color' => 'badass',
        ])
        ->call('save')
        ->assertHasNoFormErrors()
        ->assertSet('data.color', 'badass');
});

it('can update correct data', function () {
    livewire(TestSelectComponent::class)
        ->fillForm([
            'color' => 'badass',
        ])
        ->assertFormSet([
            'color' => 'badass',
        ])
        ->fillForm([
            'color' => 'primary',
        ])
        ->call('save')
        ->assertHasNoFormErrors()
        ->assertSet('data.color', 'primary');
});
