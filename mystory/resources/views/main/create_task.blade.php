@extends('layouts.layout')

@section('content')
    <h1>Create Task</h1>
    <form action="/tasks/create" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="des">Description:</label>
        <textarea name="des" id="des" required></textarea>
        <!-- <label for="status">Status:</label> -->
        <!-- <select name="status" id="status">
            <option value="unfinished">Unfinished</option>
            <option value="finished">Finished</option>
        </select> -->
        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" id="due_date">
        <label for="assign_to">Assign To:</label>
        <select type="number" name="assign_to" id="assign_to">
            @foreach($friends as $friend)
                <option value="{{$friend->id}}">{{$friend->name}}</option>
            @endforeach
        </select>
        <button type="submit">Create</button>
    </form>
@endsection