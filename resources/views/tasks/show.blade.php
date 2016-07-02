@extends('layouts.app')

@section('content')
@include('search',['url'=>'tasks','link'=>'tasks'])
<div style="clear: both;"><h1>{{ $task->title }}</h1>
<p class="lead">{{ $task->description }}</p>
<hr>
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('tasks.index') }}" class="btn btn-info">Back to all tasks</a>
        <a href="{{ route('tasks.edit', $task->seo_url) }}" class="btn btn-primary">Edit Task</a>
    </div>
    <div class="col-md-6 text-right">
        {{ Form::open([
            'method' => 'DELETE',
            'route' => ['tasks.destroy', $task->seo_url]
        ]) }}
            {{ Form::submit('Delete this task?', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
    </div>
</div>
</div>
@stop