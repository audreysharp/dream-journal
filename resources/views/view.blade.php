@extends('layouts.app')

@section('content')
    <div id="app">
        <app-view :entry-id="{{ $id }}" ></app-view>
    </div>
@endsection