<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Review Appointment — MediConnect Clinic</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h1>Review Appointment</h1>

    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">Appointment ID: {{ $id }}</h5>
        <p><strong>Name:</strong> {{ $appointment->full_name }}</p>
        <p><strong>Email:</strong> {{ $appointment->email }}</p>
        <p><strong>Phone:</strong> {{ $appointment->phone }}</p>
        <p><strong>Area of Concern:</strong> {{ $appointment->area_of_concern }}</p>
        <p><strong>Preferred Doctor:</strong> {{ $appointment->preferred_doctor }}</p>
        <p><strong>Preferred Date:</strong> {{ $appointment->preferred_date }}</p>
        <p><strong>Reason for Visit:</strong> {{ $appointment->reason_for_visit }}</p>
      </div>
    </div>

    <div class="mb-3">
      <a href="{{ route('appointments.edit', $id) }}" class="btn btn-primary me-2">
        <i class="fas fa-edit me-1"></i> Edit
      </a>

      <a href="{{ route('appointment.form') }}" class="btn btn-secondary">Back to Appointment</a>
      <a href="{{ route('index') }}" class="btn btn-link">Home</a>
    </div>
  </div>
</body>
</html>
