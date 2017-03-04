@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        @if(Session::has('buddy_added->user->name'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('buddy_added->buddy->name') }} is nu Buddy van {{ Session::get('buddy_added->user->name') }}!
            </div>
        @endif
        @if (Session::has('buddy_deleted->user->name'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('buddy_deleted->buddy->name') }} is niet langer Buddy van {{ Session::get('buddy_deleted->user->name') }}!
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
                                            <a href="{{ route('profile.show', [$buddy->buddy->id]) }}">{{ $buddy->buddy->name }}</a> is nu
                                            <a href="{{ route('buddies.show', ['buddy' => $buddy->id]) }}">Buddy</a> van
                                            <a href="{{ route('profile.show', [$buddy->user->id]) }}">{{ $buddy->user->name }}</a>
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
                                            <a href="{{ route('profile.show', [$buddy->buddy->id]) }}">{{ $buddy->buddy->name }}</a> is geen
                                            <a href="{{ route('buddies.show', ['buddy' => $buddy->id]) }}">Buddy</a> meer van
                                            <a href="{{ route('profile.show', [$buddy->user->id]) }}">{{ $buddy->user->name }}</a>
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
                                <td><a href="{{ route('profile.show', [$buddy->user->id]) }}"><p class="text-muted">{{ $buddy->user->name }}</p></a></td>
                                <td><a href="{{ route('profile.show', [$buddy->buddy->id]) }}"><p class="text-muted">{{ $buddy->buddy->name }}</p></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
