<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FRequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getFriends()
    {
        $uid = Auth::user()->id;
        $user = User::with('friends')->find($uid);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user->friends);
    }
    public function searchUsers(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $query = $request->input('query');

        // Tìm kiếm bạn bè dựa trên tên hoặc email
        $users = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->get();

        return response()->json($users);
    }
    public function searchFriends(Request $request, $userId)
    {
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $query = $request->input('query');

        // Lấy danh sách bạn bè của người dùng cụ thể
        $user = User::findOrFail($userId);

        $friends = $user->friends()
                        ->where(function ($queryBuilder) use ($query) {
                            $queryBuilder->where('name', 'LIKE', "%{$query}%")
                                         ->orWhere('email', 'LIKE', "%{$query}%");
                        })
                        ->get();

        return response()->json($friends);
    }
}
