@extends('master')

@section('title', 'Change Password')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h3>Change Password</h3>
        {!! \Illuminate\Support\Facades\Session::get('message') !!}

        {!! Form::open(array('url' => 'me/change_pass')) !!}
        <p>
            {!! $errors->first('password') !!}
        </p>
        <table id="subscribers_list" class="table table-striped">
            <tbody>
            <tr>
                <td>Old Password</td><td><input class="form-control" name="oldPassword" type="password"/></td>
            </tr>
                <tr>
                    <td>New Password</td><td><input class="form-control" name="password" type="password"/></td>
                </tr>
                <tr>
                    <td>Confirm New Password</td><td><input class="form-control" name="password_confirmation" type="password"/></td>
                </tr>
                <tr>
                    <td></td><td><button class="btn btn-warning" type="submit">Update</button></td>
                </tr>
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
@stop