@extends('layouts.admin')

@section('content')
    @include('includes.tinyeditor')

    <h1>Create post</h1>

    <div class="row">

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true])!!}
    <div class="form-group">
        {!! Form::label('title','Title') !!}
        {!! Form::text('title',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('category_id','Category ') !!}
        {!! Form::select('category_id',array('' => 'Choose category') + $categories, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id','Photo ') !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body','Text: ') !!}
        {!! Form::textarea('body',null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary', 'rows'=>'3']) !!}
    </div>
    {{ Form::close() }}
    </div>

    <div class="row">
        @include('includes.form_error')
    </div>

@stop