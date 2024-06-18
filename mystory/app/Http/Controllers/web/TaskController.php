<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = $user->tasks;
        $completedTasks = $user->completedTasks;
        $incompleteTasks = $user->incompleteTasks;
        $overdueTasks = $user->overdueTasks;
        $assignedTasks = $user->assignedTasks;
        return view('main.task', compact('tasks', 'completedTasks', 'incompleteTasks', 'overdueTasks','assignedTasks'));
    }

    public function create()
    {
        $friends = Auth::user()->friends();
        return view('main.create_task',compact('friends'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'des' => 'required|string',
            // 'status' => 'string|in:unfinished,finished',
            'due_date' => 'nullable|date',
            'assign_to' => 'nullable|exists:users,id',
        ]);

        $task = new Task($request->all());
        $task->uid = Auth::id();
        $task->save();

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('main.edit_task', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'des' => 'required|string',
            'status' => 'string|in:unfinished,finished',
            'due_date' => 'nullable|date',
            'assign_to' => 'nullable|exists:users,id',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('main.task_details', compact('task'));
    }
}
