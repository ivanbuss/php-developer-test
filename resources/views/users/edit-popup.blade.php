<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(['action' => ['Users\EditController@postUpdate', $user->id], 'class' => 'form-horizontal']) }}
        {!! Form::token() !!}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') ? old('email') : $user->email }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">First Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') ? old('first_name') : $user->profile->first_name }}">

                @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Last Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') ? old('last_name') : $user->profile->last_name }}">

                @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Gender</label>

            <div class="col-md-6">
                {{ Form::select('gender', [1 => 'Male', 2 => 'Female'], old('gender') ? old('gender') : $user->profile->gender, ['class'=>'form-control', 'placeholder'=>'-Select gender-']) }}

                @if ($errors->has('gender'))
                    <span class="help-block">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input type="password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('parents_father') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Father</label>

            <div class="col-md-6">
                {{ Form::select('parents_father', $user_parents_list, old('parents_father') ? old('parents_father') : $user->profile->father_id, ['class'=>'form-control', 'placeholder'=>'-Select user-']) }}

                @if ($errors->has('parents_father'))
                    <span class="help-block">
                        <strong>{{ $errors->first('parents_father') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('parents_mother') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Mother</label>

            <div class="col-md-6">
                {{ Form::select('parents_mother', $user_parents_list, old('parents_mother') ? old('parents_mother') : $user->profile->mother_id, ['class'=>'form-control', 'placeholder'=>'-Select user-']) }}

                @if ($errors->has('parents_mother'))
                    <span class="help-block">
                        <strong>{{ $errors->first('parents_mother') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('partner') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Partner</label>

            <div class="col-md-6">
                {{ Form::select('partner', $user_partners_list, old('partner') ? old('partner') :  $user->profile->partner_id, ['class'=>'form-control', 'placeholder'=>'-Select user-']) }}

                @if ($errors->has('partner'))
                    <span class="help-block">
                        <strong>{{ $errors->first('partner') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-user"></i>Update user
                </button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>