<?php

declare(strict_types=1);

use Awcodes\Focus\Card;
use Awcodes\Focus\Enums\Size;
use Awcodes\Focus\Screenshot;
use Awcodes\Focus\ScreenshotSuite;
use Playwright\Page\PageInterface;

/*
 * Documentation screenshots for Palette, generated with awcodes/focus from the Workbench (run `composer build`
 * first). The Workbench seeds one page with a fixed colour in every field, and the sizes page fills its fields with
 * fixed keys, so the same swatches are selected on every build.
 */

// The select's dropdown is positioned outside the field, so it is not part of the field's box. Once it is open, the
// field is given bottom padding of the dropdown's height, so the focus frame takes in the whole list.
$includeDropdown = function (PageInterface $page): void {
    $page->evaluate(<<<'JS'
        () => {
            const field = document.querySelector('[data-focus="color-picker-select"]');
            const dropdown = field.querySelector('[role="listbox"]');

            field.style.paddingBottom = `${dropdown.getBoundingClientRect().height + 8}px`;
        }
        JS);
};

return ScreenshotSuite::make()
    ->screenshots([
        Screenshot::make('color-picker')
            ->visit('/admin/pages/1/edit')
            ->focus('[data-focus="color-picker"]')
            ->padding(16),

        // The dropdown stays open while the select keeps focus, so the interaction state is kept.
        Screenshot::make('color-picker-select')
            ->visit('/admin/pages/1/edit')
            ->click('[data-focus="color-picker-select"] [aria-controls]')
            ->waitFor('[data-focus="color-picker-select"] [role="listbox"]')
            ->ready($includeDropdown)
            ->keepInteractionState()
            ->focus('[data-focus="color-picker-select"]')
            ->padding(16),

        Screenshot::make('color-entries')
            ->visit('/admin/pages/1')
            ->focus('[data-focus="color-entries"]')
            ->padding(16),

        Screenshot::make('sizes')
            ->visit('/admin/palette-sizes')
            ->focus('[data-focus="sizes"]')
            ->padding(16),

        // The share-image source, at the card templates' 1400x816 screenshot size. The two-up templates show it
        // dark in slot 1 and light in slot 2, so it is captured in both themes.
        Screenshot::make('card-sizes')
            ->viewportSize(1400, 816)
            ->visit('/admin/palette-sizes')
            ->viewport(),
    ])
    ->cardTemplates('https://github.com/awcodes/focus-templates/tree/v2.1.0/dist')
    ->cards([
        // Open Graph and the GitHub social preview share one 2400x1260 template; GitHub crops 30px top and bottom.
        Card::make('social')
            ->template('two-up-wide')
            ->title('Palette')
            ->screenshots(['card-sizes', 'card-sizes'])
            ->sizes([Size::OpenGraph, Size::GitHubSocial]),

        // The Filament plugin directory's 2560x1440 thumbnail.
        Card::make('thumbnail')
            ->template('two-up')
            ->title('Palette')
            ->screenshots(['card-sizes', 'card-sizes'])
            ->sizes([Size::Filament]),

        // Unbranded 16:9 image for aw.codes, which adds its own heading: the same screenshots, no text or logo.
        Card::make('plain')
            ->template('two-up-plain')
            ->screenshots(['card-sizes', 'card-sizes'])
            ->sizes([[2560, 1440]])
            ->scale(1),
    ]);
