@extends('backend.layouts.main')
@section('title', 'Update Account')
@section('content')
<section class="content-header">
  <h1>
    Update Account
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.user.index')}}">Danh sách users</a></li>
    <li class="active">Update Account</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-0">

      <!-- Profile Image -->
      <!--
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{Auth::user()->introimage != '' ? asset(Auth::user()->introimage) : asset('backend/dist/img/user2-160x160.jpg')}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{Auth::user()->fullname}}</h3>

          <p class="text-muted text-center">{{Auth::user()->email}}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Phone:</b> <a class="pull-right">{{Auth::user()->tel}}</a>
            </li>
            <li class="list-group-item">
              <b>Address</b> <a class="pull-right">{{Auth::user()->address}}</a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#addAccount" data-toggle="tab">Update Account</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="addAccount">
            <form class="form-horizontal" action="{{route('backend.user.pEdit', ['id'=>$model->id])}}" method="POST">
              <div class="form-group {{$errors->has('fullname') ? 'has-error' : ''}}">
                <label for="inputName" class="col-sm-2 control-label">Họ tên</label>
                <div class="col-sm-10">
                  <input type="text" name="fullname" class="form-control" id="inputName" value="{{$model->fullname}}" placeholder="Họ và tên">
                  <span class="help-block">{{$errors->first("fullname")}}</span>
                </div>
              </div>
              <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label for="inputEmail" class="col-sm-2 control-label required">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputEmail" value="{{$model->email}}" placeholder="Email">
                  <span class="help-block">{{$errors->first("email")}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-sm-2 control-label">Số điện thoại</label>
                <div class="col-sm-10">
                  <input type="text" name="tel" class="form-control" id="tel" value="{{$model->tel}}" placeholder="Số điện thoại">
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Địa chỉ</label>
                <div class="col-sm-10">
                  <input type="text" name="address" class="form-control" id="address" value="{{$model->address}}" placeholder="Địa chỉ">
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Trạng thái</label>
                <div class="col-sm-10">
            			<select class="form-control" style="width: 50%" name="status">
            				@if($listStatus)
            				@foreach($listStatus as $key => $status)
            				<option value="{{$key}}" {{$model->status == $key ? 'selected' : ''}}>{{$status}}</option>
            				@endforeach
            				@endif
            			</select>
                </div>
              </div>
              
               <div class="form-group {{$errors->has('newPass') ? 'has-error' : ''}}">
                <label for="newPass" class="col-sm-2 control-label ">Mật khẩu mới</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPass" id="newPass" placeholder="Password">
                  <span class="help-block">{{$errors->first("newPass")}}</span>
                </div>
              </div>
              <div class="form-group {{$errors->has('newPass_confirmation') ? 'has-error' : ''}}">
                <label for="newPass_confirmation" class="col-sm-2 control-label ">Nhập lại mật khẩu</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" name="newPass_confirmation" id="confirmdPass" placeholder="Password">
                  <span class="help-block">{{$errors->first("newPass_confirmation")}}</span>
                </div>
              </div>
              
              <div class="form-group {{$errors->has('is_admin') ? 'has-error' : ''}}">
                <label for="address" class="col-sm-2 control-label required">Loại tài khoản</label>
                <div class="col-sm-10">
                  <select class="form-control" style="width: 50%" name="is_admin">
                    @if($type)
                    @foreach($type as $key => $item)
                    <option value="{{$key}}" {{$model->is_admin == $key ? 'selected' : ''}}>{{$item}}</option>
                    @endforeach
                    @endif
                  </select>
                  <span class="help-block">{{$errors->first('is_admin')}}</span>
                </div>
              </div>
              <div class="form-group hide">
                <label for="address" class="col-sm-2 control-label">Cấp quyền</label>
                <div class="col-sm-10">
                  <select class="form-control" style="width: 50%" name="role">
                    
                  </select>
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