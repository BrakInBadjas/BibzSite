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
                    @if($buddies->currentPage() > 1)
                    <article class="timeline-entry">
                        <a href="{{url($buddies->previousPageUrl())}}">
                            <div class="timeline-entry-inner timeline-entry-pagination-up">
                                <div class="timeline-icon">
                                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endif
                    @foreach ($buddies as $buddyData)
                    <?php $buddy = $buddyData['object']; ?>
                        <article class="timeline-entry">
                            <div class="timeline-entry-inner">
                                @if(!$buddyData['break'])
                                    <div class="timeline-icon bg-love">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </div>
                                    <div class="timeline-label">
                                        <h2>
                                            <a href="{{ route('buddies.index') }}">{{ $buddy->buddy->name }}</a> is nu
                                            <a href="{{ route('buddies.show', ['buddy' => $buddy->id]) }}">Buddy</a> van
                                            <a href="{{ route('buddies.index') }}">{{ $buddy->user->name }}</a>
                                            <span>Toegevoegd op {{ $buddy->created_at->toFormattedDateString() }}</span>
                                        </h2>
                                        <p>
                                            {{ $buddy->relation }}
                                        </p>
                                    </div>
                                @else
                                    <div class="timeline-icon">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-heart fa-stack-1x bg-love"></i>
                                            <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-label">
                                        <h2>
                                            <a href="{{ route('buddies.index') }}">{{ $buddy->buddy->name }}</a> is geen
                                            <a href="{{ route('buddies.show', ['buddy' => $buddy->id]) }}">Buddy</a> meer van
                                            <a href="{{ route('buddies.index') }}">{{ $buddy->user->name }}</a>
                                            <span>Verwijderd op {{ $buddy->created_at->toFormattedDateString() }}</span>
                                        </h2>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                    @if(!$buddies->hasMorePages())
                    <article class="timeline-entry begin">
                        <div class="timeline-entry-inner">
                            <div class="timeline-icon">
                                <i class="fa fa-server" aria-hidden="true"></i>
                            </div>
                            <div class="timeline-label">
                                <p>Website gemaakt</p>
                            </div>
                        </div>
                    </article>
                    @else
                    <article class="timeline-entry">
                        <a href="{{url($buddies->nextPageUrl())}}">
                            <div class="timeline-entry-inner timeline-entry-pagination-down">
                                <div class="timeline-icon">
                                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endif
                </div>
            </div>
            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Drinking Buddies</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Naam</th>
                            <th>Buddy</th>
                        </tr>
                        @foreach ($buddies->filter(function($v,$k){return $v['object']->deleted_at == null;}) as $buddyData)
                        <?php $buddy = $buddyData['object']; ?>
                            <tr>
                                <td>{{ $buddy->user->name }}</td>
                                <td>{{ $buddy->buddy->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
