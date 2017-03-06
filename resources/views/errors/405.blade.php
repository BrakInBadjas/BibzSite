@extends('layouts.app')

@section('css')
<link href="{{ asset('css/error.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron center">
            <h1>Method not allowed <small class="red">405</small></h1>
            <hr>
            <p>The method you tried to use was not allowed</p>
            <img src="https://media.giphy.com/media/yRHAZGHAIz6kE/source.gif">
        </div>
    </div>
</div>
@endsection
