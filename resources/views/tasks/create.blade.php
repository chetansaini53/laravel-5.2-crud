@extends('layouts.app')

@section('content')

<h1>Add a New Task</h1>
<p class="lead">Add to your task list below.</p>
<hr>
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{{ Form::open(['route' => 'tasks.store']) }}

<div class="form-group">
    {{ Form::label('title', 'Title:', ['class' => 'control-label','id'=> 'title']) }}
    {{ Form::text('title', null, ['class' => 'form-control','placeholder'=> 'Title max length 20','required','maxLength'=>'20']) }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description:', ['class' => 'control-label']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control','placeholder'=> 'Description max length 200','required','maxLength'=>'200']) }}
</div>
<div class="form-group">
    {{ Form::label('banner', 'Banner:', ['class' => 'control-label']) }}
    {{ Form::file('banner', null, ['class' => 'form-control','required']) }}
</div>

{{ Form::submit('Add New Task', ['class' => 'btn btn-primary']) }}

{{ Form::close() }}
@stop