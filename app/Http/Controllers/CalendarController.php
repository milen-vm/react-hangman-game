<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $reqest)
    {
        $appointments = Appointment::all();

        return view('calendar.index', compact('appointments'));
    }

    public function json()
    {
        $appointments = Appointment::all();

        return AppointmentResource::collection($appointments);
        // return response()->json($appointments);
    }

    public function create()
    {}

    public function store(AppointmentRequest $reqest)
    {
        Appointment::create($reqest->input());
    }

    public function edit(Appointment $appointment)
    {
        
    }

    public function update(AppointmentRequest $reqest, Appointment $appointment)
    {
        
    }

    public function destroy(Appointment $appointment)
    {

    }
}
