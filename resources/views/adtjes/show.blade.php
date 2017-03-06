@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron">
        <h1 class="display-3">Adtje voor <a href="{{ route('profile.show', ['id' => $adtje->user->id]) }}">{{ $adtje->user->name }}</a></h1>
        <span>Uitgedeeld op {{ $adtje->created_at->toFormattedDateString() }} door
            <a href="{{ route('profile.show', ['id' => $adtje->creator->id]) }}">{{ $adtje->creator->name }}</a>
        </span>
        <hr>
        <p class="lead" id="reason-active">{{ $adtje->reason }}</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-lg btn-primary btn-block" id="edit-active" href="#" onclick="editAdtje(true)" role="button">Wijzigen</a>
        </div>
        <div class="col-md-6">
            <button type="button" id="delete-active" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteAdtjeModal">
                Verwijderen
            </button>
        </div>
    </div>
    <div class="row">
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

            <button type="button" id="delete" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteAdtjeModal">
                Verwijderen
            </button>

            <a class="btn btn-lg btn-primary btn-block" id="edit" href="#" onclick="editAdtje(true)" role="button">Wijzigen</a>

            <p class="lead" id="reason">{{ $adtje->reason }}</p>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Keuringen</h1>
                </div>
                @if($adtje->validations->count() > 0)
                    <table class="table">
                        <tr>
                            <th>Door</th>
                            <th>Status</th>    
                        </tr>
                        @foreach($adtje->validations as $validation)
                            <tr>
                                <td>
                                    {{$validation->validator->name}}
                                </td>
                                <td>
                                    
                                    @if($validation->status == AdtjeValidation::APPROVE)
                                        <button type="button" class="btn btn-xs btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                                    @elseif($validation->status == AdtjeValidation::DENY)
                                        <button type="button" class="btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    @else
                                        <button type="button" class="btn btn-xs btn-default"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    @endif

                                    @if($validation->validator == Auth::user())
                                        <div class="btn-group btn-group-xs pull-right" role="group" aria-label="...">
                                            <button type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Popup -->
    <div class="modal fade" id="deleteAdtjeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Adtje verwijderen</h4>
          </div>
          <div class="modal-body">
            <p>Weet je zeker dat je dit wilt doen?</p>
            <p>Dit kan niet ongedaan gemaakt worden</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            <button type="button" class="btn btn-danger" onclick="deleteAdtje()">Verwijderen</button>
          </div>
        </div>
      </div>
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
        document.getElementById('remove-adtje-form').submit();
    }

    @if ((strpos(Request::path(), 'edit') !== false))
        editAdtje(false);
    @endif
</script>
@endsection
