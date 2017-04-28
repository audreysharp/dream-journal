@extends('layouts.app')

@section('content')
    <div id="app">
        <!-- Tell Vue component the entry ID if the entry is being updated -->
        <app-add :update-entry-id="{{ $id }}"></app-add>
    </div>
@endsection