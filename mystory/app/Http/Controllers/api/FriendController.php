<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller
{
    public function getAllUserInfo()
    {
        $users = User::all();
        return response()->json($users);
    }
}
