<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        return view('main.home',compact('user','posts'));
    }
}
