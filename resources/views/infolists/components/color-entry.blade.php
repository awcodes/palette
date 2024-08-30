<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    @php
        $color = $getState();
    @endphp
    <div
        x-data
        x-tooltip="{
            content: '{{ $color['label'] }}',
            theme: $store.theme,
        }"
        @class([
            'palette-entry-item rounded-full ring-2
            ring-gray-950/10 dark:ring-white/10',
            match($getSize()) {
                'xs' => 'size-4',
                'sm' => 'size-6',
                'lg' => 'size-10',
                'xl' => 'size-12',
                default => 'size-8',
            },
        ])
    >
        <div
            {{
                \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                    ->class([
                        'rounded-full h-full w-full',
                        $color['value'] => $color['type'] === 'class',
                    ])
            }}
            @if ($color['type'] !== 'class')
                style="background-color: {{ $color['type'] === 'rgb' ? 'rgba(' . $color['value'] . ', 1)' : $color['value'] }};"
            @endif
        >
            <span class="sr-only">{{ $color['label'] }}</span>
        </div>
    </div>
</x-dynamic-component>
