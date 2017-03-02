@extends('layouts.app')

@section('content')
<div class="container well">
	<div class="row-fluid">
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Waarschuwing!</strong> {{Session::get('error')}}
            </div>
        @elseif(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('success')}}
            </div>
        @endif

        <div class="col-md-3 col-sm-6 text-center">
            <div class="span2" >
		      <img src="http://www.agoria.be/digitalworkplace/images/speakers/profile-200x200.png" class="img-circle">
            </div>
        </div>
        <div class="col-md-4 col-sm-6{{strpos(Request::path(), 'edit') != false ?' hidden':''}}" id="info">
            <h1>{{ $user->name }}</h1>
            <p><strong>Email: </strong> {{ $user->email }}</p>
            @if($user->mobile_number != null)
                <p><strong>Mobiel Nummer: </strong> 06-{{ substr($user->mobile_number, 2) }}</p>
            @endif
            @if($user->address != null)
                <p><strong>Adres: </strong> {{ $user->address }}</p>
            @endif
            @if($user == Auth::user())
                <a href="{{route('profile.edit', ['user' => $user->id])}}" type="button" class="btn btn-default btn-block">Wijzigen</a>
            @endif
        </div>
        <div class="col-md-4 col-sm-6{{strpos(Request::path(), 'edit') == false ?' hidden':''}}" id="edit">
            <form class="form-horizontal" action="{{ route('profile.update', ['user' => $user->id]) }}" method="POST">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Naam</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{$user->email}}" disabled>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                    <label for="mobile_number" class="col-sm-2 control-label">Mobiel Nummer</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" name="mobile_number" value="{{old('mobile_number') ? old('mobile_number') : $user->mobile_number}}">

                        @if ($errors->has('mobile_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-sm-2 control-label">Adres</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" value="{{old('address') ? old('address') : $user->address}}">

                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary">Opslaan</button>
                            <a href="{{route('profile.show', $user->id)}}" type="button" class="btn btn-danger">Annuleren</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-md-offset-1 col-sm-12 text-center">
            <div class="row">
                <div class="col-xs-4 emphasis">
                    <h2><strong> {{ $user->adtjes->count() }} </strong></h2>
                    <p><small>Adtje{{$user->adtjes->count() != 1 ? 's' : ''}}</small></p>
                </div>
                <div class="col-xs-4 emphasis">
                    <h2><strong> {{ $user->quotes->count() }} </strong></h2>
                    <p><small>Quote{{$user->quotes->count() != 1 ? 's' : ''}}</small></p>
                </div>
                <div class="col-xs-4 emphasis">
                    <h2><strong> {{ $user->allBuddies()->count() }} </strong></h2>
                    <p><small>Budd{{$user->allBuddies()->count() != 1 ? 'ies' : 'y'}}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    

</script>

@endsection
