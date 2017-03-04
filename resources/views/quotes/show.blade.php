@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron">
        <h1 class="display-3">Quote van <a href="{{route('profile.show', ['id' => $quote->user->id])}}">{{ $quote->user->name }}</a></h1>
        <span>Gezegd op {{ $quote->created_at->toFormattedDateString() }}</span>
        <hr>
        <p class="lead" id="quote-active">{{ $quote->quote }}</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-lg btn-primary btn-block" id="edit-active" href="#" onclick="editQuote(true)" role="button">Wijzigen</a>
        </div>
        <div class="col-md-6">
            <button type="button" id="delete-active" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteQuoteModal">
                Verwijderen
            </button>
        </div>
    </div>
    <div id="hidden" style="display: none">
        <form class="form-inline" id="remove-quote-form" action="{{ route('quotes.destroy', ['$quote' => $quote->id]) }}" method="POST">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
        </form>

        <form id="edit-quote-form" action="{{ route('quotes.update', ['quote' => $quote->id]) }}" method="POST">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <textarea class="form-control" rows="3" name="quote" >{{ $quote->quote }}</textarea>
        </form>

        <a class="btn btn-lg btn-primary btn-block" id="save" href="#" onclick="saveQuote()" role="button">Wijzigingen Oplsaan</a>

        <a class="btn btn-lg btn-default btn-block" id="cancel" href="#" onclick="cancelEdit()" role="button">Annuleren</a>

        <button type="button" id="delete" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteQuoteModal">
            Verwijderen
        </button>

        <a class="btn btn-lg btn-primary btn-block" id="edit" href="#" onclick="editQuote(true)" role="button">Wijzigen</a>

        <p class="lead" id="quote">{{ $quote->quote }}</p>
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

<script type="text/JavaScript">
    function editQuote(prevent) {
        if (prevent) {
            event.preventDefault();
        }

        var quoteField = document.getElementById("quote-active");
        var editForm = document.getElementById("edit-quote-form").cloneNode(true);
        editForm.id = "edit-quote-form-active";
        quoteField.parentNode.replaceChild(editForm, quoteField);

        var editButton = document.getElementById("edit-active");
        var saveButton = document.getElementById("save").cloneNode(true);
        saveButton.id = "save-active";
        editButton.parentNode.replaceChild(saveButton, editButton);

        var deleteButton = document.getElementById("delete-active");
        var cancelButton = document.getElementById("cancel").cloneNode(true);
        cancelButton.id = "cancel-active";
        deleteButton.parentNode.replaceChild(cancelButton, deleteButton);
    }

    function saveQuote() {
        event.preventDefault();
        document.getElementById('edit-quote-form-active').submit();
    }

    function cancelEdit() {
        event.preventDefault();

        var editForm = document.getElementById("edit-quote-form-active");
        var quoteField = document.getElementById("quote").cloneNode(true);
        quoteField.id = "quote-active";
        editForm.parentNode.replaceChild(quoteField, editForm);

        var saveButton = document.getElementById("save-active");
        var editButton = document.getElementById("edit").cloneNode(true);
        editButton.id = "edit-active";
        saveButton.parentNode.replaceChild(editButton, saveButton);

        var cancelButton = document.getElementById("cancel-active");
        var deleteButton = document.getElementById("delete").cloneNode(true);
        deleteButton.id = "delete-active";
        cancelButton.parentNode.replaceChild(deleteButton, cancelButton);
    }

    function deleteQuote() {
        event.preventDefault();
        document.getElementById('remove-quote-form').submit();
    }

    @if ((strpos(Request::path(), 'edit') !== false))
        editQuote(false);
    @endif
</script>
@endsection
