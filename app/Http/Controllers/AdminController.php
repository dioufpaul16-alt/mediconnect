<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function edit(Appointment $appointment)
    {
        return view('admin.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date',
            'preferred_doctor' => 'required|string|max:255',
            'area_of_concern' => 'required|string|max:255',
            'reason_for_visit' => 'required|string'
        ]);

        $appointment->update($validated);

        return redirect()->route('dashboard')->with('success', 'Appointment updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        
        return redirect()->route('dashboard')->with('success', 'Appointment deleted successfully');
    }
}
