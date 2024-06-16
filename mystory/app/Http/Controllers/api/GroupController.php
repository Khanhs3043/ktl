<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function create(Request $request) // tạo mới một group với creator là người dùng hiện tại
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $group = Group::create([
            'name' => $request->name,
            'creator_id' => Auth::id(),
        ]);

        return response()->json(['group' => $group], 201);
    }

    public function addUserToGroup(Request $request, $groupId) // thêm một user vào group
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $group = Group::findOrFail($groupId);

        // Kiểm tra xem người dùng có quyền thêm người dùng khác vào nhóm hay không
        if ($group->creator_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $group->users()->attach($request->user_id);

        return response()->json(['message' => 'User added to group successfully'], 200);
    }

    public function getGroups() // lấy tất cả group mà người dùng hiện tại là thành viên (không bao gồm group tự tạo)
    {
        $groups = Auth::user()->groups;

        return response()->json(['groups' => $groups], 200);
    }

    public function myGroups(){ //lấy tất cả groups mà người dùng tạo
        $user =Auth::user(); 

        $createdGroups = $user->createdGroups()->get();

        // Lấy danh sách các nhóm đã tạo và trả về kết quả
        return response()->json(['created_groups' => $createdGroups]);

    }
    public function groupUsers($groupId){ // lấy tất cả thành viên trong một group dựa vào grouId
        // $user =Auth::user(); 
        $group = Group::find($groupId);

        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        // Lấy danh sách thành viên của nhóm
        $members = $group->members()->get();
        return response()->json(['members' => $members]);
    }
}
