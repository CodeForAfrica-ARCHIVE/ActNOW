@extends('master')

@section('title', 'Login')

@section('content')
    <div class="col-sm-12 col-lg-offset-2 col-md-12 col-md-offset-2 main">
        <div class="col-sm-6">
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
                <a href="register">No account? Register</a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop