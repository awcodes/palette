<span style="display: flex; gap: 0.5rem; align-items: center;">
    <span style="display: inline-block; border-radius: 100%; width: 1rem; height: 1rem; background-color: {{ $color['type'] === 'rgb' ? 'rgba(' . $color['value'] . ', 1)' : $color['value'] }};"></span>
    <span>{{ $color['label'] }}</span>
</span>
