@extends('backend.layouts.main')
@section('title', 'Cập nhật sản phẩm')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('backend/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('backend/summernote/summernote.js')}}"></script>
<section class="content-header">
  <h1>
    Cập nhật sản phẩm
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.product.index')}}">Danh sách sản phẩm</a></li>
    <li class="active">Cập nhật sản phẩm</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('backend.product.pEdit', ['id'=>$model->id])}}" method="POST" enctype="multipart/form-data">
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
						                <option value="{{$item->id}}" {{($item->id == $model->company_id) ? 'selected' : '' }}>{{$item->name}}</option>
						                @endforeach
						            </select>
						            <span class="help-block">{{$errors->first("company_id")}}</span>
						      	</div>
						      	<!-- /.form-group -->
						      	<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
					              	<label class="required" for="name">Tên sản phẩm</label>
					              	<input type="text" class="form-control" name="name" id="name" value="{{$model->name}}" placeholder="Nhập tên sản phẩm" maxlength="255">
					              	<span class="help-block">{{$errors->first("name")}}</span>
					            </div>
					            <!-- /.form-group -->
						      	<div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
					              	<label class="required" for="code">Mã sản phẩm</label>
					              	<input type="text" class="form-control" name="code" id="code" placeholder="Mã sản phẩm" value="{{$model->code}}" maxlength="50">
					              	<span class="help-block">{{$errors->first('code')}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('date_output') ? 'has-error' : ''}}">
					              	<label class="required" for="date_output">Ngày sản xuất</label>
					              	<input type="date" class="form-control" name="date_output" id="date_output" value="{{$model->date_output}}">
					              	<span class="help-block">{{$errors->first("name")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('protected_time') ? 'has-error' : ''}}">
						            <label class="required" for="protected_time">Chọn thời gian bảo hành</label>
						            <select class="form-control" id="protected_time" name="protected_time" style="width: 50%;">
						                @for($i=0;$i<100;$i++)
						                <option value="{{$i}}" {{$i == $model->protected_time ? 'selected' : ''}}>{{$i.' tháng'}}</option>
						                @endfor
						            </select>
						            <span class="help-block">{{$errors->first("protected_time")}}</span>
						      	</div>
						      	<!-- /.form-group -->
					          	<div class="form-group {{$errors->has('introimage') ? 'has-error' : ''}}">
				                  	<label class="required">Ảnh đại diện</label>
				                  	<input class="hidden" type="file" id="introimage" name="introimage" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
				                  	<button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
				                  	<p>
				                  		<img src="{{$model->introimage != '' ? asset($model->introimage) : ''}}" id="blah" alt="" style="max-width: 50%;margin-top: 10px;">
				                  	</p>
				                  	<span class="help-block">{{$errors->first("introimage")}}</span>
				                </div>
				                <!-- /.form-group -->
					        </div>
					        <!-- /.col -->
					  	</div>
				  	<!-- /.row -->
					</div>
				    <!-- /.box-body -->
				    <div class="box-body">
				      	<div class="row">
				      		<div class="col-md-12">
					      		<div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
				                  	<label class="required" for="description">Chi tiết sản phẩm</label>
				                  	<textarea name="description" id="description" class="form-control" rows="10" placeholder="Nhập chi tiết sản phẩm">{{$model->description}}</textarea>
				                  	<span class="help-block">{{$errors->first("description")}}</span>
				                </div>
			                </div>
				      	</div>
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
	$('#protected_time').select2();
	$('#description').summernote({
  		height: 300,                 // set editor height
	  	minHeight: null,             // set minimum height of editor
	  	maxHeight: null,             // set maximum height of editor
	  	focus: false                  // set focus to editable area after initializing summernote
	});
</script>
@stop