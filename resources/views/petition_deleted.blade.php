@extends('master')

@section('title', 'Deleted successfully!')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Petition deleted successfully! Go to <a href="/dashboard">petitions.</a>
        </div>
    </div>
@stop