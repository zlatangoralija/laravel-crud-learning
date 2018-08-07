@extends('layouts.admin')

@section('content')

    <h1>Create user</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminUserController@store', 'file'=>true])!!}
    <div class="form-group">
        {!! Form::label('name','Name: ') !!}
        {!! Form::text('name',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Email: ') !!}
        {!! Form::email('email',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Password: ') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id','Role: ') !!}
        {!! Form::select('role_id', array('' => 'Choose role') +$roles, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active','Status: ') !!}
        {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not active'), 0, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('file','File: ') !!}
        {!! Form::file('file',null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {{ Form::close() }}

    @include('includes.form_error')

@stop