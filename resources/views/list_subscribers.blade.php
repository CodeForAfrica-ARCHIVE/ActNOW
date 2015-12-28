@extends('master')

@section('title', 'List Subscribers')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div>
                <script type="text/javascript">
                    $(document).ready(function() {

                        $('#select_petition').on('change', function () {

                            var petition_id = this.value;

                            if(petition_id != 0){
                                $(location).attr('href', '{!! URL::to("subscribers", array(), false) !!}' + '/' + petition_id);
                            }else{
                                $(location).attr('href', '{!! URL::to("subscribers", array(), false) !!}');
                            }

                        });

                    });

                </script>

                <select class="form-control" id="select_petition">
                    <option value="0">Select petition</option>
                    @foreach($data['petitions'] as $petition)
                        <option value="{!! $petition->id !!}" @if($petition->id == $data['current_petition']) selected="selected" @endif>{!! $petition->name !!}</option>
                    @endforeach
                </select>
            </div>

            @if(sizeof($data['subscribers'])==0)
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

                    @for($i = 1; $i<(sizeof($data['subscribers']) + 1); $i++)
                        <tr>
                            <td>{!! $i !!}</td>
                            <td>{!! $data['subscribers'][$i-1]->name !!}</td>
                            <td>{!! $data['subscribers'][$i-1]->number !!}</td>
                            <td>{!! $data['subscribers'][$i-1]->email !!}</td>
                            <td>{!! $data['subscribers'][$i-1]->location !!}</td>
                        </tr>
                    @endfor

                    </tbody>
                </table>
                {!! $data['subscribers']->render() !!}
            @endif
    </div>
@stop