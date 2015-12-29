@extends('lean_master')

@section('title', $petition->name)

@section('content')

    <div class="col-sm-12 col-md-12 main">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{!! $petition->name !!}</h3>
            </div>
            <div class="panel-body">
                {!! $petition->description !!}
            </div>
        </div>


    </div>
@stop