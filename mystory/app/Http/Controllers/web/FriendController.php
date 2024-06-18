<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FRequest;

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

    // Tìm và xóa các yêu cầu kết bạn giữa $currentUser và $friend
    FRequest::where(function ($query) use ($currentUser, $friend) {
        $query->where('sender_id', $currentUser->id)
            ->where('receiver_id', $friend->id)
            ->where('status', 'accepted');
    })->orWhere(function ($query) use ($currentUser, $friend) {
        $query->where('sender_id', $friend->id)
            ->where('receiver_id', $currentUser->id)
            ->where('status', 'accepted');
    })->delete();

    return redirect()->back()->with('success', 'successfully unfriended');
    }

}