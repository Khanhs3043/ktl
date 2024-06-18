@extends('layouts.layout')
<link rel="stylesheet" href="/css/task.css"> 
@section('content')
<h1>Tasks</h1>

<a href="/tasks/create" class="create-task">Create new task</a>
<div class="wrap-options">
    <p class="type1 task-type">All tasks</p>
    <p class="type2 task-type">Completed tasks</p>
    <p class="type3 task-type">Incompleted tasks</p>
    <p class="type4 task-type">Overdue Tasks</p>
    <p class="type5 task-type">Assigned Tasks</p>
</div>
<div class="wrap-tbl">
    <table id="table1" class="task-tbl1 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach($tasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->due_date?$task->due_date:"no due date" }}</td>
        <td>{{ $task->status }}</td>
        <td>
            
            @if($task->isCreatedByMe())
            <a href="/task/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            @endif
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check"></i></button>
                </form>
            @else
                <form action="/tasks/markAsFinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check"></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->des}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >
    <table id="table2" class="task-tbl2 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Completed at</th>
        <th>Action</th>
    </tr>
    @foreach($completedTasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->due_date?$task->due_date:"no due date" }}</td>
        <td>{{ $task->updated_at }}</td>
        <td>
            
            @if($task->isCreatedByMe())
            <a href="/task/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            @endif
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check"></i></button>
                </form>
            @else
                <form action="/tasks/markAsFinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check"></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->des}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >
    <table id="table3" class="task-tbl3 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach($incompleteTasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->due_date?$task->due_date:"no due date" }}</td>
        <td>{{ $task->status }}</td>
        <td>
            
            @if($task->isCreatedByMe())
            <a href="/task/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            @endif
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check"></i></button>
                </form>
            @else
                <form action="/tasks/markAsFinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check"></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->des}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >
    <table id="table4" class="task-tbl4 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach($overdueTasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->due_date?$task->due_date:"no due date" }}</td>
        <td>{{ $task->status }}</td>
        <td>
            
            @if($task->isCreatedByMe())
            <a href="/task/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            @endif
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check"></i></button>
                </form>
            @else
                <form action="/tasks/markAsFinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check"></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->des}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >
    <table id="table5" class="task-tbl5 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Assigner</th>
        <th>Action</th>
    </tr>
    @foreach($assignedTasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->due_date?$task->due_date:"no due date" }}</td>
        <td>{{ $task->user->name }}</td>
        <td>
            
            @if($task->isCreatedByMe())
            <a href="/task/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            @endif
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check"></i></button>
                </form>
            @else
                <form action="/tasks/markAsFinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check"></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->des}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >

</div>
<script src="/js/task.js"></script>
@endsection