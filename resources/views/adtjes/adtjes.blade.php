@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($adtjes as $adtje)
                <div class="timeline-centered">
                    <article class="timeline-entry">

                        <div class="timeline-entry-inner">

                            <div class="timeline-icon bg-success">
                                <i class="entypo-feather"></i>
                            </div>

                            <div class="timeline-label">
                                <h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
                                <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                            </div>
                        </div>

                    </article>
                </div>
            @endforeach
        </div>
    </div>
@endsection
