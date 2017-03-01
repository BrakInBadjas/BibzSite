@extends('layouts.app')

@section('content')
<div class="container well">
	<div class="row-fluid">
        <div class="col-md-3">
            <div class="span2" >
		    <img src="http://www.agoria.be/digitalworkplace/images/speakers/profile-200x200.png" class="img-circle">
        </div>
        </div>
        <div class="col-md-4">
            <h1>{{ $user->name }}</h1>
            <p><strong>Email: </strong> {{ $user->email }}</p>
        </div>
        <div class="col-md-4 col-md-offset-1 text-center">
            <div class="col-xs-4 col-sm-4 emphasis">
                <h2><strong> {{ $user->adtjes->count() }} </strong></h2>
                <p><small>Adtje{{$user->adtjes->count() != 1 ? 's' : ''}}</small></p>
            </div>
            <div class="col-xs-4 col-sm-4 emphasis">
                <h2><strong> {{ $user->quotes->count() }} </strong></h2>
                <p><small>Quote{{$user->quotes->count() != 1 ? 's' : ''}}</small></p>
            </div>
            <div class="col-xs-4 col-sm-4 emphasis">
                <h2><strong> {{ $user->allBuddies()->count() }} </strong></h2>
                <p><small>Budd{{$user->allBuddies()->count() != 1 ? 'ies' : 'y'}}</small></p>
            </div>
        </div>
    </div>
</div>

@endsection
