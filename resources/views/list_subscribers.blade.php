@extends('master')

@section('title', 'List Subscribers')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @if(sizeof($subscribers)==0)
                <div class="alert alert-warning" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    No subscribers yet!
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Location</th>
                    </tr>
                    </thead>
                    <tbody>

                    @for($i = 1; $i<(sizeof($subscribers) + 1); $i++)
                        <tr>
                            <td>{!! $i !!}</td>
                            <td>{!! $subscribers[$i-1]->name !!}</td>
                            <td>{!! $subscribers[$i-1]->number !!}</td>
                            <td>{!! $subscribers[$i-1]->email !!}</td>
                            <td>{!! $subscribers[$i-1]->location !!}</td>
                        </tr>
                    @endfor

                    </tbody>
                </table>
                {!! $subscribers->render() !!}
            @endif
    </div>
@stop