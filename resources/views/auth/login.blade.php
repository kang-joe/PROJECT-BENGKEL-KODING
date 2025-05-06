{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | AdminLTE 3</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet"
        href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet"
        href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet"
        href="{{ asset('lte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan login untuk memulai sesi</p>

      <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
          <input type="email"
                 name="email"
                 class="form-control @error('email') is-invalid @enderror"
                 placeholder="Email"
                 value="{{ old('email') }}"
                 required
                 autofocus>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>
        @error('email')
          <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
          <input type="password"
                 name="password"
                 class="form-control @error('password') is-invalid @enderror"
                 placeholder="Password"
                 required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        @error('password')
          <div class="text-danger mb-2">{{ $message }}</div>
        @enderror

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">Remember Me</label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit"
                    class="btn btn-primary btn-block">
              Sign In
            </button>
          </div>
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('register') }}">Register a new membership</a>
      </p>
      <!-- Jika ada route lupa password, misalnya
      -->
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
