<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FRequest;

class FriendController extends Controller
{
    public function getFriends($id)
    {
        $user = User::with('friends')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user->friends);
    }
}
