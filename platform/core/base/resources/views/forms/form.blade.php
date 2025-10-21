@extends('core/base::layouts.master')
@section('content')
    @if ($showStart)
        {!! Form::open(Arr::except($formOptions, ['template'])) !!}
    @endif

    <div class="row">
        <div class="gap-3 col-md-9">
            @if ($showFields && $form->hasMainFields())
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="{{ $form->getWrapperClass() }}">
                            {{ $form->getOpenWrapperFormColumns() }}

                            @foreach ($fields as $key => $field)
                                @if ($field->getName() == $form->getBreakFieldPoint())
                                @break

                            @else
                                @unset($fields[$key])
                            @endif

                            @continue(in_array($field->getName(), $exclude))

                            {!! $field->render() !!}
                            @if (defined('BASE_FILTER_SLUG_AREA') && $field->getName() == SlugHelper::getColumnNameToGenerateSlug($form->getModel()))
                                {!! apply_filters(BASE_FILTER_SLUG_AREA, null, $form->getModel()) !!}
                            @endif
                        @endforeach

                        {{ $form->getCloseWrapperFormColumns() }}
                    </div>
                </div>
            </div>
        @endif

        @foreach ($form->getMetaBoxes() as $key => $metaBox)
            {!! $form->getMetaBox($key) !!}
        @endforeach
    </div>

    <div class="col-md-3 d-flex flex-column-reverse flex-md-column">
        {!! $form->getActionButtons() !!}

        @foreach ($fields as $field)
            @if (!in_array($field->getName(), $exclude))
                @if (in_array($field->getType(), ['hidden', \Botble\Base\Forms\Fields\HiddenField::class]))
                    {!! $field->render() !!}
                @else
                    <div class="card meta-boxes">
                        <div class="card-header bg-transparent border-bottom text-uppercase">
                            <div class="card-title">
                                {!! $field->getOption('label') !!}
                            </div>
                        </div>

                        @php
                            $bodyAttrs = Arr::get($field->getOptions(), 'card-body-attrs', []);

                            if (!Arr::has($bodyAttrs, 'class')) {
                                $bodyAttrs['class'] = '';
                            }

                            $bodyAttrs['class'] .= ' card-body';
                        @endphp

                        <div {!! Html::attributes($bodyAttrs) !!}>
                            {!! $field->render([], in_array($field->getType(), ['radio', 'checkbox'])) !!}
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

    </div>
</div>

@if ($showEnd)
    {!! Form::close() !!}
@endif

@endsection
