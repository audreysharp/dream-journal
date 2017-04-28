@extends('layouts.app')

@section('content')
    <!-- Tell Vue component if an entry was just deleted so it can show the success alert box -->
    <div id="app">
        <app-index :just-deleted="{{ $justDeleted }}"></app-index>
    </div>
@endsection