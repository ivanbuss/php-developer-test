@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new user</div>
                <div class="panel-body">
                    {{ Form::open(['action' => 'Users\CreateController@postCreate', 'class' => 'form-horizontal']) }}
                        {!! Form::token() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

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
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">

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
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

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
                                {{ Form::select('gender', [1 => 'Male', 2 => 'Female'], old('gender'), ['class'=>'form-control', 'placeholder'=>'-Select gender-']) }}

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
                                {{ Form::select('parents_father', $users, old('parents_father'), ['class'=>'form-control', 'placeholder'=>'-Select user-']) }}

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
                                {{ Form::select('parents_mother', $users, old('parents_mother'), ['class'=>'form-control', 'placeholder'=>'-Select user-']) }}

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
                                {{ Form::select('partner', $users, old('partner'), ['class'=>'form-control', 'placeholder'=>'-Select user-']) }}

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
                                    <i class="fa fa-btn fa-user"></i>Create user
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
