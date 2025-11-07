<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | MediConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            border: none;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .table thead {
            background: var(--primary);
            color: white;
        }
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}">
                <i class="fas fa-heartbeat me-2"></i>MediConnect Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
            <div class="notification alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="stats-card p-4">
                    <h6 class="text-muted">Total Appointments</h6>
                    <h3 class="mb-0">{{ $appointments->count() }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card p-4">
                    <h6 class="text-muted">Today's Appointments</h6>
                    <h3 class="mb-0">{{ $appointments->where('preferred_date', now()->format('Y-m-d'))->count() }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card p-4">
                    <h6 class="text-muted">Pending Appointments</h6>
                    <h3 class="mb-0">{{ $appointments->where('preferred_date', '>=', now()->format('Y-m-d'))->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Recent Appointments</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->full_name }}</td>
                                    <td>{{ $appointment->preferred_date }}</td>
                                    <td>{{ $appointment->preferred_doctor }}</td>
                                    <td>
                                        @if($appointment->preferred_date < now()->format('Y-m-d'))
                                            <span class="badge bg-secondary">Completed</span>
                                        @elseif($appointment->preferred_date == now()->format('Y-m-d'))
                                            <span class="badge bg-success">Today</span>
                                        @else
                                            <span class="badge bg-primary">Upcoming</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this appointment?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No appointments found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide notifications after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const notifications = document.querySelectorAll('.notification');
                notifications.forEach(notification => {
                    const alert = bootstrap.Alert.getInstance(notification);
                    if (alert) {
                        alert.close();
                    }
                });
            }, 3000);
        });
    </script>
</body>
</html>
