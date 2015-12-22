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
                    <span class="action-button"><i class="fa fa-plus"></i> Edit</span>
                </button>
            </a>

            <span id="delete-petition" data-petition="{!! $data['petition']->id !!}">
                <button type="button" class="btn btn-danger">
                    <span class="action-button"><i class="fa fa-plus"></i> Delete</span>
                </button>
            </span>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{!! $data['petition']->name !!}</h3>
            </div>
            <div class="panel-body">
                {!! $data['petition']->description !!}
            </div>
        </div>

        <div class="table-responsive col-sm-9">
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
        </div>
        <div class="jumbotron col-sm-3">
            Signatures: {!! $data['signatures_count'] !!}
            <br/>
            Period: {!! $data['period'] !!}
        </div>
    </div>
@stop