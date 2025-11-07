<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Book Appointment — MediConnect Clinic</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
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
    
    .page-header {
        background: linear-gradient(135deg, rgba(46, 134, 171, 0.85), rgba(162, 59, 114, 0.75)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80') center/cover no-repeat;
        padding: 80px 0 60px;
        color: white;
        text-align: center;
        margin-bottom: 40px;
    }
    
    .page-header h2 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    }
    
    .page-header p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.9;
    }
    
    .appointment-form {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        margin-bottom: 40px;
        position: relative;
        transition: all 0.4s ease;
    }
    
    .appointment-form:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .appointment-form:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 16px 16px 0 0;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e3ebf6;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(46, 134, 171, 0.25);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
        border-radius: 10px;
        padding: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(46, 134, 171, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(46, 134, 171, 0.4);
    }
    
    .btn-submit:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }
    
    .btn-submit:hover:after {
        opacity: 1;
    }
    
    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f1b0b7);
        color: #721c24;
    }
    
    footer {
        margin-top: auto;
        background-color: white;
        box-shadow: 0 -1px 15px rgba(0, 0, 0, 0.04);
        padding: 20px 0;
    }
    
    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eaeaea;
    }
    
    .form-section:last-of-type {
        border-bottom: none;
    }
    
    .section-title {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        bottom: -8px;
        left: 0;
        border-radius: 2px;
    }
    
    .info-box {
        background: #f0f7ff;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary);
    }
    
    .info-box i {
        color: var(--primary);
        margin-right: 0.5rem;
    }
    
    /* Animation for form elements */
    .form-group {
        animation: fadeInUp 0.5s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Fade helper */
    .fade-out {
        transition: opacity 1s ease, max-height 1s ease;
        opacity: 0;
        max-height: 0;
        overflow: hidden;
    }

    .auto-fade {
        transition: opacity 1s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header {
            padding: 60px 0 40px;
        }
        
        .page-header h2 {
            font-size: 2rem;
        }
        
        .appointment-form {
            padding: 1.5rem;
        }
    }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <i class="fas fa-heartbeat me-2"></i>MediConnect Clinic
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('appointment.form') }}">Appointment</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <h2>Book an Appointment</h2>
        <p>Schedule your visit with our healthcare professionals</p>
    </div>
</div>

<div class="container py-3">
    @if(session('success'))
        <div id="status-alert" class="alert alert-success alert-dismissible fade show mx-auto auto-fade" style="max-width: 700px;" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            @if(session('last_appointment_id'))
                <div class="mt-2">
                    <a id="review-btn" href="{{ route('appointments.review', session('last_appointment_id')) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye"></i> Review / Edit Submission
                    </a>
                </div>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mx-auto" style="max-width: 700px;" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="info-box mx-auto" style="max-width: 700px;">
        <p class="mb-0"><i class="fas fa-info-circle"></i>Please fill out the form below to schedule your appointment. Our team will contact you to confirm your booking.</p>
    </div>

    <form action="{{ route('appointment.store') }}" method="POST" class="appointment-form mx-auto" style="max-width: 700px;">
        @csrf
        
        <div class="form-section">
            <h4 class="section-title">Personal Information</h4>
            
            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Enter your name" value="{{ old('full_name') }}" required>
                </div>

                <div class="col-md-6 mb-3 form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="mb-3 form-group">
                <label class="form-label">Phone</label>
                <input type="tel" name="phone" class="form-control" placeholder="+256 740 559650" value="{{ old('phone') }}" required>
            </div>
        </div>
        
        <div class="form-section">
            <h4 class="section-title">Appointment Details</h4>
            
            <div class="mb-3 form-group">
                <label class="form-label">Area of Concern</label>
                <input type="text" name="area_of_concern" class="form-control" placeholder="Describe your symptoms" value="{{ old('area_of_concern') }}" required>
            </div>

            <div class="mb-3 form-group">
                <label class="form-label">Preferred Doctor</label>
                <select name="preferred_doctor" class="form-select" required>
                    <option value="">Select a doctor</option>
                    <option value="Dr. Smith" {{ old('preferred_doctor') == 'Dr. Smith' ? 'selected' : '' }}>Dr. Smith - General Physician</option>
                    <option value="Dr. Johnson" {{ old('preferred_doctor') == 'Dr. Johnson' ? 'selected' : '' }}>Dr. Johnson - Cardiologist</option>
                    <option value="Dr. Williams" {{ old('preferred_doctor') == 'Dr. Williams' ? 'selected' : '' }}>Dr. Williams - Pediatrician</option>
                    <option value="Dr. Brown" {{ old('preferred_doctor') == 'Dr. Brown' ? 'selected' : '' }}>Dr. Brown - Dermatologist</option>
                    <option value="Any Available" {{ old('preferred_doctor') == 'Any Available' ? 'selected' : '' }}>Any Available Doctor</option>
                </select>
            </div>
            
            <div class="mb-3 form-group">
                <label class="form-label">Preferred Date</label>
                <input type="date" name="preferred_date" class="form-control" value="{{ old('preferred_date') }}" required>
            </div>

            <div class="mb-3 form-group">
                <label class="form-label">Reason for Visit</label>
                <textarea name="reason_for_visit" class="form-control" rows="3" placeholder="Describe your symptoms or reason for visit" required>{{ old('reason_for_visit') }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-submit w-100">
            <i class="fas fa-calendar-check me-2"></i>Submit Appointment Request
        </button>
    </form>
</div>

<footer class="text-center">
    <p class="mb-0">&copy; 2025 MediConnect Clinic | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date to today for the date picker
        const dateInput = document.querySelector('input[name="preferred_date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
        
        // Add animation to form elements on scroll
        const formGroups = document.querySelectorAll('.form-group');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        formGroups.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

        // Auto-fade the review-alert after 10 seconds (if present and not clicked)
        const REVIEW_TIMEOUT = 10000; // 10s
        const reviewAlert = document.getElementById('review-alert');
        const reviewBtn = document.getElementById('review-btn');

        if (reviewAlert) {
            // If user clicks review before timeout, do nothing special (navigation happens)
            let clicked = false;
            if (reviewBtn) {
                reviewBtn.addEventListener('click', function() {
                    clicked = true;
                });
            }

            setTimeout(() => {
                if (!clicked) {
                    // fade then remove after transition
                    reviewAlert.classList.add('fade-out');
                    setTimeout(() => {
                        if (reviewAlert.parentNode) reviewAlert.parentNode.removeChild(reviewAlert);
                    }, 1000);
                }
            }, REVIEW_TIMEOUT);
        }

        // Auto-fade any status/success alerts after 10 seconds
        const statusAlert = document.getElementById('status-alert');
        if (statusAlert) {
            setTimeout(() => {
                statusAlert.classList.add('fade-out');
                setTimeout(() => {
                    if (statusAlert.parentNode) statusAlert.parentNode.removeChild(statusAlert);
                }, 1000);
            }, REVIEW_TIMEOUT);
        }
    });
</script>
</body>
</html>