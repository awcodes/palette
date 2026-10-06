<div class="palette-select-option flex gap-2 items-center">
    @if ($color['type'] === 'class')
        <span class="{{ $color['value'] }} size-4 rounded-full shrink-0 ring-1 ring-gray-950/10 dark:ring-white/20" style="line-height: 1; display: block; height: 1rem;"></span>
    @else
        <span class="size-4 rounded-full shrink-0 ring-1 ring-gray-950/10 dark:ring-white/20" style="background-color: {{ $color['type'] === 'rgb' ? 'rgba(' . $color['value'] . ', 1)' : $color['value'] }}; line-height: 1; display: block; height: 1rem;"></span>
    @endif
    <span style="line-height: 1; display: block; height: 1rem;">{{ $color['label'] }}</span>
</div>
