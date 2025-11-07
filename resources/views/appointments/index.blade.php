<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointments | MediConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('index') }}">MediConnect Clinic</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointment.form') }}">Appointment</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display: inline; border: none; background: none;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h3 class="mb-4">Your Appointments</h3>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($appointments->isEmpty())
        <p>No appointments found.</p>
    @else
        <div class="list-group">
            @foreach($appointments as $appointment)
                <div class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <strong>{{ $appointment->full_name }}</strong><br>
                        <small class="text-muted">{{ $appointment->preferred_date->format('Y-m-d') }} — {{ $appointment->preferred_doctor }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <!-- Add other user actions if needed -->
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<footer class="text-center py-3 bg-white shadow-sm mt-5">
    <p class="mb-0">&copy; 2025 MediConnect Clinic</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>