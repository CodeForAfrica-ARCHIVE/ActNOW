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

        <span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-code"></i> Embed this petition</span>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Embed code</h4>
                    </div>
                    <div class="modal-body">
                        Copy and paste the code below where you want the petition to appear.
                        <textarea class="form-control"><iframe src="{!! URL::to("/embed/" . $petition->id) !!}" scrolling="no" frameborder="0" width="150px" height="100px"></iframe></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@stop