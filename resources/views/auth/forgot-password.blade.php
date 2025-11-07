<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password | MediConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* ...minimal styling matching login page ... */
    body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg,#f5f7fa,#e4edf5); min-height:100vh; display:flex; align-items:center; }
    .card { border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.08); }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center py-5">
      <div class="col-md-6 col-lg-5">
        <div class="card p-4">
          <div class="text-center mb-3">
            <h4>Forgot your password?</h4>
            <p class="text-muted mb-0">Enter your email and we'll send a password reset link.</p>
          </div>

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Send Reset Link</button>
              <a href="{{ route('login') }}" class="btn btn-link">Back to login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
