@extends('master')

@section('title', $data['user']->username)

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h3>Edit Profile</h3>
        {!! Form::open(array('url' => 'me/edit')) !!}
        <p>
            {!! $errors->first('name') !!}
            {!! $errors->first('username') !!}
            {!! $errors->first('email') !!}
        </p>
        <table id="subscribers_list" class="table table-striped">
            <tbody>
                <tr>
                    <td>Name</td><td><input class="form-control" name="name" type="text" value="{!! $data['user']->name !!}"/></td>
                </tr>
                <tr>
                    <td>Username</td><td><input class="form-control" name="username" type="text" value="{!! $data['user']->username !!}"/></td>
                </tr>
                <tr>
                    <td>Email</td><td><input class="form-control" name="email" type="text" value="{!! $data['user']->email !!}"/></td>
                </tr>
                <tr>
                    <td></td><td><button class="btn btn-warning" type="submit">Update</button></td>
                </tr>
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
@stop