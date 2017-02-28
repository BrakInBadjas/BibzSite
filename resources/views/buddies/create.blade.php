@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buddy toevoegen</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('buddies.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ ($errors->has('user_id') || $errors->has('duplicate') || $errors->has('same_user')) ? ' has-error' : '' }}">
                            <label for="user_id" class="col-md-4 control-label">Persoon</label>

                            <div class="col-md-6">
                                <select class="form-control" name="user_id" autofocus>
                                      @foreach (User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                      @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @elseif ($errors->has('duplicate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('duplicate') }}</strong>
                                    </span>
                                @elseif ($errors->has('same_user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('same_user') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ ($errors->has('user_id') || $errors->has('duplicate') || $errors->has('same_user')) ? ' has-error' : '' }}">
                            <label for="buddy_id" class="col-md-4 control-label">Buddy</label>

                            <div class="col-md-6">
                                <select class="form-control" name="buddy_id" autofocus>
                                      @foreach (User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                      @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @elseif ($errors->has('duplicate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('duplicate') }}</strong>
                                    </span>
                                @elseif ($errors->has('same_user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('same_user') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quote') ? ' has-error' : '' }}">
                            <label for="relation" class="col-md-4 control-label">Relatie</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="3" name="relation"></textarea>

                                @if ($errors->has('relation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('relation') }}</strong>
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
