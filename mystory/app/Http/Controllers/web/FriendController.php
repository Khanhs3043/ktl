<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FriendController extends Controller
{
    public function getFriends()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $friends = $user->friends();
        return view('main.friend', compact('friends'));
    }

    // Tìm kiếm người dùng
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

        return view('main.friend', compact('users'));
    }

    // Tìm kiếm bạn bè của người dùng cụ thể
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

        return view('main.friend', compact('friends'));
    }
    public function unfriend($id)
{
    $currentUser = auth()->user();
    $friend = User::find($id);

    if (!$friend) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Check if the current user is friends with the friend user
    if (!$currentUser->isFriendWith($friend->id)) {
        return response()->json(['message' => 'Not friends with this user'], 400);
    }

    // Detach the friend from the current user's friends
    $currentUser->friends()->detach($friend);

    return response()->json(['message' => 'Successfully unfriended'], 200);
}

}