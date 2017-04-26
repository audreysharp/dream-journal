@extends('layouts.app')

@section('content')
    <div id="app">
        <IndexPage></IndexPage>
    </div>

    <!--<div id="container">
         <div id="app">
        <IndexPage></IndexPage>
    </div>
    </div>

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>-->
@endsection