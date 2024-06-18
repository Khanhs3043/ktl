@extends('layouts.layout')
<link rel="stylesheet" href="/css/task.css"> 
@section('content')
    <h1>Edit task</h1>
    <form action="/tasks/update/{{$task->id}}" method="POST" class="create-form">
        @csrf
        <label for="title">Title:</label>
        <input class="form-title" type="text" name="title" id="title" required value="{{$task->title}}"> 
        <label for="des">Description:</label>
        <textarea class="textarea" name="des" id="des" required>{{$task->des}}</textarea>
        <label  for="due_date">Due Date:</label>
        <input class="date" type="date" name="due_date" id="due_date" value="{{date('Y-m-d',strtotime($task->due_date))}}">
        <label for="assign_to">Assign To:</label>
        <select class="select" type="number" name="assign_to" id="assign_to">
            <option class="select-option" value="" default>Me</option>
            @foreach(Auth::user()->friends() as $friend)
                <option class="select-option" value="{{$friend->id}}">{{$friend->name}}</option>
            @endforeach
        </select>
        <button class="form-btn" type="submit">Update</button>
    </form>
@endsection