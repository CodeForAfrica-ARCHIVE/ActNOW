@extends('master')

@section('title', 'Edit Petition')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="form-horizontal">
                @if( !empty($success))
                    {!! $success !!}
                @endif
                <h1 class="page-header">Edit Petition</h1>
                {!! Form::open(array('url' => 'edit_petition')) !!}
                <p>
                    {!! $errors->first('name') !!}
                    {!! $errors->first('description') !!}
                    {!! $errors->first('sms_number') !!}
                    {!! $errors->first('code') !!}
                </p>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="hidden" name="id" value="{!! $petition->id !!}">
                        <input type="name" name="name" class="form-control" id="inputName" placeholder="Title" value="{!! $petition->name !!}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea name="description" rows="6" class="form-control" id="inputDescription" placeholder="Description">{!! $petition->description !!}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="sms" name="sms_number" class="form-control" id="inputNumber" placeholder="SMS Number" value="{!! $petition->sms_number !!}"/>
                    </div>
                    <div class="col-sm-6">
                        <input type="code" name="code" class="form-control" id="inputCode" placeholder="Code or Keyword" value="{!! $petition->code !!}">
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-2">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="submit" class="btn btn-warning">Cancel</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
</div>
@stop