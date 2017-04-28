@extends('layouts.app')

@section('styles')
<style>
* {
  color: #E3E5E9;
}
</style>
@endsection

@section('content')
  <div>
    <h1>Instructions</h1>
  <b>Welcome to the dream journal!</b>  This web application is a public, anonymous dream journal that lets you post your dreams, view others' dreams, and share and vote on the most interesting ones.
  <p>If you like an entry, you can upvote it, and it will move closer to the top. Similarly, if you thought an entry was boring, you can downvote it, and it will move closer to the bottom.</p>
  <p>To get started, you can <a href="http://localhost:8888/add">add a new dream</a>. If you'd like, you can also <a href="https://audreysharp.gitbooks.io/dream-journal/content/">view the API documentation</a> for this application.</p>
  </div>
@endsection