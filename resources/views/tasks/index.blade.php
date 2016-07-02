@extends('layouts.app')

@section('content')
@include('search',['url'=>'tasks','link'=>'tasks'])
<div style="
    clear: both;
    ">
@foreach($tasks as $task)
<div style="
    clear: both;
">
    <h3>{{ $task->title }}</h3>
    <p>{{ $task->description}}</p>
    <p>
        <a href="{{ route('tasks.show', $task->seo_url) }}" class="btn btn-info">View Task</a>
        <a href="{{ route('tasks.edit', $task->seo_url) }}" class="btn btn-primary">Edit Task</a>
    </p>
    <hr>
</div>
@endforeach
</div>
<div style="
    clear: both;
    ">
    @include('tasks.sidebar')
</div>
{{ $tasks->links() }}
@stop