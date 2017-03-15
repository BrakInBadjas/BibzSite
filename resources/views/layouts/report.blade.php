<!-- Modal -->
<div class="modal fade" id="bug-report-modal" tabindex="-1" role="dialog" aria-labelledby="Bug report modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="bug-report-modal">Report Bug</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('github.issue')}}" method="POST" id="bug-report-form">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('bugUrl') ? ' has-error' : '' }}">
                        <label for="bugUrl" class="control-label">Url:</label>
                        <input type="text" class="form-control" id="bugUrl" name="bugUrl" value="{{ old('bugUrl') }}" readonly="readonly" />
                        @if ($errors->has('bugUrl'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bugUrl') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('bugTitle') ? ' has-error' : '' }}">
                        <label for="bugTitle" class="control-label">Titel:</label>
                        <input type="text" class="form-control" id="bugTitle" name="bugTitle" value="{{ old('bugTitle') }}"/>
                        @if ($errors->has('bugTitle'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bugTitle') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('bugText') ? ' has-error' : '' }}">
                        <label for="bugText" class="control-label">Description:</label>
                        <textarea class="form-control" id="bugText" name="bugText" value="{{ old('bugText') }}" placeholder="Pleace try to describe the steps necessary to reproduce the problem."></textarea>
                        @if ($errors->has('bugText'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bugText') }}</strong>
                            </span>
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
                <button type="button" class="btn btn-primary" id="send-bug-report">Verstuur</button>
            </div>
        </div>
    </div>
</div>

@if(Session::has("bug-submission"))
    <div class="modal fade" id="bug-feedback-modal" tabindex="-1" role="dialog" aria-labelledby="Bug report">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="bug-report-modal">Bug report</h4>
                </div>
                <div class="modal-body">
                {{Session::get("bug-submission.message")}}
                </div>
            </div>
        </div>
    </div>
@endif