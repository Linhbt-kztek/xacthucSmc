<link rel="stylesheet" type="text/css" href="{{asset('backend/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('backend/summernote/summernote.js')}}"></script>
<script type="text/javascript">
        $(function () {
            $('#txtDate').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>
     <style type="text/css">
        .glyphicon-calendar
        {
            font-size: 15pt;
        }
        .input-group
        {
            width: 180px;
            margin-top:30px;
        }
    </style>

<form id="form-product" action="{{route('backend.product.pAdd')}}" method="POST" enctype="multipart/form-data">
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
			            	<option value="">--Chọn doanh nghiệp--</option>
			                @foreach($listCompany as $item)
			                <option value="{{$item->id}}" {{(old('company_id') == $item->id || (isset($company_id) && $company_id == $item->id)) ? 'selected' : '' }}>{{$item->name}}</option>
			                @endforeach
			            </select>
			            <span class="help-block">{{$errors->first("company_id")}}</span>
			      	</div>
		      		@if(isset($guid))
		      		<input type="hidden" name="guid" id="guid" value="{{$guid}}">
		      		@endif
			      	<!-- /.form-group -->
		        	<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
		              	<label class="required" for="name">PN - Tên sản phẩm</label>
		              	<input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Nhập tên sản phẩm" maxlength="255" required>
		              	<span class="help-block">{{$errors->first("name")}}</span>
		            </div>
		            <!-- /.form-group -->
		            <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
		              	<label class="required" for="code">Barcode - Mã sản phẩm</label>
		              	<input type="text" class="form-control" name="code" id="code" placeholder="Mã sản phẩm" value="{{old('code')}}" maxlength="50" required>
		              	<span class="help-block">{{$errors->first('code')}}</span>
		            </div>
		            <!-- /.form-group -->
		             <!-- /.form-group -->
		            <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
		              	<label class="" for="code">Patch code - Mã lô sản phẩm</label>
		              	<input type="text" class="form-control" name="batchcode" id="batchcode" placeholder="Mã Batch" value="{{old('batchcode')}}" maxlength="50">
		              	<span class="help-block">{{$errors->first('batchcode')}}</span>
		            </div>
		            <!-- /.form-group -->
		            
		            <div class="form-group {{$errors->has('date_output') ? 'has-error' : ''}}">
		              	<label class="" for="date_output">MFG - Ngày sản xuất</label>
		              	<input type="date" class="form-control date-input" name="date_output" id="date_output" value="{{old('date_output')}}"  data-date-format="dd-mm-yyyy"  >

		              	<span class="help-block">{{$errors->first("name")}}</span>
		            </div>
		            
		            <div class="form-group {{$errors->has('date_output') ? 'has-error' : ''}}">
		              	<label class="" for="date_output">EXP - Hạn sử dụng (hoặc ngày hết hạn) </label>
		              	<input type="date" class="form-control date-input" name="date_off" id="date_off" value="{{old('date_off')}}"  data-date-format="dd-mm-yyyy"  >

		              	<span class="help-block">{{$errors->first("name")}}</span>
		            </div>
		            
		            <hr>
		              <!-- /.form-group -->
		            <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
		              	<label class="" for="code">Price - giá sản phẩm</label>
		              	<input type="text" class="form-control" name="price" id="code" placeholder="Giá" value="{{old('code')}}" maxlength="50">
		              	<span class="help-block">{{$errors->first('code')}}</span>
		            </div>
		            <!-- /.form-group -->
		            <!-- /.form-group -->
		            <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
		              	<label class="" for="code">Kích hoạt hiện thông tin bảo hành hoặc lấy thông tin khách hàng</label>
		              <input type="checkbox" name="formactive" value="1">
		              	
		            </div>
		            <!-- /.form-group -->
		            
		            <!-- /.form-group -->
		            <div class="form-group {{$errors->has('protected_time') ? 'has-error' : ''}}">
			            <label class="" for="protected_time">Chọn thời gian bảo hành </label>
			            <select class="form-control" id="protected_time" name="protected_time" style="width: 50%;">
			                @for($i=0;$i<121;$i++)
			                <option value="{{$i}}" {{old('protected_time') == $i ? 'selected' : ''}}>{{$i.' tháng'}}</option>
			                @endfor
			            </select>
			            <span class="help-block">{{$errors->first("protected_time")}}</span>
			      	</div>
			      	
			      	 <!-- /.form-group -->
		            <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
		              	<label class="" for="code">Tiêu đề form nhập đăng ký thông tin</label>
		              	<input type="text" class="form-control" name="formlabel" id="code" placeholder="Nhập tiêu đề form" value="{{old('formlabel')}}" maxlength="250">
		              	<span class="help-block">{{$errors->first('code')}}</span>
		            </div>
		            <!-- /.form-group -->
		            <!-- /.form-group -->
		            <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
		              	<label class="" for="code">Ghi chú form nhập đăng ký thông tin</label>
		              		<textarea name="formnote1" id="formnote1" class="form-control" rows="4">{{old('formnote')}} </textarea>
		              	<span class="help-block">{{$errors->first('code')}}</span>
		            </div>
		            <!-- /.form-group -->
		            
			      	
			      	 <div class="form-group {{$errors->has('intro') ? 'has-error' : ''}}">
					              	<label class="required" for="intro">Tạo số dự thưởng (1=Có ; 0= Không)</label>
					              	 	<input type="number" class="form-control" name="reward" id="reward" maxlength="1" min="0" max="1" required value="0">
					              	 	
					              
					            </div>
					            
			      	
			      	<!-- /.form-group -->
		          	<div class="form-group {{$errors->has('introimage') ? 'has-error' : ''}}">
	                  	<label class="">Ảnh đại diện</label>
	                  	<input class="hidden" type="file" id="introimage" name="introimage[]" onchange="uploadImgs(this.files)" placeholder="Ảnh đại diện" multiple>
	                  	<button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
	                  	<p class="mutiple_image">
	                  		<input type="hidden" id="introimage_copy" name="introimage_copy">
	                  		<span class="imgs">
	                  			<img src="" id="blah" alt="" style="max-width: 50%;margin-top: 10px;"> 
	                  		</span>
	                  	</p>
	                  	<span class="help-block">{{$errors->first("introimage")}}</span>
	                </div>
	                <!-- /.form-group -->
	                	<div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
	                  	<label class="" for="description">Chi tiết sản phẩm</label>
	                  	<textarea name="description" id="description" class="form-control" rows="10" placeholder="Nhập chi tiết sản phẩm">{{old('description')}}</textarea>
	                  	<span class="help-block">{{$errors->first("description")}}</span>
	            
                </div>
                
		        </div>
		        <!-- /.col -->
		  	</div>
	  	<!-- /.row -->
		</div>
	    <!-- /.box-body -->
	    
	      		
		      	
	    
	     <!-- /.box-body -->
	    <div class="box-footer text-center">
        	<button type="submit" id="submit" class="btn btn-primary mrg-10">Save</button>
        	@if(isset($company) && $company->id != '')
        	<button type="button" class="btn btn-primary mrg-10" id="close-popup-btn">Close</button>
        	@else
        	<button type="reset" class="btn btn-default mrg-10">Cancel</button>
        	@endif
      	</div>
  	</div>
</form>


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
	
		$('#formnote').summernote({
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