@extends('master')

@section('title', 'Login')

@section('content')
    <div class="col-sm-12 col-md-12 main">
        <div class="col-sm-4">
            <div class="form-horizontal">
                <h3>Login</h3>
                {!! Form::open(array('url' => 'login')) !!}
                <p>
                    {!! $errors->first('email') !!}
                    {!! $errors->first('password') !!}
                </p>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-horizontal">
                <h3>Register</h3>
                {!! Form::open(array('url' => 'register')) !!}
                <p>
                    {!! $errors->first('email') !!}
                    {!! $errors->first('password') !!}
                    {!! $errors->first('name') !!}
                </p>
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

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop