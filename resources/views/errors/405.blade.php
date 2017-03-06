@extends('layouts.app')

@section('css')
<link href="{{ asset('css/error.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron center">
            <h1>Niet toegestane methode <small class="red">405</small></h1>
            <hr>
            <p>De methode die je probeerde te gebruiken is niet toegestaan</p>
            <img src="https://media.giphy.com/media/yRHAZGHAIz6kE/source.gif">
        </div>
    </div>
</div>
@endsection
