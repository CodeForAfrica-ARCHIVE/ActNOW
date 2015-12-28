@extends('master')

@section('title', 'Register')

@section('content')
    <div class="col-sm-12 col-lg-offset-2 col-md-12 col-md-offset-2 main">
        <div class="col-sm-6">
            <div class="form-horizontal">
                <h3>Register</h3>
                {!! Form::open(array('url' => 'register')) !!}
                <p>
                    {!! $errors->first('email') !!}
                    {!! $errors->first('password') !!}
                    {!! $errors->first('name') !!}
                    {!! $errors->first('username') !!}
                </p>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="inputUserName" placeholder="User name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword5" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-default">Register</button>
                    </div>
                </div>
                <a href="login">Already registered? Login</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop