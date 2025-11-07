<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password; // add near other uses

// Add helper functions at top of file
function getStoredAppointments() {
    $path = 'appointments.json';
    if (!Storage::exists($path)) {
        Storage::put($path, '[]');
    }
    return collect(json_decode(Storage::get($path), true) ?? []);
}

function saveAppointments($appointments) {
    Storage::put('appointments.json', json_encode($appointments));
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ensure a proper named 'login' route exists that serves the Breeze login view.
// Only define it when no 'login' named route is already registered and the view exists.
if (! Route::has('login') && file_exists(resource_path('views/auth/login.blade.php'))) {
    Route::get('/login', function () {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    })->middleware('guest')->name('login');
}

// Guest routes (login page)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

// Forgot password: show form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Forgot password: send reset link
Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
        return back()->with('status', __($status));
    }

    return back()->withErrors(['email' => __($status)]);
})->name('password.email');

// Protected routes (require auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $appointments = getStoredAppointments()->map(function ($item, $id) {
            $data = $item;
            $data['id'] = $id;
            try {
                $data['preferred_date'] = Carbon::parse($data['preferred_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                $data['preferred_date'] = now()->format('Y-m-d');
            }
            return (object) $data;
        });
        
        return view('admin.dashboard', compact('appointments'));
    })->name('dashboard');
});

// Public routes
Route::get('/', function () {
    return view('index');
})->name('index');

Route::view('/about', 'about')->name('about');

// Changed: appointment GET route should be named 'appointment.form' to match views
Route::get('/appointment', function () {
    return view('appointment');
})->name('appointment.form');

// New: handle appointment submission (store in session as a simple demo, no DB)
Route::post('/appointment', function (Request $request) {
    $data = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:50',
        'area_of_concern' => 'required|string|max:1000',
        'preferred_doctor' => 'nullable|string|max:255',
        'preferred_date' => 'required|date',
        'reason_for_visit' => 'required|string|max:2000',
    ]);

    $id = uniqid('ap_');
    $appointments = getStoredAppointments();
    $appointments[$id] = $data;
    saveAppointments($appointments);

    return redirect()->route('appointment.form')->with([
        'success' => 'Your appointment request has been received.',
        'last_appointment_id' => $id,
    ]);
})->name('appointment.store');

// Update review route to use file storage
Route::get('/appointments/{id}', function ($id) {
    $appointments = getStoredAppointments();
    if (! isset($appointments[$id])) {
        abort(404, 'Appointment not found.');
    }
    $appointment = $appointments[$id];
    $appointment['id'] = $id;
    return view('appointments.review', [
        'appointment' => (object) $appointment,
        'id' => $id
    ]);
})->name('appointments.review');

// Update edit route to use file storage
Route::get('/appointments/{id}/edit', function ($id) {
    $appointments = getStoredAppointments();
    if (! isset($appointments[$id])) {
        abort(404, 'Appointment not found.');
    }

    $data = $appointments[$id];
    $data['id'] = $id;
    try {
        $data['preferred_date'] = Carbon::parse($data['preferred_date']);
    } catch (\Exception $e) {
        $data['preferred_date'] = Carbon::now();
    }

    return view('edit', ['appointment' => (object) $data]);
})->name('appointments.edit');

// New: update appointment (persist changes back to session)
Route::put('/appointments/{id}', function (Request $request, $id) {
    $data = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:50',
        'area_of_concern' => 'required|string|max:1000',
        'preferred_doctor' => 'nullable|string|max:255',
        'preferred_date' => 'required|date',
        'reason_for_visit' => 'required|string|max:2000',
    ]);

    $appointments = getStoredAppointments();
    if (! isset($appointments[$id])) {
        abort(404, 'Appointment not found.');
    }

    // store validated data (preferred_date as Y-m-d)
    $appointments[$id] = array_merge($appointments[$id], $data);
    saveAppointments($appointments);

    return redirect()->route('appointments.review', $id)->with('status', 'Appointment updated successfully.');
})->name('appointments.update');

// New: admin destroy route to support deleting session-stored appointments from the admin dashboard
Route::delete('/admin/appointments/{id}', function ($id) {
    $appointments = getStoredAppointments();
    if (isset($appointments[$id])) {
        unset($appointments[$id]);
        saveAppointments($appointments);
        return redirect()->route('dashboard')->with('success', 'Appointment deleted.');
    }
    return redirect()->route('dashboard')->with('success', 'Appointment not found.');
})->middleware(['auth'])->name('admin.destroy');

require __DIR__.'/auth.php';
