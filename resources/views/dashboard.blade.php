@extends('master')

@section('title', 'Dashboard')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <div class="action-buttons">
            <a href="petition/add">
                <button type="button" class="btn btn-success">
                    <span class="action-button"><i class="fa fa-plus"></i> New Petition</span>
                </button>
            </a>
        </div>

        <div class="list-group">
            <a href="#" class="list-group-item active">
                <h4 class="list-group-item-heading">Petitions</h4>
                <p class="list-group-item-text"></p>
            </a>
            @foreach ($petitions as $petition)
                <a href="petition/{!! $petition->id !!}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $petition->name }}</h4>
                    <p class="list-group-item-text">
                        <span class="petition_desc_meta">#:{!! $petition->code !!}</span>
                        <span class="petition_desc_meta">Date: {!! $petition->created_at !!}</span>
                        <span class="petition_desc_meta">@if($petition->status == "1")<span style="color: green">Active</span> @else <span style="color: darkred">Suspended</span> @endif</span>

                    </p>
                </a>
            @endforeach

        </div>
        {!! $petitions->render() !!}
    </div>
@stop