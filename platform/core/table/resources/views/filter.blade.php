<div class="wrapper-filter">
    <p>{{ trans('core/table::table.filters') }}</p>
    <input type="hidden" class="filter-data-url"
        value="{{ isset($table) ? $table->getFilterInputUrl() : route('table.filter.input') }}" />

    <div class="sample-filter-item-wrap hidden">
        <div class="row filter-item form-filter">
            <div class="col-auto">
                <select name="filter_columns[]" class="form-select filter-column-key">
                    @foreach (array_combine(array_keys($columns), array_column($columns, 'title')) as $key => $title)
                        <option value="{{ $key }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <select name="filter_operators[]" class="form-select filter-operator filter-column-operator">
                    <option value="like">{{ trans('core/table::table.contains') }}</option>
                    <option value="=">{{ trans('core/table::table.is_equal_to') }}</option>
                    <option value=">">{{ trans('core/table::table.greater_than') }}</option>
                    <option value="<">{{ trans('core/table::table.less_than') }}</option>
                </select>
            </div>

            <div class="col-auto w-25">
                <span class="filter-column-value-wrap">
                    <input class="form-control filter-column-value" type="text"
                        placeholder="{{ trans('core/table::table.value') }}" name="filter_values[]">
                </span>
            </div>

            <div class="col">
                <button type="button" class="btn btn-outline-danger btn-remove-filter-item mb-3"
                    title="{{ trans('core/table::table.delete') }}">
                    <i class="bx bx-trash font-size-16 align-middle"></i>
                </button>
            </div>
        </div>
    </div>

    <form class="filter-form" method="get">
        <input type="hidden" name="filter_table_id" class="filter-data-table-id" value="{{ $tableId }}">
        <input type="hidden" name="class" class="filter-data-class" value="{{ $class }}">
        <div class="filter_list inline-block filter-items-wrap">
            @foreach ($requestFilters as $filterItem)
                <div class="row filter-item form-filter {{ $loop->first ? 'filter-item-default' : '' }}">
                    <div class="col-auto">
                        <select name="filter_columns[]" class="form-select filter-column-key">
                            <option value="">{{ trans('core/table::table.select_field') }}</option>
                            @foreach (array_combine(array_keys($columns), array_column($columns, 'title')) as $key => $title)
                                <option value="{{ $key }}"
                                    {{ $filterItem['column'] == $key ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto">
                        <select name="filter_operators[]" class="form-select filter-operator filter-column-operator">
                            <option value="like" {{ $filterItem['operator'] == 'like' ? 'selected' : '' }}>
                                {{ trans('core/table::table.contains') }}
                            </option>
                            <option value="=" {{ $filterItem['operator'] == '=' ? 'selected' : '' }}>
                                {{ trans('core/table::table.is_equal_to') }}
                            </option>
                            <option value=">" {{ $filterItem['operator'] == '>' ? 'selected' : '' }}>
                                {{ trans('core/table::table.greater_than') }}
                            </option>
                            <option value="<" {{ $filterItem['operator'] == '<' ? 'selected' : '' }}>
                                {{ trans('core/table::table.less_than') }}
                            </option>
                        </select>
                    </div>

                    <div class="col-auto w-25">
                        <div class="filter-column-value-wrap mb-3">
                            <input class="form-control filter-column-value" type="text"
                                placeholder="{{ trans('core/table::table.value') }}" name="filter_values[]"
                                value="{{ $filterItem['value'] }}">
                        </div>
                    </div>

                    <div class="col">
                        @if (!$loop->first)
                            <button type="button" class="btn btn-outline-danger btn-remove-filter-item mb-3"
                                title="{{ trans('core/table::table.delete') }}">
                                <i class="bx bx-trash font-size-16 align-middle"></i>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn-list">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-light add-more-filter">
                {{ trans('core/table::table.add_additional_filter') }}
            </button>
            <button type="submit" class="btn-apply btn btn-info">
                {{ trans('core/table::table.apply') }}
            </button>
            <a href="{{ URL::current() }}" data-bb-toggle="datatable-reset-filter"
                class="btn btn-outline-secondary waves-effect waves-light"
                style="{{ !request()->has('filter_table_id') ? 'display: none;' : '' }}">
                <i class="bx bx-revision font-size-16 align-middle text-danger"></i>
            </a>
        </div>
    </form>
</div>
