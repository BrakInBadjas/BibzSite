@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has('adtje_validation'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>{{Session::get('adtje_validation')}}</p>
        </div>
    @endif

    <div class="jumbotron">
        <h1 class="display-3">Adtje voor <a href="{{ route('profile.show', ['id' => $adtje->user->id]) }}">{{ $adtje->user->name }}</a></h1>
        <span>Uitgedeeld op {{ $adtje->created_at->toFormattedDateString() }} door
            <a href="{{ route('profile.show', ['id' => $adtje->creator->id]) }}">{{ $adtje->creator->name }}</a>
        </span>
        <hr>
        <div id="show">
            <p class="lead">{{ $adtje->reason }}</p>
        </div>
    </div>
    <div class="row">
        <div id="buttons">
            <div class="col-md-6">
                <a class="btn btn-lg btn-primary btn-block" href="#" onclick="edit()" role="button">Wijzigen</a>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteAdtjeModal">
                    Verwijderen
                </button>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Stemmen</h1>
                </div>
                <table class="table">
                    @if($adtje->validations->count() > 0)
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
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr class="active">
                        <td>
                            Stem:
                        </td>
                        <td>
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <button type="button" class="btn btn-danger" id="button-deny"><i class="fa fa-times" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-default" id="button-null"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-success" id="button-approve"><i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div id="hidden" style="display: none">
        <form class="form-inline" id="remove-form" action="{{ route('adtjes.destroy', ['adtje' => $adtje->id]) }}" method="POST">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
        </form>
        @if($user_validation)
            <form id="post-validation" action="{{route('adtjes.validation.update', ['adtje' => $adtje->id, 'validation' => $user_validation->id]) }}" method="POST">
                {{ csrf_field() }}
                <input id="validation_status" name="status" value="null" type="hidden">
                <input name="_method" type="hidden" value="PUT">
            </form>
        @else
            <form id="post-validation" action="{{route('adtjes.validation.store', ['adtje' => $adtje->id]) }}" method="POST">
                {{ csrf_field() }}
                <input id="validation_status" name="status" value="null" type="hidden">
            </form>
        @endif
        <div id="show">
            <p class="lead">{{ $adtje->reason }}</p>
        </div>
        <div id="edit">
            <form id="edit-form" action="{{ route('adtjes.update', ['adtje' => $adtje->id]) }}" method="POST">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <textarea class="form-control" rows="3" name="reason" >{{ $adtje->reason }}</textarea>
            </form>
        </div>

        <div id="buttons">
            <div class="col-md-6">
                <a class="btn btn-lg btn-primary btn-block" href="#" onclick="edit()" role="button">Wijzigen</a>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-target="#deleteAdtjeModal">
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
            <button type="button" class="btn btn-danger" onclick="deleteModel()">Verwijderen</button>
          </div>
        </div>
      </div>
    </div>


</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/edit.js') }}" type="text/JavaScript"></script>
    <script src="{{ asset('js/adtjes.js') }}" type="text/JavaScript"></script>
    <script type="text/JavaScript">
        @if ((strpos(Request::path(), 'edit') !== false))
            $(function() {
                edit();
            });
        @endif

        var adtje_id = {{$adtje->id}};
    </script>
@endsection
