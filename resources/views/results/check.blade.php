<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: url('/images/bg-pattern.jpg') no-repeat center center/cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(8px);
      background-color: rgba(0,0,0,0.7);
    }

    .card-glass {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 32px rgba(0,0,0,0.4);
      border: 1px solid rgba(255,255,255,0.2);
      color: #fff;
      padding: 2rem;
    }

    .form-select, .form-control {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
      border: none;
    }

    .btn-navy {
      background-color: #1f4e8c;
      color: #fff;
      font-weight: 600;
      border-radius: 12px;
      transition: 0.3s;
    }
    .btn-navy:hover {
      background-color: #193f72;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(31, 78, 140, 0.4);
    }

    .instructions {
      font-size: 0.95rem;
      color: #f1f1f1;
    }

    .logo {
      max-width: 180px;
      margin-bottom: 1.5rem;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center align-items-center">

      <!-- Left: Logo + Instructions -->
      <div class="col-md-5 mb-4">
        <div class="card-glass text-center p-4">
          <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
          <div class="instructions text-start mt-3">
            <h5 class="fw-bold text-navy">Instructions</h5>
            <ul>
              <li>Kindly select your Current Class</li>
              <li>Select your Current Classarm</li>
              <li>Select the Session you want to check</li>
              <li>Select the Term you want to check</li>
              <li>Enter Result pin, then click Continue</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Right: Form -->
      <div class="col-md-5">
        <div class="card-glass">
          <h3 class="fw-bold mb-4 text-center">Check Result</h3>

          <form method="POST" action="{{ route('results.check') }}">
            <x-alerts />
            @csrf
            <div class="mb-3">
              <select class="form-select" id="class" name="class_id" required>
                <option value="">Class</option>
                @foreach($classes as $class)
                  <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <select class="form-select" name="classarm_id"  id="classarm" required>
                <option value="">Classarm</option>
              </select>
            </div>

            <div class="mb-3">
              <select class="form-select" name="session_id" required>
                <option value="">Session</option>
                @foreach($sessions as $session)
                  <option value="{{ $session->id }}">{{ $session->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <select class="form-select" name="term" required>
                <option value="">Term</option>
                <option value="1">1st Term</option>
                <option value="2">2nd Term</option>
                <option value="3">3rd Term</option>
              </select>
            </div>

            <div class="mb-3">
              <input type="text" class="form-control" name="pin" placeholder="Scratch Card Pin" required>
            </div>

            <button type="submit" class="btn btn-navy w-100">Continue</button>
          </form>
        </div>
      </div>
    </div>
  </div>

   @include('layouts.partials.class-arm')
</body>
</html>
