<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment | MediConnect</title>

    <!-- Match other pages' assets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2E86AB;
            --primary-dark: #1B6B93;
            --secondary: #A23B72;
            --light: #F8F9FA;
            --dark: #1D3557;
            --accent: #F18F01;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
        }
        
        .nav-link {
            font-weight: 500;
            margin: 0 10px;
            color: var(--dark) !important;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            left: 0;
            bottom: 0;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after, .nav-link.active:after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
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
               
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Edit Appointment</h2>

    @if(!isset($appointment))
        <div class="alert alert-danger mx-auto" style="max-width:600px;">
            Invalid appointment or unauthorized access. Please return to the appointments page.
            <div class="mt-3">
                <a href="{{ route('appointment.form') }}" class="btn btn-primary">Back to Appointments</a>
            </div>
        </div>
    @else
        @if(session('status'))
            <div id="edit-status" class="alert alert-success mx-auto" style="max-width:600px;">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mx-auto" style="max-width: 600px;" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="p-4 bg-white shadow rounded mx-auto" style="max-width: 600px;">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $appointment->full_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $appointment->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="tel" name="phone" class="form-control" value="{{ old('phone', $appointment->phone) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Area of Concern</label>
                <input type="text" name="area_of_concern" class="form-control" value="{{ old('area_of_concern', $appointment->area_of_concern) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Preferred Doctor</label>
                <input type="text" name="preferred_doctor" class="form-control" value="{{ old('preferred_doctor', $appointment->preferred_doctor) }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Preferred Date</label>
                <input type="date" name="preferred_date" class="form-control" value="{{ old('preferred_date', $appointment->preferred_date->format('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Reason for Visit</label>
                <textarea name="reason_for_visit" class="form-control" rows="3" required>{{ old('reason_for_visit', $appointment->reason_for_visit) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">Update Appointment</button>
                <a href="{{ route('appointment.form') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    @endif
</div>

<footer class="text-center py-3 bg-white shadow-sm mt-5">
    <p class="mb-0">&copy; 2025 MediConnect Clinic</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Optional: fade any messages shown on this page
    document.addEventListener('DOMContentLoaded', function() {
        const el = document.getElementById('edit-status');
        if (el) {
            setTimeout(() => {
                el.classList.add('fade-out');
                setTimeout(() => el.remove(), 1000);
            }, 10000);
        }
    });
</script>
</body>
</html>