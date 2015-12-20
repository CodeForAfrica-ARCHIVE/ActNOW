@extends('master')

@section('title', $petition->name)

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <ol class="breadcrumb">
            <li><a href="/dashboard">Petitions</a></li>
            <li class="active">{!! $petition->name !!}</li>
        </ol>

        <div class="action-buttons">
            <a href="edit/{!! $petition->id !!}">
                <button type="button" class="btn btn-warning">
                    <span class="action-button"><i class="fa fa-plus"></i> Edit</span>
                </button>
            </a>
            <a href="delete/{!! $petition->id !!}">
                <button type="button" class="btn btn-danger">
                    <span class="action-button"><i class="fa fa-plus"></i> Delete</span>
                </button>
            </a>
        </div>

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