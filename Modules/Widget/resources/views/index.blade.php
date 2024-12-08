@extends('widget::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('widget.name') !!}</p>
@endsection
