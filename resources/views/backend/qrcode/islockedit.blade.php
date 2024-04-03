@extends('backend.layouts.main')
@section('title', 'Sửa khóa mã code')
@section('content')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
@if (Session::has('msg_qrcode'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_qrcode")}}', 'Thông báo');
   	});
   	</script>
@endif

<link rel="stylesheet" type="text/css" href="{{asset('backend/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('backend/summernote/summernote.js')}}"></script>


<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #ff0000;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<section class="content-header">
  <h1>
    Sửa khóa mã code
    <small>Dùng cho việc khóa code nào đó mà không muốn hiện thị kết quả quét  {{isset($company) ? $company->name : ''}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.qrcode.index')}}">Nhật ký in</a></li>
    <li class="active">Lịch sử quét {{isset($filter['guid']) ? 'GUID: '.substr($filter['guid'], 0, 8).'...' : ''}}</li>

  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
			
				<!-- /.box-header -->
			

    				<div class="box-body">
    					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
    						<H3>SỬA MÃ CODE</H3>
    						<div class="row">
    							<div class="col-sm-12">
    								
    								@forelse ($listActiveQrcode as $key => $item) 
    								
        	       <div class="row">
                      
                      <form  class="form-horizontal"action="{{route('backend.qrcode.islockpedit',['id' => $item->id])}}" method="POST" enctype="multipart/form-data" name="updateform">
                          <div class="col-sm-6">
                              
                             
                            <div style="padding: 10px; border: 1px solid whitesmoke; margin: 10px;">
                                  <span style="line-height: 3"> <i class="fa fa-fw fa-qrcode"></i>  Mã tem: <b>{{$item->serial }}</b><br>
                                  </span>
                                  
                                  
                                  <span style="line-height: 3">
                                  <i class="fa fa-fw fa-key"></i>  Tình trạng: <b>{{$item->islock == 1 ? 'Đang bị khóa' : 'Không khóa'}}</b> <br>
                                   </span>
                                  <span style="line-height: 3">
                                       <i class="fa fa-fw fa-{{$item->islock == 1 ? 'lock' : 'unlock'}}"></i><label for="checkbox" class="form-check-label">{{$item->islock == 1 ? 'Bấm để mở' : 'Bấm để khóa'}}</label>
                                   <label class="switch">
                                      <input type="checkbox" name="islock"  value="1"  {{$item->islock == 1 ? 'checked' : ''}}>
                                      <span class="slider round"></span>
                                    </label>
                                   
                                  </span>
                            </div>
                            
                                <br>
                               
                              <b>Thông báo</b><br>
                              <div style="padding: 10px; border: 1px solid whitesmoke; margin: 10px;">
                              <input type="radio" name="message"  value="Khóa do yêu cầu" > Khóa do yêu cầu<br>
                              <input type="radio" name="message"  value="Khóa do mã bị sao chép, làm giả" > Khóa do mã bị sao chép, làm giả <br>
                              <input type="radio" name="message"  value="Khóa do tem đã bị hủy" > Khóa do tem đã bị hủy<br>
                              <input type="radio" name="message"  value="Khóa do hết hạn sử dụng" > Khóa do hết hạn sử dụng <br>
                              </div>
                              Hoặc tự nhập nội dung <br>
                              <textarea cols="50" rows="6" id="description" name="messagep" class="form-control" >{{$item->message}}</textarea>  <br><br>
                              <button type="submit" class="btn btn-primary show_confirm_add" data-toggle="tooltip" title='Lưu thông tin chỉnh sửa?'>Lưu lại</button> 
                          </div>
                      </form>
                    </div>
                     @empty
                	@endforelse
			      			</div>
		      			</div>
		      		
      				</div>    
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
<script type="text/javascript">



	if($('select#company_id').length > 0) {
		$('#company_id').select2();
	}
	$('#protected_time').select2();
	$('#description').summernote({
  		height: 300,                 // set editor height
	  	minHeight: null,             // set minimum height of editor
	  	maxHeight: null,             // set maximum height of editor
	  	focus: false                  // set focus to editable area after initializing summernote
	});

	function uploadImgs(files) {
		$('.imgs').html('');
		$.each(files, (x, val) => {
			$('.imgs').append(`<img src="${window.URL.createObjectURL(val)}" alt="" style="max-width: 25%;margin-top: 10px;">`);
		});
	}
</script>

@stop