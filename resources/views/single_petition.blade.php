@extends('master')

@section('title', $data['petition']->name)

@section('content')

    <script type="text/javascript">
        $(document).ready(function() {

            $("#delete-petition").click('click', function (e) {
                var confirm_delete = confirm("Are you sure you want to delete the petition?");
                if (confirm_delete) {
                    //delete petition
                    $(location).attr('href', "{{ URL::to('petition/delete',array(),false) }}/" + {!! $data['petition']->id !!});
                }
            });
        });

    </script>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <ol class="breadcrumb">
            <li><a href="/dashboard">Petitions</a></li>
            <li class="active">{!! $data['petition']->name !!}</li>
        </ol>

        <div class="action-buttons">
            <a href="edit/{!! $data['petition']->id !!}">
                <button type="button" class="btn btn-warning">
                    <span class="action-button"><i class="fa fa-edit"></i> Edit</span>
                </button>
            </a>

            <span id="delete-petition" data-petition="{!! $data['petition']->id !!}">
                <button type="button" class="btn btn-danger">
                    <span class="action-button"><i class="fa fa-trash-o"></i> Delete</span>
                </button>
            </span>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{!! $data['petition']->name !!}</h3>
                <span class="petition_desc_meta">#:{!! $data['petition']->code !!}</span>
                <span class="petition_desc_meta">Date: {!! $data['petition']->created_at !!}</span>
                <span class="petition_desc_meta">@if($data['petition']->status == "1")<span style="color: green">Active</span> @else <span style="color: darkred">Suspended</span> @endif</span>
            </div>
            <div class="panel-body">
                {!! $data['petition']->description !!}
            </div>
        </div>

        <div class="table-responsive col-sm-9">
            @if(sizeof($data['signatures'])==0)
                <div class="alert alert-warning" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    No one has signed yet!
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>

                    @for($i = 1; $i<(sizeof($data['signatures']) + 1); $i++)
                        <tr>
                            <td>{!! $i !!}</td>
                            <td>{!! $data['signatures'][$i-1]->message !!}</td>
                            <td>{!! $data['signatures'][$i-1]->created_at !!}</td>
                        </tr>
                    @endfor

                    </tbody>
                </table>
                {!! $data['signatures']->render() !!}
            @endif
        </div>
        <div class="jumbotron col-sm-3">
            <table class="table table-striped petition_meta">
                <tbody>
                <tr><td>Signatures</td> <td>{!! $data['signatures_count'] !!}</td></tr>
                <tr><td>Period</td><td>{!! $data['period'] !!}</td></tr>
                </tbody>
            </table>
            <span class="btn btn-primary btn-sm petition_meta_btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-code"></i> Embed this petition</span>

            <a href="/export/csv/{!! $data['petition']->id !!}"><span class="btn btn-primary btn-sm petition_meta_btn"><i class="fa fa-file-excel-o"></i> Export to CSV</span></a>

            <a href="/export/pdf/{!! $data['petition']->id !!}"><span class="btn btn-primary btn-sm petition_meta_btn"><i class="fa fa-file-pdf-o"></i> Export to PDF</span></a>

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
                            <textarea class="form-control"><iframe src="{!! URL::to("/embed/" . $data['petition']->id) !!}" scrolling="no" frameborder="0" width="150px" height="100px"></iframe></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop