<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Silahkan Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE//dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('/adminLTE/plugins/toastr/toastr.min.css')}}">
</head>

<body class="hold-transition login-page">

<div class="login-box">

<!-- validasai data error-->
        @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
          <ul>
        @foreach($errors->all() as $error)
        <li> {{$error}} </li>
        @endforeach
        </ul>
        </div>
        @endif

     @if(\Session::has('berhasil'))
    <div class="alert alert-success" role="alert">
    {{ session::get('berhasil')}}
        </div>
    @endif

    @if(\Session::has('gagal'))
    <div class="alert alert-danger" role="alert">
    {{ session::get('gagal')}}
        </div>
    @endif

  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1">Pengadaan<b>App<b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan Login Sebagai Admin</p>

      <form action="/loginadmin" method="post">
      {{csrf_field()}}
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
<script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('/adminLTE/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript">
$(document).on("click",".konfirmasi",function(event){
  event.preventDefault();
  const url = $(this).attr('href');
  var answer = window.confirm("Yakin memproses data data?");

if(answer){
  window.location.href = url;
}else{

}


});

$(function() {
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

@if(\Session::has('berhasil'))
  Toast.fire({
      icon: 'success',
      title: '{{Session::get('berhasil')}}'
    })
@endif
@if(\Session::has('gagal'))
  Toast.fire({
      icon: 'error',
      title: '{{Session::get('gagal')}}'
    })
@endif

@if(count($errors) > 0)

Toast.fire({
       icon: 'error',
       title: '<ul>@foreach($errors->all() as $error)<li>{{$error}}</li> @endforeach</ul>'
     })

@endif
  </script>

</body>
</html>
