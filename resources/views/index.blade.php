@extends('layouts.app')

@section('content')
    <div id="app">
        <app-index :just-deleted="{{ $justDeleted }}"></app-index>
    </div>
@endsection