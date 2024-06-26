@extends('layouts.layout')
<link rel="stylesheet" href="/css/task.css"> 
@section('content')
    <h1>Create task</h1>
    <form action="/tasks/create" method="POST" class="create-form">
        @csrf
        <label for="title">Title:</label>
        <input class="form-title" type="text" name="title" id="title" required>
        <label for="des">Description:</label>
        <textarea class="textarea" name="des" id="des" required></textarea>
        <label  for="due_date">Due Date:</label>
        <input class="date" type="date" name="due_date" id="due_date">
        <label for="assign_to">Assign To:</label>
        <select class="select" type="number" name="assign_to" id="assign_to">
            <option class="select-option" value="" default>Me</option>
            @foreach($friends as $friend)
                <option class="select-option" value="{{$friend->id}}">{{$friend->name}}</option>
            @endforeach
        </select>
        <button class="form-btn" type="submit">Create</button>
    </form>
@endsection