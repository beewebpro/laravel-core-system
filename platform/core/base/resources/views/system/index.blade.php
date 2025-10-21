@extends('core/base::layouts.master')
@section('content')
    <div class="checkout-tabs">
        @props(['id'])
        {{ PanelSectionManager::group('system') }}
    </div>
@endsection
