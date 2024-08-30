<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }}
        }"
        {{
            $attributes
              ->merge($getExtraAttributes())
              ->class(['palette-color-picker flex items-center flex-wrap gap-3'])
        }}
    >
        @foreach($getColors() as $key => $color)
            <label
                x-data
                x-tooltip="{
                    content: '{{ $color['label'] }}',
                    theme: $store.theme,
                }"
                @class([
                    'palette-color-picker-item rounded-full cursor-pointer ring-2
                    ring-gray-950/10 dark:ring-white/10
                    focus-within:outline focus-within:outline-white focus-within:outline-2',
                    match($getSize()) {
                        'xs' => 'size-4',
                        'sm' => 'size-6',
                        'lg' => 'size-10',
                        'xl' => 'size-12',
                        default => 'size-8',
                    },
                ])
                x-bind:class="{
                    'palette-color-picker-item-active !ring-primary-500 ring-offset-2 ring-offset-white dark:ring-offset-black': state === '{{ $key }}'
                }"
            >
                <div
                    {{
                        \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                            ->class([
                                'rounded-full h-full w-full',
                                $color['value'] => $color['type'] === 'class',
                            ])
                    }}
                    @if ($color['type'] !== 'class')
                        style="background-color: {{ $color['type'] === 'rgb' ? 'rgba(' . $color['value'] . ', 1)' : $color['value'] }};"
                    @endif
                >
                    <input
                        type="radio"
                        x-model="state"
                        value="{{ $key }}"
                        class="opacity-0 pointer-events-none"
                    />
                    <span class="sr-only">{{ $color['label'] }}</span>
                </div>
            </label>
        @endforeach
    </div>
</x-dynamic-component>
