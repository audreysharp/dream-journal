@extends('layouts.app')

@section('content')
    <div id="app">
        <app-add :update-entry-id="{{ $id }}"></app-add>
    </div>
@endsection