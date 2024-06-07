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

    public function updateUserProfile(Request $request, $id)
    {
        $user = User::with('profile')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->name = $request->input('name');

        // Cập nhật profile
        if ($user->profile) {
            $user->profile->username = $request->input('username');
            $user->profile->avatar = $request->input('avatar');
            $user->profile->dob = $request->input('dob');
            $user->profile->bio = $request->input('bio');
            $user->profile->gender = $request->input('gender');
            $user->profile->save();
        } else {
            // Nếu người dùng không có profile, tạo mới
            $user->profile()->create([
                'username' => $request->input('username'),
                'avatar' => $request->input('avatar'),
                'dob' => $request->input('dob'),
                'bio' => $request->input('bio'),
                'gender' => $request->input('gender'),
            ]);
        }

        $user->save();

        return response()->json($user->load('profile'));
    }
}
