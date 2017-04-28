@extends('layouts.app')

@section('content')
    <div id="app">
        <app-view :entry-id="{{ $id }}" :is-just-created="{{ $justCreated }}" :was-just-updated="{{ $justUpdated }}" ></app-view>
    </div>
@endsection