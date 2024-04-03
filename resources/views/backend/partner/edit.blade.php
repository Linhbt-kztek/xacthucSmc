@extends('backend.layouts.main')
@section('title', 'Cập nhật nhà phân phối')
@section('content')
<section class="content-header">
  <h1>
    Cập nhật nhà phân phối
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.partner.index')}}">Danh sách nhà phân phối</a></li>
    <li class="active">Cập nhật nhà phân phối</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('backend.partner.pEdit', ['id'=>$model->id])}}" method="POST">
				{{csrf_field()}}
				<div class="box box-primary">
				    <div class="box-header with-border">
				      <h3 class="help">Lưu ý: những trường có (<span style="color: #f00">*</span>) là bắt buộc.</h3>
				      <div class="box-tools pull-right">
				        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				      </div>
				    </div>
				    <!-- /.box-header -->
				    <div class="box-body">
				      	<div class="row">
					        <div class="col-md-6">
						    	<div class="form-group {{$errors->has('company_id') ? 'has-error' : ''}}">
						            <label class="required" for="company_id">Chọn doanh nghiệp</label>
						            <select class="form-control" id="company_id" name="company_id">
						                @foreach($listCompany as $item)
						                <option value="{{$item->id}}" {{$model->company_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
						                @endforeach
						            </select>
						            <span class="help-block">{{$errors->first("company_id")}}</span>
						      	</div>
						      	<!-- /.form-group -->
						        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
						          	<label class="required" for="name">Tên nhà phân phối</label>
						          	<input type="text" class="form-control" name="name" id="name" value="{{$model->name}}" placeholder="Tên nhà phân phối" maxlength="255">
						          	<span class="help-block">{{$errors->first("name")}}</span>
						        </div>
						        <!-- /.form-group -->
						        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
						          	<label class="" for="email">Email</label>
						          	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$model->email}}" maxlength="150">
						          	<span class="help-block">{{$errors->first("email")}}</span>
						        </div>
						        <!-- /.form-group -->
						        <div class="form-group {{$errors->has('tel') ? 'has-error' : ''}}">
						          	<label class="" for="tel">Số điện thoại</label>
						          	<input type="text" class="form-control" name="tel" id="tel" placeholder="Số điện thoại" value="{{$model->tel}}" maxlength="50">
						          	<span class="help-block">{{$errors->first("tel")}}</span>
						        </div>
						        <!-- /.form-group -->
						        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
						          	<label class="" for="address">Địa chỉ</label>
						          	<textarea class="form-control" name="address" rows="3" id="address" placeholder="Địa chỉ" maxlength="255">{{$model->address}}</textarea>
						          	<span class="help-block">{{$errors->first("address")}}</span>
						        </div>
						        <!-- /.form-group -->
						        <div class="form-group">
			                      	<label class="" for="note">Ghi chú</label>
			                      	<textarea class="form-control" name="note" id="note" rows="3" placeholder="Ghi chú">{{$model->note}}</textarea>
			                  	</div>
			                  	<!-- /.form-group -->
			                  	<div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
            		              	<input class="form-check-input" type="checkbox" name="active" value="1" {{$model->active==1 ? 'checked' : ''}} > <label class="" for="code">Hiện thông tin khi quét (Doanh nghiệp không muốn hiện thông tin nhầ phân phối, đại lý thì bỏ check) </label>
            		              
            		              	
            		            </div>
            		            
			                  	<!-- /.form-group -->
						    </div>
						    <!-- /.col -->
					  	</div>
				  	<!-- /.row -->
					</div>
				    <!-- /.box-body -->
				    <div class="box-footer text-center">
			        	<button type="submit" class="btn btn-primary mrg-10">Save</button>
			        	<button type="reset" class="btn btn-default mrg-10">Cancel</button>
			      	</div>
				  </div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript">
  $('#company_id').select2();
</script>
@stop