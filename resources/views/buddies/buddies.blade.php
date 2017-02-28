@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        @if (Session::has('buddy_added'))
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Buddy voor {{ Session::get('buddy_deleted')->user->name }} succesvol toegevoegd</h3>
            </div>
            <div class="panel-body">
                {{ Session::get('buddy_deleted')->buddy->name }}: {{ Session::get('buddy_deleted')->relation }}
            </div>
        </div>
        @endif
        @if (Session::has('buddy_deleted'))
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Buddy van {{ Session::get('buddy_deleted')->user->name }} succesvol verwijderd</h3>
                </div>
                <div class="panel-body">
                    {{ Session::get('buddy_deleted')->buddy->name }}: {{ Session::get('buddy_deleted')->relation }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="timeline-centered">
                    @foreach ($buddies as $buddy)
                        <article class="timeline-entry">
                            <div class="timeline-entry-inner">
                                <div class="timeline-icon bg-love">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </div>
                                <div class="timeline-label">
                                    <h2>
                                        <a href="{{ route('buddies.show', ['buddy' => $buddy->id]) }}">Buddy</a> voor
                                        <a href="{{ route('buddies.index') }}">{{ $buddy->user->name }}</a>
                                        <span>Toegevoegd op {{ $buddy->created_at->toFormattedDateString() }}
                                        </span>
                                    </h2>
                                    <p>
                                        {{ $buddy->buddy->name }}: {{ $buddy->relation }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    <article class="timeline-entry begin">
                        <div class="timeline-entry-inner">
                            <div class="timeline-icon">
                                <i class="entypo-flight"></i>
                            </div>
                            <div class="timeline-label">
                                <p>Website gemaakt</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@endsection
