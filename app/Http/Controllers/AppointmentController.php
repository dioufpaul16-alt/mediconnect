<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    // Show booking form
    public function form()
    {
        return view('appointment');
    }

    // Store new appointment and save id to session so user can review it
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'area_of_concern' => 'required|string|max:255',
            'preferred_doctor' => 'required|string|max:255',
            'preferred_date' => 'required|date',
            'reason_for_visit' => 'required|string',
        ]);

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        $appointment = Appointment::create($data);

        // Save the last appointment id in session so the Review button is available
        session(['last_appointment_id' => $appointment->id]);

        // Flash a success message (appointment creation)
        return redirect()->route('appointment.form')->with('success', 'Appointment booked successfully.');
    }

    // Review (session-based) — reuse edit view but only allowed by session or owner
    public function review(Appointment $appointment, Request $request)
    {
        $allowed = false;

        if (Auth::check() && $appointment->user_id === Auth::id()) {
            $allowed = true;
        }

        if (session('last_appointment_id') == $appointment->id) {
            $allowed = true;
        }

        if (! $allowed) {
            abort(403);
        }

        return view('edit', compact('appointment'));
    }

    // Show edit form for authenticated user (optional)
    public function edit(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        return view('edit', compact('appointment'));
    }

    // Update appointment: validate, save, set session, redirect to fresh appointment form
    public function update(Request $request, Appointment $appointment)
    {
        $allowed = false;

        if (Auth::check() && $appointment->user_id === Auth::id()) {
            $allowed = true;
        }

        if (session('last_appointment_id') == $appointment->id) {
            $allowed = true;
        }

        if (! $allowed) {
            abort(403);
        }

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'area_of_concern' => 'required|string|max:255',
            'preferred_doctor' => 'required|string|max:255',
            'preferred_date' => 'required|date',
            'reason_for_visit' => 'required|string',
        ]);

        $appointment->update($data);

        // After editing we remove the session marker so the Review button will not reappear
        session()->forget('last_appointment_id');

        // Redirect to fresh appointment form with success message (which will fade)
        return redirect()->route('appointment.form')->with('success', 'Changes saved successfully.');
    }
}