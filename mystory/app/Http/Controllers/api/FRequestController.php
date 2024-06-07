<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FRequest;

class FRequestController extends Controller
{
    public function sendRequest(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $friendRequest = FRequest::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Friend request sent successfully', 'data' => $friendRequest], 201);
    }

    public function respondRequest(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $friendRequest = FRequest::where('receiver_id', auth()->id())->where('id', $id)->first();

        if (!$friendRequest) {
            return response()->json(['message' => 'Friend request not found'], 404);
        }

        $friendRequest->status = $request->status;
        $friendRequest->save();

        return response()->json(['message' => 'Friend request ' . $request->status . ' successfully']);
    }

    public function getRequests()
    {
        $requests = FRequest::where('receiver_id', auth()->id())->where('status', 'pending')->get();
        return response()->json($requests);
    }
}