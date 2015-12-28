@extends('master')

@section('title', $data['user']->username)

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h3>My Profile</h3>
        {!! \Illuminate\Support\Facades\Session::get('message') !!}
        <div class="action-buttons">
            <a href="me/edit">
                <button type="button" class="btn btn-warning">
                    <span class="action-button"><i class="fa fa-edit"></i> Edit Profile</span>
                </button>
            </a>
            <a href="me/change_pass">
                <button type="button" class="btn btn-danger">
                    <span class="action-button"><i class="fa fa-user-secret"></i> Change Password</span>
                </button>
            </a>
        </div>
        <table id="subscribers_list" class="table table-striped">
            <tbody>
                <tr>
                    <td>Name</td><td>{!! $data['user']->name !!}</td>
                </tr>
                <tr>
                    <td>Username</td><td>{!! $data['user']->username !!}</td>
                </tr>
                <tr>
                    <td>Email</td><td>{!! $data['user']->email !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
@stop