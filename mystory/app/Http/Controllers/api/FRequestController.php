<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FRequest;
use App\Models\Friend;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
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

        return response()->json(['message' => 'Friend request sent successfully'], 201);
    }

    public function respondRequest(Request $request,$id) // phản hồi (chấp nhận/từ chối) cho một lời mời kết bạn
    {
        try{
            $request->validate([
                'status' => 'required|in:accepted,rejected',
            ]);
            $friendRequest = FRequest::where('id', $id)->first();

            if (!$friendRequest) {
                return response()->json(['message' => 'Friend request not found'], 404);
            }

            $friendRequest->status = $request->status;
            $friendRequest->save();

            return response()->json(['message' => 'Friend request ' . $request->status . ' successfully']);
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function getRequests($uid) // lấy những lời mời kết bạn được gửi tới (chỉ lấy trạng thái pending)
    {
        $requests = FRequest::where('receiver_id', $uid)->where('status', 'pending')->get();
        return response()->json($requests);
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
}