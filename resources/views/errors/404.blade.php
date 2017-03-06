@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/error.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron center">
            <h1>Page Not Found <small class="red">404</small></h1>
            <hr>
            <p>The page you requested could not be found</p>
            <img src="https://media.giphy.com/media/d1E2c0eBSKs4ZJ3W/source.gif">
        </div>
    </div>
</div>
@endsection
