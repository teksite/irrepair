@extends('form::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('form.name') !!}</p>
@endsection
