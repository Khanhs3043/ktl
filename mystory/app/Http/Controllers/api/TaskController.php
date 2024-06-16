<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // Lấy danh sách tasks
    public function tasks()
    {
        $tasks = Task::where('uid', Auth::id())->get();
        return response()->json($tasks);
    }

    // Tạo task mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'des' => 'required',
            'status' => 'required',
            'due_date' => 'nullable|date',
            'assign_to' => 'nullable|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $task = Task::create([
            'uid' => Auth::id(),
            'title' => $request->title,
            'des' => $request->des,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'assign_to' => $request->assign_to
        ]);

        return response()->json($task, 201);
    }

    // Cập nhật task
    public function update(Request $request,$taskId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'des' => 'required',
            'status' => 'required',
            'due_date' => 'nullable|date',
            'assign_to' => 'nullable|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $task = Task::find($taskId);
        $task->update($request->all());

        return response()->json($task);
    }

    // Xóa task
    public function delete($taskId)
    {
        $task = Task::find($taskId);

        if (!$task) {
            return response()->json(['message' => 'No task found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'task deleted!'], 200);
    }
}
