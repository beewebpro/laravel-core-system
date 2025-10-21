@extends('core/base::layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($table->hasFilters())
                        <div class="mb-3 table-configuration-wrap" @style(['display: none' => !$table->isFiltering(), 'display: block' => $table->isFiltering()])>
                            <div>
                                <button type="button" class="btn-show-table-options rounded-pill">x</button>
                                {!! $table->renderFilter() !!}
                            </div>
                        </div>
                    @endif
                    <div class="w-100 gap-2 d-flex align-items-start justify-content-between flex-wrap mb-3">
                        <div class="d-flex gap-2">
                            @if ($table->hasFilters())
                                <button type="button"
                                    class="btn btn-outline-secondary waves-effect waves-light btn-show-table-options">
                                    {{ trans('core/table::table.filters') }}
                                </button>
                            @endif
                            <div class="table-search-input">
                                <label>
                                    <input type="search" class="form-control input-sm"
                                        placeholder="{{ trans('core/table::table.search') }}" style="min-width: 120px">
                                    <button type="button" title="{{ trans('core/table::table.search') }}"
                                        class="search-icon"><i class="bx bx-search fs-3"></i></button>
                                    <button type="button" title="{{ trans('core/table::table.clear') }}"
                                        class="search-reset-icon"><i class="bx bx-x fs-3"></i></button>
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            @foreach ($table->getButtons() as $button)
                                @if (Arr::get($button, 'extend') === 'collection')
                                    <div class="dropdown">
                                        <button class="btn buttons-collection dropdown-toggle {{ $button['className'] }}"
                                            data-bs-toggle="dropdown" tabindex="0"
                                            aria-controls="{{ $table->getOption('id') }}" type="button"
                                            aria-haspopup="dialog" aria-expanded="false">
                                            {!! $button['text'] !!}
                                        </button>
                                        <div class="dropdown-menu">
                                            @foreach ($button['buttons'] as $buttonItem)
                                                <button class="dropdown-item {{ $buttonItem['className'] }}">
                                                    {!! $buttonItem['text'] !!}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <button class="btn {{ $button['className'] }} waves-effect waves-light" tabindex="0"
                                        aria-controls="{{ $table->getOption('id') }}" type="button" aria-haspopup="dialog"
                                        aria-expanded="false">
                                        {!! $button['text'] !!}
                                    </button>
                                @endif
                            @endforeach

                            @foreach ($table->getDefaultButtons() as $defaultButton)
                                @if (is_string($defaultButton))
                                    @switch($defaultButton)
                                        @case('reload')
                                            <button type="button" class="btn btn-outline-secondary waves-effect waves-light"
                                                data-bb-toggle="dt-buttons" data-bb-target=".buttons-reload" tabindex="0"
                                                aria-controls="{{ $table->getOption('id') }}">
                                                <i class="bx bx-revision font-size-16 align-middle me-2"></i>
                                                {{ trans('core/base::tables.reload') }}
                                            </button>
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="table-rep-plugin">
                        {!! $dataTable->table(compact('id', 'class'), false) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ URL::asset('vendor/core/core/base/libs/datatables/datatables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('vendor/core/core/table/css/table.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('head-js')
    <script src="{{ URL::asset('vendor/core/core/base/libs/bootstrap3-typeahead.min.js') }}"></script>
@endsection

@section('script')
    <script src="{{ URL::asset('vendor/core/core/base/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/core/core/table/js/table.js') }}"></script>
    <script src="{{ URL::asset('vendor/core/core/table/js/filter.js') }}"></script>
@endsection

@push('footer')
    @include('core/table::modal')
    {!! $dataTable->scripts() !!}
@endpush
