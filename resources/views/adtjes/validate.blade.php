@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($adtjes as $adtje)
                    <div class="well well-sm">
                        <a href="{{ route('adtjes.show', ['adtje' => $adtje->id]) }}">Adtje</a> voor
                        <a href="{{ route('profile.show', ['id' => $adtje->user->id]) }}">{{ $adtje->user->name }}</a> - 
                        Reden: {{$adtje->reason}}
                        <div class="btn-group btn-group-xs pull-right" role="group" aria-label="...">
                            <button type="button" class="btn btn-danger" class="button-deny" id="adtje-{{$adtje->id}}"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-default" class="button-null" id="adtje-{{$adtje->id}}"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-success" class="button-approve" id="adtje-{{$adtje->id}}"><i class="fa fa-check" aria-hidden="true"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/adtjes.js') }}" type="text/JavaScript"></script>
@endsection
