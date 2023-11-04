<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMPUH | Masuk</title>

  <link href="{{ asset('favicon.png') }}" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/backend_template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/backend_template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/backend_template/dist/css/adminlte.min.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="hold-transition login-page">
  @if(Session::has('danger'))
  <div class="alert alert-danger">
    {{Session::get('danger')}}
  </div>
  @endif
  <form class="" action="{{URL::full()}}" method="post">
  @csrf
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <span class="h2"><b>SIMPUH </b><p class="text-xs">Sistem Informasi Monitoring Program Unggulan Daerah</p></span>
    </div>
    <div class="card-body">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row d-flex p-2">
          <div class="col-12 mb-2">
            <div class="g-recaptcha" data-sitekey="6LfJFKIjAAAAAEOwpinOX9kog59Y_H5bIciuICd2"></div>
          </div>
          <!-- /.col -->
          <br>
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" placeholder="Enter your Password">MASUK</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/backend_template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/backend_template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/backend_template/dist/js/adminlte.min.js"></script>
</body>
</html>