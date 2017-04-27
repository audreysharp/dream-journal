@extends('layouts.app')

@section('content')
    <div id="app">
        <app-view :entry-id="{{ $id }}" :is-just-created="{{ $justCreated }}" ></app-view>
    </div>
@endsection