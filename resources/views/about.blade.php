<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | MediConnect Clinic</title>
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
        
        .about-header {
            background: linear-gradient(135deg, rgba(46, 134, 171, 0.85), rgba(162, 59, 114, 0.75)), url('https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat;
            color: white;
            padding: 100px 0 80px;
            text-align: center;
            position: relative;
        }
        
        .about-header h1 {
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
        }
        
        .about-header p {
            font-size: 1.3rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }
        
        .about-section {
            padding: 80px 0;
        }
        
        .about-section h2 {
            color: var(--dark);
            margin-bottom: 30px;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }
        
        .about-section h2:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            margin: 15px 0;
            border-radius: 2px;
        }
        
        .about-section p {
            color: #555;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        
        .about-image {
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }
        
        .about-image:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .mission-vision {
            background: linear-gradient(135deg, rgba(46, 134, 171, 0.05), rgba(162, 59, 114, 0.05));
            padding: 80px 0;
        }
        
        .mission-card, .vision-card {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .mission-card:before, .vision-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        
        .mission-card:hover, .vision-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .mission-icon, .vision-icon {
            font-size: 3rem;
            margin-bottom: 25px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .mission-card h3, .vision-card h3 {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .contact-info {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .contact-info:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        
        .contact-info h4 {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
        }
        
        .contact-info h4:after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            margin: 10px 0;
            border-radius: 2px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .contact-item:hover {
            background-color: #f8f9fa;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
        }
        
        footer {
            margin-top: auto;
            background: linear-gradient(135deg, var(--dark), #0f1f38);
            color: #fff;
            padding: 20px 0;
            text-align: center;
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
            .about-header h1 {
                font-size: 2.5rem;
            }
            
            .about-header {
                padding: 80px 0 60px;
            }
            
            .about-section, .mission-vision {
                padding: 60px 0;
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
                <li class="nav-item"><a class="nav-link active" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointment.form') }}">Appointment</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<header class="about-header">
    <div class="container animate-fadeInUp">
        <h1>About MediConnect Clinic</h1>
        <p>Your trusted partner in modern healthcare solutions</p>
    </div>
</header>

<section class="about-section container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="animate-fadeInUp">Who We Are</h2>
            <p class="animate-fadeInUp" style="animation-delay: 0.1s">MediConnect Clinic is a digital-first medical center that bridges the gap between technology and patient care. We provide high-quality healthcare services, powered by innovation and compassion.</p>
            <p class="animate-fadeInUp" style="animation-delay: 0.2s">Our dedicated team of professionals ensures that every patient receives prompt, personalized, and confidential care from the comfort of their home or in-person at our facility.</p>
            <p class="animate-fadeInUp" style="animation-delay: 0.3s">We are redefining healthcare accessibility by allowing patients to book appointments, consult specialists, and receive updates all through a secure online system.</p>
            <p class="animate-fadeInUp" style="animation-delay: 0.4s">Our mission is to make healthcare management simple, efficient, and affordable for individuals, families, and organizations. We value trust, transparency, and technological excellence.</p>
            <p class="animate-fadeInUp" style="animation-delay: 0.5s">Through MediConnect, we aim to build a healthier community where quality healthcare is within everyone's reach — fast, reliable, and secure.</p>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80" alt="MediConnect Clinic" class="img-fluid about-image animate-fadeInUp" style="animation-delay: 0.3s">
        </div>
    </div>
</section>

<section class="mission-vision">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="mission-card animate-fadeInUp" style="animation-delay: 0.2s">
                    <div class="mission-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>To make healthcare management simple, efficient, and affordable for individuals, families, and organizations through innovative digital solutions and compassionate care.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="vision-card animate-fadeInUp" style="animation-delay: 0.4s">
                    <div class="vision-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>To build a healthier community where quality healthcare is within everyone's reach — fast, reliable, and secure through the power of technology and medical excellence.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="contact-info animate-fadeInUp" style="animation-delay: 0.6s">
        <h4>Contact Information</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Email</h5>
                        <p class="mb-0">info@mediconnect.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Phone</h5>
                        <p class="mb-0">+256 700 000 800</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Address</h5>
                        <p class="mb-0">Plot 10 Kampala Road, Kampala, Uganda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-center">
    <p class="mb-0">&copy; 2025 MediConnect Clinic | All Rights Reserved</p>
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
        
        // Navbar background on scroll
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