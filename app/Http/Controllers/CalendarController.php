<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;

class CalendarController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
dd($appointments[0]->starts_at);
        return view('calendar.index', compact('appointments'));
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
