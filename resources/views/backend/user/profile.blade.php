@extends('backend.layouts.main')
@section('title', 'User Profile')
@section('content')
@if (Session::has('msg_editProfile'))
    <script type="text/javascript">
    $(function() {
      jAlert('{{Session::get("msg_editProfile")}}', 'Thông báo');
    });
    </script>
@endif
@if (Session::has('msg_changePass'))
    <script type="text/javascript">
    $(function() {
      jAlert('{{Session::get("msg_changePass")}}', 'Thông báo');
    });
    </script>
@endif
<section class="content-header">
  <h1>
    Hồ sơ
    <small>Cập nhật</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{route('backend.user.index')}}">Danh sách tài khoản</a></li>
    <li class="active">Hồ sơ cá nhân</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive" src="{{Auth::user()->introimage != '' ? asset(Auth::user()->introimage) : asset('backend/dist/img/user2-160x160.jpg')}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{Auth::user()->fullname}}</h3>

          <p class="text-muted text-center">{{Auth::user()->email}}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Điện thoại:</b> <a class="pull-right">{{Auth::user()->tel}}</a>
            </li>
            <li class="list-group-item">
              <b>Địa chỉ</b> <a class="pull-right">{{Auth::user()->address}}</a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="{{$errors->has('oldPass') || $errors->has('newPass') || $errors->has('newPass_confirmation') ? '' : 'active'}}"><a href="#editInfo" data-toggle="tab">Cập nhật hồ sơ</a></li>
          <li class="{{$errors->has('oldPass') || $errors->has('newPass') || $errors->has('newPass_confirmation') ? 'active' : ''}}"><a href="#editPass" data-toggle="tab">Đổi mật khẩu</a></li>
        </ul>
        <div class="tab-content">
          <div class="{{$errors->has('oldPass') || $errors->has('newPass') || $errors->has('newPass_confirmation') ? '' : 'active'}} tab-pane" id="editInfo">
            <form class="form-horizontal" action="{{route('backend.user.pProfile')}}" method="POST" enctype="multipart/form-data">
              <div class="form-group {{$errors->has('fullname') ? 'has-error' : ''}}">
                <label for="inputName" class="col-sm-2 control-label required">Họ tên</label>
                <div class="col-sm-10">
                  <input type="text" name="fullname" class="form-control" id="inputName" value="{{Auth::user()->fullname}}" placeholder="Họ và tên">
                  <span class="help-block">{{$errors->first("fullname")}}</span>
                </div>
              </div>
              <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label for="inputEmail" class="col-sm-2 control-label required">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputEmail" value="{{Auth::user()->email}}" placeholder="Email" disabled>
                  <span class="help-block">{{$errors->first("email")}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-sm-2 control-label">Số điện thoại</label>
                <div class="col-sm-10">
                  <input type="text" name="tel" class="form-control" id="tel" value="{{Auth::user()->tel}}" placeholder="Số điện thoại">
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Địa chỉ</label>
                <div class="col-sm-10">
                  <input type="text" name="address" class="form-control" id="address" value="{{Auth::user()->address}}" placeholder="Địa chỉ">
                </div>
              </div>
              <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Ảnh đại diện</label>

                <div class="col-sm-10">
                  <input class="hidden" type="file" id="introimage" name="introimage" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                  <button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
                  <p>
                    @if(Auth::user()->introimage != "")
                      <img src="{{asset(Auth::user()->introimage)}}" id="blah" alt="" style="max-width: 50%;margin-top: 10px;">
                    @else
                      <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" id="blah" alt="" style="max-width: 50%;margin-top: 10px;">
                    @endif
                  </p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>   
          </div>
          <!-- /.tab-pane -->

          <div class="{{$errors->has('oldPass') || $errors->has('newPass') || $errors->has('newPass_confirmation') ? 'active' : ''}} tab-pane" id="editPass">
            <form class="form-horizontal" action="{{route('backend.user.pChangePass')}}" method="POST">
              <div class="form-group {{$errors->has('oldPass') ? 'has-error' : ''}}">
                <label for="oldPass" class="col-sm-2 control-label required">Mật khẩu cũ</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" name="oldPass" id="oldPass" placeholder="Password">
                  <span class="help-block">{{$errors->first("oldPass")}}</span>
                </div>
              </div>
              <div class="form-group {{$errors->has('newPass') ? 'has-error' : ''}}">
                <label for="newPass" class="col-sm-2 control-label required">Mật khẩu mới</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPass" id="newPass" placeholder="Password">
                  <span class="help-block">{{$errors->first("newPass")}}</span>
                </div>
              </div>
              <div class="form-group {{$errors->has('newPass_confirmation') ? 'has-error' : ''}}">
                <label for="newPass_confirmation" class="col-sm-2 control-label required">Nhập lại mật khẩu</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPass_confirmation" id="confirmdPass" placeholder="Password">
                  <span class="help-block">{{$errors->first("newPass_confirmation")}}</span>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->
@stop