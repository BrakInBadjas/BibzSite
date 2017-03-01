@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>{{ $buddy->buddy->name }} buddy van {{ $buddy->user->name }}</h1>
        <span>Sinds {{ $buddy->created_at->toFormattedDateString() }}</span>
        <hr>
        <p class="lead">{{ $buddy->relation }}</p>
    </div>
    <div class="row">
        <a class="btn btn-lg btn-danger btn-block" href="#"
            role="button" onclick="event.preventDefault();
                    document.getElementById('remove-buddy-form').submit();">Verbreek Buddyschap</a>
    </div>
    <form class="form-inline" id="remove-buddy-form" action="{{ route('buddies.destroy', ['$buddy' => $buddy->id]) }}" method="POST" style="display: none">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
    </form>
</div>
@endsection
