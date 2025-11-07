<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointment::orderBy('preferred_date', 'desc')->get();
        return view('dashboard', compact('appointments'));
    }
}
