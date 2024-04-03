<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(asset('backend/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('backend/libout/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('backend/libout/css/ionicons.min.css')); ?>">
  <!-- Theme style -->
  
  <!-- iCheck -->
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Latest compiled and minified CSS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js" integrity="sha512-rXm6RiYDlz+aZC/ht75tGzeAmCg4gVfBA6Be5s5uENSahiXkgwEy10J2Cc+dxUAW4lRRQYbS5pugMOqBrs8ksw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.dark.min.css" integrity="sha512-C/Z74U+ioSrVHIrPuUqKIG9HmaV5Ut9QMzxNtyMP+IeBYb5H2Uhhaxy4R0yj0Jmr9vH88nNzl490qClqbitOjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.dark.rtl.min.css" integrity="sha512-kLq4lqVGQGEmELNxCFHZcdGZBM7NhR3RGUondYNAxwR4N/OWedlxjuY7O+LWyr4ff73PCKFqneiElijWvqg8JA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" integrity="sha512-AZtJoEn5SfSZimv10x5NMO2gaZCdoU8nxtHJK8O4SbKNlQeb1ggkvf0b0QixuuXIjX3Tp5jzBbTWajki81Vl2g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.rtl.min.css" integrity="sha512-xFXY3BDQhvR4QDdZWMXg6iUf+eQENeKd+h+IU0Nl+uwR20NT7Z9Ke+yZknkzbzUj8VIJlL4DNbDwPCa17HzkBQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style type="text/css">
    input[name="remember_token"]{
      position: absolute;
      top: -20%;
      left: -20%;
      display: block;
      width: 140%;
      height: 140%;
      margin: 0px;
      padding: 0px;
      background: rgb(255, 255, 255);
      border: 0px;
      opacity: 0;
    }
    body
    {
    font-size: 14px;
    }
  
  </style>
</head>

<body class="hold-transition login-page" style="background-image: url('https://sso.truyxuatnguongoc.gov.vn/assets/images/backgrounds/bg-login-txng.png');" >
    

    
    
    <section class="vh-100" >
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10" style="width: 100%">
        <div class="card" style="border-radius: 1rem; backround: #d6e9ff; border: 1px solid #b9b9b9;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
               <img src="https://t4.ftcdn.net/jpg/01/22/60/61/360_F_122606193_Gf37Axx1LjsZkhxUQ2retG2oakjLQ3ZW.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black" >
                  <div class="d-flex align-items-center mb-3 pb-1" style="text-align:center;">
                    <span class="h1 fw-bold mb-0"><img src="https://smartcheck.com.vn/wp-content/uploads/2020/03/cropped-logochuan-dung-resize-1.png" alt=""></span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Vui lòng nhập thông tin đăng nhập</h5>

<p style="color: #f00">
      <?php echo e($errors->first()); ?>

    </p> 
                   <form action="<?php echo e(route('backend.site.pLogin')); ?>" method="post">
      <div class="form-group has-feedback <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>" style="font-size: 15px;">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="help-block"><?php echo e($errors->first('email')); ?></span>
      </div>
      <div class="form-group has-feedback <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" style="font-size: 15px;">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block"><?php echo e($errors->first('password')); ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <div class="icheckbox_square-blue">
                <input type="checkbox" name="remember_token">
                <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
              </div>
              Ghi nhớ
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" style="font-size: 15px;">Đăng nhập</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
    
    
    
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo e(asset('backend/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(asset('backend/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!-- iCheck -->
<script src="<?php echo e(asset('backend/plugins/iCheck/icheck.min.js')); ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
