@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    <div class="col-sm-6">
        {!! Form::open($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]])!!}
        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        </div>
        {{ Form::close() }}
    </div>

    <div class="col-sm-6">

    </div>
@stop