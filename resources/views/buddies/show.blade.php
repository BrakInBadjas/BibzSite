@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1><a href="{{ route('profile.show', [$buddy->buddy->id]) }}">{{ $buddy->buddy->name }}</a> buddy van <a href="{{ route('profile.show', [$buddy->user->id]) }}">{{ $buddy->user->name }}</a></h1>
        <span>Sinds {{ $buddy->created_at->toFormattedDateString() }}</span>
        @if($buddy->broken())
            <br /><span>Tot {{ $buddy->deleted_at->toFormattedDateString() }}</span>
        @endif
        <hr>
        <p class="lead">{{ $buddy->relation }}</p>
    </div>
    @if(! $buddy->broken())
    <div class="row">
        <a class="btn btn-lg btn-danger btn-block" href="#"
            role="button" onclick="event.preventDefault();
                    document.getElementById('remove-buddy-form').submit();">Verbreek Buddyschap</a>
    </div>
    @endif
    <form class="form-inline" id="remove-buddy-form" action="{{ route('buddies.destroy', ['$buddy' => $buddy->id]) }}" method="POST" style="display: none">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
    </form>
</div>
@endsection
