@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>
                    @if(($hour = Carbon::now()->hour) < 6)Ga eens slapen!
                    @elseif($hour < 12)Goedemorgen {{Auth::user()->name}}!
                    @elseif($hour < 18)Goedemiddag {{Auth::user()->name}}!
                    @else Goedenavond {{Auth::user()->name}}!
                    @endif
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
