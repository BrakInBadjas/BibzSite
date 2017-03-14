@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>
                    @if(($now = Carbon::now()) && ($hour = $now->hour) < 6)Ga eens slapen!
                    @elseif($now->day == 14 && $now->month == 3) <a href="https://en.wikipedia.org/wiki/Pi_Day" class="text-muted">HAPPY INTERNATIONAL PI DAY!</a>
                    @elseif($hour > 16 && ($day = $now->format('l')) == 'Tuesday') BORRELTIJD!
                    @elseif($hour == 12) TOSTITIJD!
                    @elseif($hour < 12)Goedemorgen {{Auth::user()->name}}!
                    @elseif($hour < 18)Goedemiddag {{Auth::user()->name}}!
                    @else Goedenavond {{Auth::user()->name}}!
                    @endif
                </h1>
                @if(($quote = Quote::inRandomOrder()->first()) != null)
                <p><i class="fa fa-quote-left fa-2x fa-pull-left fa-border" aria-hidden="true"></i>
                    {{$quote->quote}} <br />
                    ~ {{$quote->user->name}} <small>{{$quote->created_at->toFormattedDateString()}}</small>
                </p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Vandaag</h3>
                </div>
                <div class="panel-body">
                    Er {{$new_adtjes != 1 ? 'zijn' : 'is'}} vandaag {{$new_adtjes}} adtje{{$new_adtjes != 1 ? 's' : ''}} uitgedeeld en er {{$new_quotes != 1 ? 'zijn' : 'is'}} {{$new_quotes}} nieuwe quote{{$new_quotes != 1 ? 's' : ''}} geplaatst.
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Random kat</h3>
                </div>
                <div class="panel-body">
                    <img src="http://thecatapi.com/api/images/get?format=src&type=gif" width="100%">
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
