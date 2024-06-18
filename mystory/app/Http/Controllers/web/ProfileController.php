<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        return view('main.home',compact('user','posts'));
    }
    public function showEdit(){
        $profile = Auth::user()->profile;
        return view('main.edit_profile',compact('profile'));
    }
    public function showProfile($id)
    {
        $user = User::find($id);
        $posts = $user->posts();
        if($posts)
            $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        return view('main.profile',compact('user','posts'));
    }
    public function update(Request $request) // Cập nhật bài viết
    {
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required|string|max:255',
        //     'gender' => 'required|string|max:50',
        //     'dob' => 'required|date',
        //     'bio' => 'required|text',
        //     'avatar' => 'nullable|image|max:2048',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $profile = Auth::user()->profile;

        if (!$profile) {
            return redirect()->back()->withErrors(['message' => 'Post not found']);
        }

        $profile->username = $request->username;
        $profile->bio = $request->bio;
        $profile->gender = $request->gender;
        $profile->dob = $request->dob;

        // Xử lý tải lên hình ảnh nếu có
        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('posts', 'public');
            $profile->avatar = $imagePath;
        }

        $profile->save();

        return redirect('/home')->with('success', 'Profile updated successfully.');
    }

}
