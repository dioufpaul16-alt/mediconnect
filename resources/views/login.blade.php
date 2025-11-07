<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | MediConnect</title>
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
    
    .login-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 0;
    }
    
    .login-card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: all 0.4s ease;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      position: relative;
    }
    
    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .login-card:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
    }
    
    .card-header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      text-align: center;
      padding: 2rem;
      border-bottom: none;
    }
    
    .card-header h4 {
      margin: 0;
      font-weight: 600;
      font-size: 1.5rem;
    }
    
    .card-body {
      padding: 2.5rem;
    }
    
    .form-label {
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }
    
    .form-control {
      border-radius: 10px;
      padding: 0.75rem 1rem;
      border: 1px solid #e3ebf6;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.2rem rgba(46, 134, 171, 0.25);
    }
    
    .input-group-text {
      background-color: #f8f9fa;
      border: 1px solid #e3ebf6;
      border-right: none;
    }
    
    .password-toggle {
      cursor: pointer;
      background-color: #f8f9fa;
      border: 1px solid #e3ebf6;
      border-left: none;
    }
    
    .btn-login {
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
    
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(46, 134, 171, 0.4);
    }
    
    .btn-login:after {
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
    
    .btn-login:hover:after {
      opacity: 1;
    }
    
    .login-footer {
      text-align: center;
      margin-top: 1.5rem;
      color: var(--secondary);
    }
    
    .login-footer a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .login-footer a:hover {
      color: var(--secondary);
    }
    
    .security-notice {
      background-color: #f0f7ff;
      border-radius: 10px;
      padding: 1rem;
      margin-top: 1.5rem;
      border-left: 4px solid var(--primary);
    }
    
    .security-notice i {
      color: var(--primary);
      margin-right: 0.5rem;
    }
    
    footer {
      margin-top: auto;
      background-color: white;
      box-shadow: 0 -1px 15px rgba(0, 0, 0, 0.04);
      padding: 15px 0;
    }
    
    .biometric-option {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 1rem;
      padding: 0.75rem;
      border: 1px dashed #d1d7e0;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .biometric-option:hover {
      background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
      border-color: var(--primary);
      transform: translateY(-2px);
    }
    
    .biometric-option i {
      margin-right: 0.5rem;
      color: var(--primary);
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
    
    /* Admin features section */
    .admin-features {
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid #eaeaea;
    }
    
    .feature-item {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
      padding: 0.75rem;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .feature-item:hover {
      background-color: #f8f9fa;
    }
    
    .feature-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: white;
    }
    
    /* Responsive adjustments */
    @media (max-width: 576px) {
      .login-card {
        margin: 1rem;
      }
      
      .card-body {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <i class="fas fa-heartbeat me-2"></i>MediConnect Clinic
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('appointment.form') }}">Appointment</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('login') }}">Admin</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="login-container">
    <div class="card login-card mx-auto" style="max-width:450px;">
      <div class="card-header">
        <h4><i class="fas fa-lock me-2"></i>Admin Portal</h4>
        <p class="mb-0 mt-2 opacity-75">Secure access to clinic management system</p>
      </div>
      <div class="card-body">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}" id="loginForm">
          @csrf
          <div class="mb-3 form-group">
            <label class="form-label">Email Address</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                     value="{{ old('email') }}" placeholder="admin@mediconnect.com" required>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="mb-3 form-group">
            <label class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                     id="password" placeholder="Enter your password" required>
              <span class="input-group-text password-toggle" id="togglePassword">
                <i class="fas fa-eye"></i>
              </span>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <button type="submit" class="btn btn-primary btn-login w-100 mb-3">
            <i class="fas fa-sign-in-alt me-2"></i>Login to Dashboard
          </button>
          
          <div class="biometric-option">
            <i class="fas fa-fingerprint"></i>
            <span>Login with Biometrics</span>
          </div>
        </form>
        
        <div class="login-footer">
          <a href="forgot-password.html">Forgot your password?</a>
        </div>
        
        <div class="admin-features">
          <h6 class="text-center mb-3" style="color: var(--dark);">Admin Features</h6>
          <div class="feature-item">
            <div class="feature-icon">
              <i class="fas fa-user-md"></i>
            </div>
            <div>
              <h6 class="mb-0">Doctor Management</h6>
              <small class="text-muted">Manage schedules and profiles</small>
            </div>
          </div>
          <div class="feature-item">
            <div class="feature-icon">
              <i class="fas fa-calendar-check"></i>
            </div>
            <div>
              <h6 class="mb-0">Appointment Tracking</h6>
              <small class="text-muted">View and manage appointments</small>
            </div>
          </div>
          <div class="feature-item">
            <div class="feature-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <div>
              <h6 class="mb-0">Analytics & Reports</h6>
              <small class="text-muted">Clinic performance insights</small>
            </div>
          </div>
        </div>
        
        <div class="security-notice">
          <p class="mb-0 small">
            <i class="fas fa-shield-alt"></i>
            For security reasons, please log out after completing your administrative tasks.
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <footer class="text-center">
    <p class="mb-0">&copy; 2025 MediConnect Clinic. All rights reserved.</p>
  </footer>

  {{-- Diagnostics (visible only when APP_DEBUG=true) --}}
  @if(config('app.debug'))
    @php
      $diag = [
        'php_version' => phpversion(),
        'laravel_env' => config('app.env'),
        'db_connected' => false,
        'users_table' => false,
        'admin_exists' => false,
        'admin_email' => 'admin@admin.com',
      ];
      try {
          \Illuminate\Support\Facades\DB::connection()->getPdo();
          $diag['db_connected'] = true;
      } catch (\Exception $e) {
          $diag['db_connected'] = false;
      }
      $diag['users_table'] = \Illuminate\Support\Facades\Schema::hasTable('users');
      $diag['admin_exists'] = $diag['users_table'] ? \App\Models\User::where('email', $diag['admin_email'])->exists() : false;
    @endphp

    <div class="container mt-3">
      <div class="alert alert-info">
        <strong>Diagnostics</strong>
        <ul class="mb-0">
          <li>PHP: {{ $diag['php_version'] }} — App env: {{ $diag['laravel_env'] }}</li>
          <li>DB connection: {{ $diag['db_connected'] ? 'OK' : 'FAILED' }}</li>
          <li>Users table: {{ $diag['users_table'] ? 'present' : 'missing' }}</li>
          <li>Admin user ({{ $diag['admin_email'] }}): {{ $diag['admin_exists'] ? 'found' : 'not found' }}</li>
        </ul>
      </div>
    </div>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Password visibility toggle
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
    
    // Form submission loading state
    document.getElementById('loginForm').addEventListener('submit', function() {
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Authenticating...';
      submitBtn.disabled = true;
    });
    
    // Biometric authentication simulation
    document.querySelector('.biometric-option').addEventListener('click', function() {
      const biometricBtn = this;
      const originalText = biometricBtn.innerHTML;
      
      biometricBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Scanning...';
      
      setTimeout(function() {
        biometricBtn.innerHTML = originalText;
        alert('Biometric authentication would be triggered here in a real application.');
      }, 1500);
    });
  </script>
</body>
</html>