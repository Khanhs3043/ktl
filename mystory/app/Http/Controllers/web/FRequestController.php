<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\FRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class FRequestController extends Controller
{
    public function sendRequest($uid) // gửi lời mời kết bạn từ người dùng hiện tại đến một user có id = uid
    {
        $sender_id = Auth::id(); // Lấy id của người dùng đã đăng nhập

        // Kiểm tra xem đã gửi yêu cầu trước đó chưa
        $existingRequest = FRequest::where('sender_id', $sender_id)
                                        ->where('receiver_id', $uid)
                                        ->first();

        if ($existingRequest) {
            return response()->json(['message' => 'Friend request already sent'], 409);
        }

        // Tạo mới yêu cầu kết bạn
        FRequest::create([
            'sender_id' => $sender_id,
            'receiver_id' => $uid,
            'status' => 'pending',
        ]);

        return redirect()->back()->withInput();
    }

    public function respondRequest(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:accepted,rejected',
            ]);

            $friendRequest = FRequest::where('id', $id)->first();

            if (!$friendRequest) {
                return redirect()->back()->with('error', 'Friend request not found');
            }

            $friendRequest->status = $request->status;
            $friendRequest->save();

            return redirect()->back()->with('success', 'Friend request ' . $request->status . ' successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }


    public function getRequests() // lấy những lời mời kết bạn được gửi tới (chỉ lấy trạng thái pending)
    {
        $requests = FRequest::where('receiver_id', Auth::user()->id)->where('status', 'pending')->get();
        return view('main.friend_request',compact('requests'));
    }
    public function getMyRequests() // lấy những lời mời kết bạn được gửi đi 
    {
        $requests = FRequest::where('sender_id', Auth::user()->id)->get();
        return response()->json($requests);
    }
    public function getUserFriendRequests($uid) // lấy những lời mời kết bạn được gửi đi từ một user
    {
        $requests = FRequest::where('sender_id', $uid)->get();
        return response()->json($requests);
    }

    public function deleteRequest($userId)
    {
        $currentUser = Auth::user();
        $deleted = $currentUser->deleteFriendRequest($userId);

        if ($deleted) {
            return redirect()->back();
        } else {
            return response()->json(['message' => 'No friend request found to delete'], 404);
        }
    }
}
