<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediConnect Clinic | Modern Healthcare</title>
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
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
            transition: all 0.3s ease;
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
        
        .hero {
            background: linear-gradient(135deg, rgba(46, 134, 171, 0.85), rgba(162, 59, 114, 0.75)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80') center/cover no-repeat;
            height: 85vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(transparent, #f8f9fa);
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 14px 35px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 134, 171, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(46, 134, 171, 0.4);
        }
        
        .btn-primary:after {
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
        
        .btn-primary:hover:after {
            opacity: 1;
        }
        
        .services {
            padding: 100px 0;
            background-color: #fff;
        }
        
        .services h2 {
            text-align: center;
            color: var(--dark);
            margin-bottom: 60px;
            font-weight: 700;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .services h2:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            margin: 15px auto;
            border-radius: 2px;
        }
        
        .service-card {
            border: none;
            border-radius: 15px;
            transition: all 0.4s ease;
            height: 100%;
            padding: 40px 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: #fff;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .service-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
            z-index: 2;
        }
        
        .service-card:hover:before {
            transform: scaleX(1);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        .service-icon {
            font-size: 3.5rem;
            margin-bottom: 25px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        
        .service-card h5 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .service-card p {
            color: #666;
        }
        
        .footer {
            background: linear-gradient(135deg, var(--dark), #0f1f38);
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        
        .footer p {
            margin: 0;
            font-size: 0.95rem;
        }
        
        /* Animation for elements */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease forwards;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero {
                height: 70vh;
            }
            
            .service-card {
                margin-bottom: 25px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <i class="fas fa-heartbeat me-2"></i>MediConnect Clinic
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointment.form') }}">Appointment</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container animate-fadeInUp">
        <h1>Welcome to MediConnect Clinic</h1>
        <p>Modern, reliable, and compassionate healthcare at your fingertips. Experience the future of medical care with our state-of-the-art facilities and expert team.</p>
        <a href="{{ route('appointment.form') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-calendar-check me-2"></i>Book Appointment
        </a>
    </div>
</section>

<section class="services container">
    <h2>Our Services</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="service-card animate-fadeInUp" style="animation-delay: 0.1s">
                <div class="service-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h5 class="fw-bold">General Consultation</h5>
                <p>Get professional medical advice and personalized care from our experienced doctors.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="service-card animate-fadeInUp" style="animation-delay: 0.2s">
                <div class="service-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h5 class="fw-bold">Specialist Clinics</h5>
                <p>We offer access to specialists in pediatrics, gynecology, cardiology, and more.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="service-card animate-fadeInUp" style="animation-delay: 0.3s">
                <div class="service-icon">
                    <i class="fas fa-vial"></i>
                </div>
                <h5 class="fw-bold">Lab Testing</h5>
                <p>Accurate and timely diagnostic services with modern equipment and technology.</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2025 MediConnect Clinic | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add scroll animation for elements
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.animate-fadeInUp');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        animatedElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.98)';
                document.querySelector('.navbar').style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
            } else {
                document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.95)';
                document.querySelector('.navbar').style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.08)';
            }
        });
    });
</script>
</body>
</html>