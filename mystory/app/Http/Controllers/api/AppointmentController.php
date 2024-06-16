<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function appointments(){
        $appointmentsAsDater = Auth::user()->appointmentsAsDater;
        $appointmentsAsDateee = Auth::user()->appointmentsAsDateee;

        return response()->json(["from_me" => $appointmentsAsDater, "to_me"=>$appointmentsAsDateee], 201);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dater_id' => 'required|exists:users,id',
            'dateee_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'des' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $appointment = Appointment::create($request->all());

        return response()->json($appointment, 201);
    }

    
    public function show($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json($appointment, 200);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dater_id' => 'required|exists:users,id',
            'dateee_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'des' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->update($request->all());

        return response()->json($appointment, 200);
    }

    public function delete($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully'], 200);
    }
}
