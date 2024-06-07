<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
class ProfileController extends Controller
{
    public function getAllUserData($id)
    {
        // Lấy user cùng với profile của họ
        $user = User::with('profile')->find($id);
        
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }
}
