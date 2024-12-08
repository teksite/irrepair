@extends('announcement::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('announcement.name') !!}</p>
@endsection
