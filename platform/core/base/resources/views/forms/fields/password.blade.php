<div class="form-field mb-3">
    <!-- Label -->
    <label for="{{ $name }}" class="{{ $options['label_attr']['class'] ?? '' }}" {!! isset($options['label_attr'])
        ? collect($options['label_attr'])->except(['class'])->map(fn($value, $key) => $key . '="' . $value . '"')->join(' ')
        : '' !!}>
        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! $options['label'] !!}
        @endif
    </label>

    <input type="password" name="{{ $name }}" value="{{ $options['value'] }}" {!! Html::attributes($options['attr']) !!}>
</div>
