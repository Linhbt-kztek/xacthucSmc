<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/libout/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('backend/libout/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/AdminLTE.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('backend/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo"><img src="{{asset('icon/logo.png')}}" alt=""></a></div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if(\Session::has('msg_changePass'))
    <p class="login-box-msg btn-success" style="padding-top: 20px;">{{\Session::get('msg_changePass')}}</p>
    @else
    <p class="login-box-msg">Vui lòng nhập Mã sinh viên và Email mà bạn đã đăng ký!</p>
    <p style="color: #f00">
      {{$errors->first()}}
    </p> 
    <form action="{{route('backend.site.pResetPass')}}" method="post">
      <div class="form-group has-feedback {{$errors->has('idmsv') ? 'has-error' : ''}}">
        <input type="text" name="idmsv" class="form-control" placeholder="Mã sinh viên">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block">{{$errors->first('idmsv')}}</span>
      </div>
      <div class="form-group has-feedback {{$errors->has('email') ? 'has-error' : ''}}">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="help-block">{{$errors->first('email')}}</span>
      </div>      
      <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Xác nhận</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    @endif
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('backend/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

</body>
</html>
