@extends('core/base::layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-list">
                        <div class="table-search-input">
                            <label><input type="search" class="form-control input-sm"
                                    placeholder="{{ trans('core/table::table.search') }}"></label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            {!! $dataTable->table(compact('id', 'class'), false) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    {!! $dataTable->scripts() !!}
@endpush
