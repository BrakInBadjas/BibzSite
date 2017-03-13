@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        @if(Session::has('quote_added->name'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Quote van {{ Session::get('quote_added->name') }} succesvol toegevoegd!</p>
                Quote: {{ Session::get('quote_added->quote') }}
            </div>
        @endif
        @if(Session::has('quote_deleted->name'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Quote van {{ Session::get('quote_deleted->name') }} succesvol verwijderd!</p>
                Quote: {{ Session::get('quote_deleted->quote') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="timeline-centered">
                    @if($quotes->currentPage() > 1)
                    <article class="timeline-entry">
                        <a href="{{url($quotes->previousPageUrl())}}">
                            <div class="timeline-entry-inner timeline-entry-pagination-up">
                                <div class="timeline-icon">
                                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endif
                    @foreach ($quotes as $quote)
                        <article class="timeline-entry">
                            <div class="timeline-entry-inner">
                                <div class="timeline-icon bg-info">
                                    <i class="entypo-feather"></i>
                                </div>
                                <div class="timeline-label">
                                    <h2>
                                        <a href="{{ route('quotes.show', ['quote' => $quote->id]) }}">Quote</a> van
                                        <a href="{{ route('profile.show', ['id' => $quote->user->id]) }}">{{ $quote->user->name }}</a>
                                        <span>{{ $quote->created_at->toFormattedDateString() }}</span>
                                    </h2>
                                    <p>{{ $quote->quote }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    @if(!$quotes->hasMorePages())
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
                        <a href="{{url($quotes->nextPageUrl())}}">
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
                        <h3 class="panel-title">Quote counter</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Naam</th>
                            <th>Quotes</th>
                        </tr>
                        @foreach (User::with('quotes')->get()->sortByDesc(function($user) { return $user->quotes()->count(); }) as $user)
                            <tr>
                                <td><a href="{{ route('profile.show', ['id' => $user->id]) }}" class="text-muted">{{ $user->name }}</a></td>
                                <td>{{ $user->quotes->count() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
