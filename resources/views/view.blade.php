@extends('layouts.app')

@section('content')
    <!-- Tell Vue component the entry ID and if the entry is newly created or was just updated -->
    <div id="app">
        <app-view :entry-id="{{ $id }}" :is-just-created="{{ $justCreated }}" :was-just-updated="{{ $justUpdated }}" ></app-view>
    </div>
@endsection