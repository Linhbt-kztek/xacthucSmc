@extends('backend.layouts.main')
@section('title', 'Cập nhật doanh nghiệp')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('backend/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('backend/summernote/summernote.js')}}"></script>
<section class="content-header">
  <h1>
    Cập nhật doanh nghiệp
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{route('backend.company.index')}}">Danh sách doanh nghiệp</a></li>
    <li class="active">Cập nhật doanh nghiệp</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('backend.company.pEdit',['id'=>$model->id])}}" method="POST" enctype="multipart/form-data">
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
					        <div class="col-md-6 col-sm-6 col-xs-12">
					        	<div class="row text-center"><h3>Thông tin doanh nghiệp</h3></div>
					        	<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
					              	<label class="required" for="name">Tên doanh nghiệp</label>
					              	<input type="text" class="form-control" name="name" id="name" value="{{$model->name}}" placeholder="Tên doanh nghiệp" maxlength="255">
					              	<span class="help-block">{{$errors->first("name")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
					              	<label class="required" for="email">Email</label>
					              	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$model->email}}" maxlength="150">
					              	<span class="help-block">{{$errors->first("email")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('tel') ? 'has-error' : ''}}">
					              	<label class="required" for="tel">Số điện thoại</label>
					              	<input type="text" class="form-control" name="tel" id="tel" placeholder="Số điện thoại" value="{{$model->tel}}" maxlength="150">
					              	<span class="help-block">{{$errors->first("tel")}}</span>
					            </div>
					             <div class="form-group {{$errors->has('tel') ? 'has-error' : ''}}">
					              	<label class="required" for="tel">facebooklink chat (chú ý chỉ nhập tên link cá nhân, không lấy cả link facebook) </label>
					              	<input type="text" class="form-control" name="facebooklink" id="tel" placeholder="Link facebook" value="{{$model->facebooklink}}" maxlength="150">
					              	<span class="help-block">{{$errors->first("tel")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
					              	<label class="required" for="address">Địa chỉ</label>
					              	<textarea class="form-control" name="address" rows="3" id="address" placeholder="Địa chỉ" maxlength="9999">{{$model->address}}</textarea>
					              	<span class="help-block">{{$errors->first("address")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('code_tax') ? 'has-error' : ''}}">
					              	<label class="" for="code_tax">Mã số thuế</label>
					              	<input type="text" class="form-control" name="code_tax" id="code_tax" placeholder="Mã số thuế" value="{{$model->code_tax}}" maxlength="50">
					              	<span class="help-block">{{$errors->first("code_tax")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('website') ? 'has-error' : ''}}">
					              	<label class="" for="website">Website</label>
					              	<input type="text" class="form-control" name="website" id="website" placeholder="Website" value="{{$model->website}}" maxlength="255">
					              	<span class="help-block">{{$errors->first("website")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('intro') ? 'has-error' : ''}}">
					              	<label class="" for="intro">Giới thiệu công ty</label>
					              	<textarea class="form-control" name="intro" rows="3" id="intro" placeholder="Giới thiệu công ty">{{$model->intro}}</textarea>
					              	<span class="help-block">{{$errors->first("intro")}}</span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group {{$errors->has('introimage') ? 'has-error' : ''}}">
				                  	<label class="">Ảnh đại diện</label>
				                  	<input class="hidden" type="file" id="introimage" name="introimage" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
				                  	<button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
				                  	<p>
				                  		<img src="{{$model->introimage != '' ? asset($model->introimage) : ''}}" id="blah" alt="" style="max-width: 50%;margin-top: 10px;">
				                  	</p>
				                  	<span class="help-block">{{$errors->first("introimage")}}</span>
				                </div>
				                
				                 <div class="form-group {{$errors->has('intro') ? 'has-error' : ''}}">
					              	<label class="" for="intro">Chọn cách chia khối (Mặc định 0 = chia khối theo serial tem/ nếu không muốn nhập số 1)</label>
					              	
					              	 	<input type="number" class="form-control" name="warranty" id="warranty" value="{{$model->warranty}}" maxlength="1" min="0" max="1">
					              	 	<!--
					              	 	<input type="checkbox" id="warranty" name="warranty" value="{{$model->warranty}}">
					              	 	-->

					              
					            </div>
					            
					            
				                <!-- /.form-group -->
				                <div class="form-group {{$errors->has('asign_to') ? 'has-error' : ''}}">
						            <label class="required" for="asign_to">Chọn user quản lý</label>
						            <select class="form-control" id="asign_to" name="asign_to">
						            	<option value="">--Chọn user--</option>
						                @foreach($listUser as $item)
						                <option value="{{$item->id}}" {{($model->asign_to == $item->id) ? 'selected' : '' }}>{{$item->email}}</option>
						                @endforeach
						            </select>
						            <span class="help-block">{{$errors->first("asign_to")}}</span>
						      	</div>
						      	<!-- /.form-group -->
					        </div>
					        <!-- /.col -->
					  	</div>
				  	<!-- /.row -->
					</div>
				    <!-- /.box-body -->
				    <div class="box-footer text-center">
			        	<button type="submit" id="submit" class="btn btn-primary mrg-10">Lưu lại</button>
			        	<button type="reset" class="btn btn-default mrg-10">Huỷ bỏ</button>
			      	</div>
				  </div>
			</form>
		</div>
	</div>
</section>

<script>
    $("#submit").click(function(e) {
      var logoimg = document.getElementById("introimage");
            let size = logoimg.files[0].size; 
            if (size > 200000) {
              alert( "XIN CHÚ Ý "  
            +"\n"
            +"\n"
                +  "Tệp ảnh không được vượt quá 200kb" 
               +"\n"
               + "Vui lòng chọn ảnh khác hoặc làm nhỏ ảnh lại"
              );
            
            
                event.preventDefault(); 
            }
    });
</script>

<script type="text/javascript">
	$('#asign_to').select2();
</script>
@stop