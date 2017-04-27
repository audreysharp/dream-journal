@extends('layouts.app')

@section('content')
    <div id="app">
        <app-view :entry-id="{{ $id }}" :is-newly-created="{{ $newlyCreated }}" ></app-view>
    </div>
@endsection