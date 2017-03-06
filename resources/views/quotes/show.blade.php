@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron">
        <h1 class="display-3">Quote van <a href="{{route('profile.show', ['id' => $quote->user->id])}}">{{ $quote->user->name }}</a></h1>
        <span>Gezegd op {{ $quote->created_at->toFormattedDateString() }}</span>
        <hr>
        <div id="show">
            <p class="lead">{{ $quote->quote }}</p>
        </div>
    </div>
    <div class="row">
        <div id="buttons">
            <div class="col-md-6">
                <a class="btn btn-lg btn-primary btn-block" href="#" onclick="edit()" role="button">Wijzigen</a>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteQuoteModal">
                    Verwijderen
                </button>
            </div>
        </div>
    </div>
    <div id="hidden" style="display: none">
        <form class="form-inline" id="remove-form" action="{{ route('quotes.destroy', ['$quote' => $quote->id]) }}" method="POST">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
        </form>
        <div id="show">
            <p class="lead">{{ $quote->quote }}</p>
        </div>
        <div id="edit">
            <form id="edit-form" action="{{ route('quotes.update', ['quote' => $quote->id]) }}" method="POST">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <textarea class="form-control" rows="3" name="quote" >{{ $quote->quote }}</textarea>
            </form>
        </div>

        <div id="buttons">
            <div class="col-md-6">
                <a class="btn btn-lg btn-primary btn-block" href="#" onclick="edit()" role="button">Wijzigen</a>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteQuoteModal">
                    Verwijderen
                </button>
            </div>
        </div>

        <div id="buttons-in-edit">
            <div class="col-md-6">
                <a class="btn btn-lg btn-primary btn-block" href="#" onclick="save()" role="button">Wijzigingen Oplsaan</a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-lg btn-default btn-block" href="#" onclick="cancelEdit()" role="button">Annuleren</a>
            </div>
        </div>
    </div>

    <!-- Popup -->
    <div class="modal fade" id="deleteQuoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Quote verwijderen</h4>
          </div>
          <div class="modal-body">
            <p>Weet je zeker dat je dit wilt doen?</p>
            <p>Dit kan niet ongedaan gemaakt worden</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            <button type="button" class="btn btn-danger" onclick="deleteQuote()">Verwijderen</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/edit.js') }}" type="text/JavaScript"></script>
    <script type="text/JavaScript">
        @if ((strpos(Request::path(), 'edit') !== false))
            $(function() {
                edit();
            });
        @endif
    </script>
@endsection
