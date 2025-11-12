@extends('core/base::layouts.master')

@section('content')
    <media :folders='@json($folders)' />
@stop
