@extends('master')

@section('title', 'Dashboard')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <div class="list-group">
            <a href="#" class="list-group-item active">
                <h4 class="list-group-item-heading">Petitions</h4>
                <p class="list-group-item-text"></p>
            </a>
            @foreach ($petitions as $petition)
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $petition->name }}</h4>
                    <p class="list-group-item-text">{{ $petition->description }}</p>
                </a>
            @endforeach

        </div>
        {!! $petitions->render() !!}
    </div>
@stop