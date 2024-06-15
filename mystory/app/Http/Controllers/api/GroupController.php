<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function create(Request $request)
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

    public function addUserToGroup(Request $request, $groupId)
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

    public function getGroups()
    {
        $groups = Auth::user()->groups;

        return response()->json(['groups' => $groups], 200);
    }

    public function myGroups(){
        $user =Auth::user(); // Hoặc nếu đang xử lý cho người dùng hiện tại

        $createdGroups = $user->createdGroups()->get();

        // Lấy danh sách các nhóm đã tạo và trả về kết quả
        return response()->json(['created_groups' => $createdGroups]);

    }
}
