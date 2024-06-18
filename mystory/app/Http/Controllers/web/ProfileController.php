<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
   
}
