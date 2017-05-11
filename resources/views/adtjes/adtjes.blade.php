@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        @if(Session::has('adtje_added->name'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>{{__('models/adtje.succes_added', ['name' => Session::get('adtje_added->name')])}}</p>
                {{__('models/adtje.succes_reason', ['reason' => Session::get('adtje_added->reason')])}}
            </div>
        @endif
        @if(Session::has('adtje_deleted->name'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>{{__('models/adtje.delted_added', ['name' => Session::get('adtje_deleted->name')])}}</p>
                {{__('models/adtje.deleted_reason', ['reason' => Session::get('adtje_deleted->reason')])}}
            </div>
        @endif
        @if(Session::has('adtje_collected->date'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{__('modes/adtje.collected')}}
            </div>
        @endif
        @if(Session::has('adtje_deleted'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('adtje_deleted')}}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="timeline-centered">
                    @if($adtjes->currentPage() > 1)
                    <article class="timeline-entry">
                        <a href="{{url($adtjes->previousPageUrl())}}">
                            <div class="timeline-entry-inner timeline-entry-pagination-up">
                                <div class="timeline-icon">
                                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endif
                    @foreach ($adtjes as $adtje)
                        <article class="timeline-entry">
                            <div class="timeline-entry-inner">
                                <div class="timeline-icon bg-{{ $adtje->collected ? 'info' : 'success' }}">
                                    <i class="entypo-feather"></i>
                                </div>
                                <div class="timeline-label">
                                    <h2>
                                        <a href="{{ route('adtjes.show', ['adtje' => $adtje->id]) }}">Adtje</a> voor
                                        <a href="{{ route('profile.show', ['id' => $adtje->user->id]) }}">{{ $adtje->user->name }}</a>
                                        <span>Uitgedeeld op {{ $adtje->created_at->toFormattedDateString() }} door
                                            <a href="{{ route('profile.show', ['id' => $adtje->creator->id]) }}">{{ $adtje->creator->name }}</a>
                                        </span>
                                    </h2>
                                    <p>{{ $adtje->reason }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    @if(!$adtjes->hasMorePages())
                    <article class="timeline-entry begin">
                        <div class="timeline-entry-inner">
                            <div class="timeline-icon">
                                <i class="fa fa-server" aria-hidden="true"></i>
                            </div>
                            <div class="timeline-label">
                                <p>{{__('layout/general.website_created')}}</p>
                            </div>
                        </div>
                    </article>
                    @else
                    <article class="timeline-entry">
                        <a href="{{url($adtjes->nextPageUrl())}}">
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
                @if (Auth::user()->adtjes()->open()->count() != 0)
                    <p>
                        <form method="POST" action="{{ route('adtjes.collect') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('models/adtje.collect')}}</button>
                        </form>
                    </p>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('models/adtje.counter')}}</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <th>{{__('auth/general.name')}}</th>
                            <th>{{__('models/adtje.title')}}</th>
                            <th>{{__('models/adtje.to_collect')}}</th>
                        </tr>
                        @foreach (User::with('adtjes')->get()->sortByDesc(function($user) { return $user->adtjes()->count(); }) as $user)
                            <tr>
                                <td><a href="{{ route('profile.show', ['id' => $user->id]) }}" class="text-muted">{{ $user->name }}</a></td>
                                <td>{{ $user->adtjes->count() }}</td>
                                <td>{{ $user->adtjes()->open()->count() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
