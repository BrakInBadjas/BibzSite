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
            <button type="button" id="delete-active" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteBuddyModal">
                Buddyschap verbreken
            </button>
        </div>
    @endif
    <form class="form-inline" id="remove-buddy-form" action="{{ route('buddies.destroy', ['$buddy' => $buddy->id]) }}" method="POST" style="display: none">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
    </form>

    <!-- Popup -->
    <div class="modal fade" id="deleteBuddyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Buddyschap verbreken</h4>
          </div>
          <div class="modal-body">
            <p>Weet je zeker dat je dit wilt doen?</p>
            <p>Dit kan niet ongedaan gemaakt worden</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                    document.getElementById('remove-buddy-form').submit();">Verbreken</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
