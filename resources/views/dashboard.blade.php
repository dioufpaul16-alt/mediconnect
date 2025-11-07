<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard (deprecated)</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h1>Deprecated dashboard view</h1>
    <p>This view was replaced. The admin dashboard now lives at <code>resources/views/admin/dashboard.blade.php</code>.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Open Admin Dashboard</a>
    <a href="{{ route('index') }}" class="btn btn-link">Home</a>
  </div>
</body>
</html>
