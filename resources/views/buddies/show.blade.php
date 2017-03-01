@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buddy</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            Wie:
                        </div>
                        <div class="col-md-8">
                            {{ $buddy->user->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Met:
                        </div>
                        <div class="col-md-8">
                            {{ $buddy->buddy->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Waarom:
                        </div>
                        <div class="col-md-8">
                            {{ $buddy->relation }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
