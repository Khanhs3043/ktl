<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function myGroups(){
        $user = Auth::user();
        $mygroups = $user->createdGroups;
        $groups = $user->groups;
        return view('main.group',compact('mygroups','groups'));
    }

    public function create(Request $request) // tạo mới một group với creator là người dùng hiện tại
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $group = Group::create([
            'name' => $request->name,
            'creator_id' => Auth::id(),
        ]);

        return redirect('/groups')->with('success', 'new group created !');
    }
    public function delete($id){
        $group = Group::find($id);

        if (!$group) {
            return redirect()->back()->withErrors(['message' => 'Group not found']);
        }

        // Check if the authenticated user is the owner of the post
        if ($group->creator_id != Auth::id()) {
            return redirect()->back()->withErrors(['message' => 'Unauthorized']);
        }

        $group->delete();
        return redirect('/groups')->with('success', 'Group deleted successfully.');
    }
    
    public function update($id,Request $request){
        $group = Group::find($id);

        if (!$group) {
            return redirect()->back()->withErrors(['message' => 'Group not found']);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $memberIds = $request->input('members', []);
        foreach ($memberIds as $memberId) {
            $group->addMember($memberId);
        }
        $group->update($request->all());
        return redirect()->back()->with('success', 'successfully!');

    }
    public function showUpdateView($id){
        $group = Group::find($id);
        return view('main.edit_group',compact('group'));
    }

    public function addUserToGroup(Request $request, $groupId) // thêm một user vào group
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $group = Group::findOrFail($groupId);

        // Kiểm tra xem người dùng có quyền thêm người dùng khác vào nhóm hay không
        if ($group->creator_id !== Auth::id()) {
            return redirect()->back()->withErrors(['message' => 'Unauthorized']);
        }

        $group->users()->attach($request->user_id);

        return redirect('/groups')->with('success', 'successfully!');
    }
    public function groupDetails($id){
        $group = Group::find($id);
        return view('main.group_details',compact('group'));
    }
    public function removeMember($groupid,$uid){
        $group = Group::find($groupid);
        $group->removeMember($uid);
        return redirect()->back()->with('success', 'successfully!');
    }
}
