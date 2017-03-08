@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if(Session::has('adtje_success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{Session::get('adtje_success')}}</p>
                </div>
            @elseif(Session::has('adtje_deleted'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{Session::get('adtje_deleted')}}</p>
                </div>
            @elseif(Session::has('adtje_validation'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{Session::get('adtje_validation')}}</p>
                </div>
            @endif
            <div class="col-md-8">
                @foreach($adtjes as $adtje)
                    <div class="well well-sm">
                        <a href="{{ route('adtjes.show', ['adtje' => $adtje->id]) }}">Adtje</a> voor
                        <a href="{{ route('profile.show', ['id' => $adtje->user->id]) }}">{{ $adtje->user->name }}</a> - 
                        Reden: {{$adtje->reason}}
                        <div class="btn-group btn-group-xs pull-right" role="group" aria-label="...">
                            <button type="button" class="btn btn-danger" class="button-deny" action="vote" vote="{{AdtjeValidation::DENY}}" adtje-id="{{$adtje->id}}"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-default" class="button-null" action="vote" vote="null" adtje-id="{{$adtje->id}}"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-success" class="button-approve" action="vote" vote="{{AdtjeValidation::APPROVE}}" adtje-id="{{$adtje->id}}"><i class="fa fa-check" aria-hidden="true"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
    <div class="hidden">
        <form id="post-validation" action="{{route('adtjes.validation.store', ['adtje' => 'ADTJEID']) }}?from=show" method="POST">
            {{ csrf_field() }}
            <input id="validation_status" name="status" value="null" type="hidden">
        </form>
    </div>    
@endsection

@section('scripts')
    <script src="{{ asset('js/adtjes.js') }}" type="text/JavaScript"></script>
@endsection
