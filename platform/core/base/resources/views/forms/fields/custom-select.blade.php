<div class="form-field">
    @if ($showLabel && $options['label'] !== false && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    {!! Form::select(
        $name,
        ($options['empty_value'] ? ['' => $options['empty_value']] : []) + $options['choices'],
        $options['selected'] !== null ? $options['selected'] : $options['default_value'],
        $options['attr'],
        array_merge($options['attr'], ['class' => 'form-select']),
        Arr::get($options, 'optionAttrs', []),
        Arr::get($options, 'optgroupsAttributes', []),
    ) !!}
</div>
