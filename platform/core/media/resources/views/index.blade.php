@extends('core/base::layouts.master')

@push('header')
    {!! Media::renderHeader() !!}
@endpush

@section('content')
    {!! Media::renderContent() !!}
@endsection

@push('footer')
    {!! Media::renderFooter() !!}
@endpush
