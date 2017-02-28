@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Quote toevoegen</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('quotes.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Gezegd door</label>

                            <div class="col-md-6">
                                <select class="form-control" id="name" name="id" autofocus>
                                      @foreach (User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                      @endforeach
                                </select>
                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quote') ? ' has-error' : '' }}">
                            <label for="quote" class="col-md-4 control-label">Quote</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="3" name="quote"></textarea>

                                @if ($errors->has('quote'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quote') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Toevoegen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
