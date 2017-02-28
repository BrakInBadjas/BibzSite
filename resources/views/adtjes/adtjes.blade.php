@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        @if (Session::has('collected_adtje'))
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Adtje van {{ Session::get('collected_adtje') }} succesvol geïnt</h3>
                </div>
                <div class="panel-body">
                    {{ Session::get('collected_adtje_reason') }}
                </div>
            </div>
        @endif
        @if (Session::has('added_adtje'))
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Adtje voor {{ Session::get('added_adtje_for') }} succesvol toegevoegd</h3>
                </div>
                <div class="panel-body">
                    {{ Session::get('added_adtje') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="timeline-centered">
                    @foreach ($adtjes as $adtje)
                        <article class="timeline-entry">
                            <div class="timeline-entry-inner">
                                <div class="timeline-icon bg-{{ $adtje->collected ? 'info' : 'success' }}">
                                    <i class="entypo-feather"></i>
                                </div>
                                <div class="timeline-label">
                                    <h2>
                                        <a href="{{ route('adtjes.show', ['adtje' => $adtje->id]) }}">Adtje</a> voor
                                        <a href="{{ route('adtjes.index') }}">{{ $adtje->user->name }}</a>
                                        <span>Uitgedeeld op {{ $adtje->created_at->toFormattedDateString() }} door
                                            <a href="{{ route('adtjes.index') }}">{{ $adtje->creator->name }}</a>
                                        </span>
                                    </h2>
                                    <p>{{ $adtje->reason }}</p>
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
                @if (Auth::user()->adtjes()->open()->count() != 0)
                    <p>
                        <form method="POST" action="{{ route('adtjes.collect') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Adtje innen</button>
                        </form>
                    </p>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Adtjes counter</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Naam</th>
                            <th>Adtjes</th>
                            <th>Te innen</th>
                        </tr>
                        @foreach (User::all() as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
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
