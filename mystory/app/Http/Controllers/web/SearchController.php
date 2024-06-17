<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class SearchController extends Controller
{
    public function searchUsers(Request $request) // tìm kiếm một người dùng
    {
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $query = $request->input('query');

        // Tìm kiếm bạn bè dựa trên tên hoặc email
        $users = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->get();

        return  view('main.search_user',compact('users'));
    }
    public function searchFriends(Request $request, $userId) // tìm kiếm bạn bè của người dùng cụ thể
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

        return view('',compact('friends'));
    }
}
