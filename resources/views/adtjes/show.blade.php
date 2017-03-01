@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron">
        <h1 class="display-3">Adtje voor {{ $adtje->user->name }}</h1>
        <span>Uitgedeeld op {{ $adtje->created_at->toFormattedDateString() }} door
            <a href="{{ route('adtjes.index') }}">{{ $adtje->creator->name }}</a>
        </span>
        <hr>
        <p class="lead" id="reason-active">{{ $adtje->reason }}</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-lg btn-primary btn-block" id="edit-active" href="#" onclick="editAdtje(true)" role="button">Wijzigen</a>
        </div>
        <div class="col-md-6">
            <a class="btn btn-lg btn-danger btn-block" id="delete-active" href="#"
                role="button" onclick="deleteAdtje()">Verwijderen</a>
        </div>
    </div>
    <div id="hidden" style="display: none">
        <form class="form-inline" id="remove-adtje-form" action="{{ route('adtjes.destroy', ['adtje' => $adtje->id]) }}" method="POST">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
        </form>

        <form id="edit-adtje-form" action="{{ route('adtjes.update', ['adtje' => $adtje->id]) }}" method="POST">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <textarea class="form-control" rows="3" name="reason" >{{ $adtje->reason }}</textarea>
        </form>

        <a class="btn btn-lg btn-primary btn-block" id="save" href="#" onclick="saveAdtje()" role="button">Wijzigingen Oplsaan</a>

        <a class="btn btn-lg btn-default btn-block" id="cancel" href="#" onclick="cancelEdit()" role="button">Annuleren</a>

        <a class="btn btn-lg btn-danger btn-block" id="delete" href="#"
            role="button" onclick="deleteAdtje()">Verwijderen</a>

        <a class="btn btn-lg btn-primary btn-block" id="edit" href="#" onclick="editAdtje(true)" role="button">Wijzigen</a>

        <p class="lead" id="reason">{{ $adtje->reason }}</p>
    </div>


</div>

<script type="text/JavaScript">
    function editAdtje(prevent) {
        if (prevent) {
            event.preventDefault();
        }

        var reasonField = document.getElementById("reason-active");
        var editForm = document.getElementById("edit-adtje-form").cloneNode(true);
        editForm.id = "edit-adtje-form-active";
        reasonField.parentNode.replaceChild(editForm, reasonField);

        var editButton = document.getElementById("edit-active");
        var saveButton = document.getElementById("save").cloneNode(true);
        saveButton.id = "save-active";
        editButton.parentNode.replaceChild(saveButton, editButton);

        var deleteButton = document.getElementById("delete-active");
        var cancelButton = document.getElementById("cancel").cloneNode(true);
        cancelButton.id = "cancel-active";
        deleteButton.parentNode.replaceChild(cancelButton, deleteButton);
    }

    function saveAdtje() {
        event.preventDefault();
        document.getElementById('edit-adtje-form-active').submit();
    }

    function cancelEdit() {
        event.preventDefault();

        var editForm = document.getElementById("edit-adtje-form-active");
        var reasonField = document.getElementById("reason").cloneNode(true);
        reasonField.id = "reason-active";
        editForm.parentNode.replaceChild(reasonField, editForm);

        var saveButton = document.getElementById("save-active");
        var editButton = document.getElementById("edit").cloneNode(true);
        editButton.id = "edit-active";
        saveButton.parentNode.replaceChild(editButton, saveButton);

        var cancelButton = document.getElementById("cancel-active");
        var deleteButton = document.getElementById("delete").cloneNode(true);
        deleteButton.id = "delete-active";
        cancelButton.parentNode.replaceChild(deleteButton, cancelButton);
    }

    function deleteAdtje() {
        event.preventDefault();
        document.getElementById('remove-adtje-form').submit();
    }

    @if ((strpos(Request::path(), 'edit') !== false))
        editAdtje(false);
    @endif
</script>
@endsection
