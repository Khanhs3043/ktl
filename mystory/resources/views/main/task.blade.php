@extends('layouts.layout')
@section('content')
<h1>Tasks</h1>
    <a href="/tasks/create">Create Task</a>

    <h2>All Tasks</h2>
    <ul>
        @foreach($tasks as $task)
            <li>
                <a href="#">{{ $task->title }}</a>
                <a href="#">Edit</a>
                <form action="#" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>Completed Tasks</h2>
    <ul>
        @foreach($completedTasks as $task)
            <li>
                <a href="#">{{ $task->title }}</a>
            </li>
        @endforeach
    </ul>

    <h2>Incomplete Tasks</h2>
    <ul>
        @foreach($incompleteTasks as $task)
            <li>
                <a href="#">{{ $task->title }}</a>
            </li>
        @endforeach
    </ul>

    <h2>Overdue Tasks</h2>
    <ul>
        @foreach($overdueTasks as $task)
            <li>
                <a href="#">{{ $task->title }}</a>
            </li>
        @endforeach
    </ul>
    <h2>Assigned Tasks</h2>
    <ul>
        @foreach($assignedTasks as $task)
            <li>
                <a href="#">{{ $task->title }}</a>
            </li>
        @endforeach
    </ul>
    
@endsection