<div class="form-field">
    @if ($showLabel && $options['label'] !== false && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    {!! Form::uiSelector($name, Arr::get($options, 'selected'), $options['choices'], $options['attr']) !!}
</div>
