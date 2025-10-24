<div class="form-field mb-3">
    <label for="{{ $name }}" class="{{ $options['label_attr']['class'] ?? '' }}" {!! isset($options['label_attr'])
        ? collect($options['label_attr'])->except(['class'])->map(fn($value, $key) => $key . '="' . $value . '"')->join(' ')
        : '' !!}>
        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! $options['label'] !!}
        @endif
    </label>
    {!! Form::textarea($name, $options['value'], $options['attr']) !!}
</div>
