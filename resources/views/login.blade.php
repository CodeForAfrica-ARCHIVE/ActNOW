@extends('master')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-sm-4 center">
            <div class="form-horizontal">
                {!! Form::open(array('url' => 'login')) !!}
                <p>
                    {!! $errors->first('email') !!}
                    {!! $errors->first('password') !!}
                </p>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop