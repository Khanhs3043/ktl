<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FRequest;
use App\Models\Friend;
class FRequestController extends Controller
{
    public function sendRequest(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
        ]);

        // Kiểm tra xem đã gửi yêu cầu trước đó chưa
        $existingRequest = FRequest::where('sender_id', $request->sender_id)
                                         ->where('receiver_id', $request->receiver_id)
                                         ->first();

        if ($existingRequest) {
            return response()->json(['message' => 'Friend request already sent'], 409);
        }

        // Tạo mới yêu cầu kết bạn
        $friendRequest = new FRequest();
        $friendRequest->sender_id = $request->sender_id;
        $friendRequest->receiver_id = $request->receiver_id;
        $friendRequest->status = 'pending';
        $friendRequest->save();

        return response()->json(['message' => 'Friend request sent successfully'], 201);
    }

    public function respondRequest(Request $request)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);
        $uid = $request->input('sender_id');
        $friendid = $request->input('receiver_id');
        $friendRequest = FRequest::where('receiver_id', $friendid)->where('sender_id', $uid)->first();

        if (!$friendRequest) {
            return response()->json(['message' => 'Friend request not found'], 404);
        }

        $friendRequest->status = $request->status;
        $friendRequest->save();

        return response()->json(['message' => 'Friend request ' . $request->status . ' successfully']);
    }

    public function getRequests($uid) // lấy những lời mời kết bạn được gửi tới 
    {
        $requests = FRequest::where('receiver_id', $uid)->where('status', 'pending')->get();
        return response()->json($requests);
    }
}