@extends('backend.layouts.main')
@section('title', 'Cập nhật sản phẩm')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('backend/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('backend/summernote/summernote.js')}}"></script>
<section class="content-header">
@if (Session::has('msg_warranty'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_warranty")}}', 'Thông báo','OK');
   	});
   	</script>
@endif
  <h1>
    CẤU HÌNH LÔ TEM
    <small>Dùng cho việc cấu hình hiện thị khi quét</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    
    

  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
			
				<!-- /.box-header -->
			

    				<div class="box-body">
    					<div id="example1_wrapper">
    							<H4>CẤU HÌNH HIỆN THỊ KHI QUÉT MÃ TEM</H4>
    						<div class="row">
    							<div class="col-sm-6">
    							    <div class="alert alert-warning">
    							        <H4>THÔNG TIN KHỐ TEM ĐÃ CHIA</H4>
            							 ID: {{ $listProductQrcode->id }}  <br>
            							 Guid: {{ $listProductQrcode->guid }} <br>
            							 Mã SP: {{ $listProductQrcode->product_id }}<br> 
            							 Mã DN: {{ $listProductQrcode->company_id }}<br>
            							 Mã đầu: {{ $listProductQrcode->start }}<br>
            							 Mã cuối: {{ $listProductQrcode->end }}<br>
            							 Số lượng: {{ $listProductQrcode->amount }}<br>
            						</div>	 
    							</div>
    						</div>
    						
    						<div class="row">
    							<div class="col-sm-6"> 
    						
    							
    						<form   action="{{route('backend.qrcode.vconfigserial', ['id'=>$listProductQrcode->id])}}" method="POST" enctype="multipart/form-data">	     
    							     {{csrf_field()}}
    							        <div class="alert alert-success">
    							            <H4>BỔ SUNG THÔNG TIN SẢN PHẨM </H4> 
    							            <small>Chú ý: Nếu để trống sẽ không hiện thị khi quét</small>
            							 <!-- /.form-group -->
                    							 <div class="form-group ">
                					              	<label class=" " for="product_sku">Mã kho (SKU)</label>
                					              	<input type="text" class="form-control" name="product_sku" id="product_sku" placeholder="Mã lô sản xuất" value="{{$listProductQrcode->product_sku}}" maxlength="50"  >
                					            </div>
                					            <div class="form-group">
                					              	<label class=" " for="product_batchcode">Mã lô sản xuất (Batch code)</label>
                					              	<input type="text" class="form-control" name="product_batchcode" id="product_batchcode" placeholder="Mã lô sản xuất" value="{{$listProductQrcode->product_batchcode}}" maxlength="50"  >
                					            </div>
                					            
                    							 <div class="form-group">
                					              	<label class=" " for="code">Giá bán</label>
                					              	<input type="text" class="form-control" name="product_price" id="product_price" placeholder="Giá" value="{{$listProductQrcode->product_price}}" maxlength="50"  >
                					            </div>
                					            
                						      	<div class="form-group">
                					              	<label class=" " for="code">MFG - Ngày sản xuất </label>
                					              	<input type="date" class="form-control" name="date_output" id="date_output" placeholder="Mã sản phẩm" value="{{$listProductQrcode->date_output}}" maxlength="50"  >
                					              	
                					            </div>
                					             <!-- /.form-group -->
                					              <!-- /.form-group -->
                						      	<div class="form-group">
                					              	<label class=" " for="code">EXP - Hạn sử dụng ( hoặc Ngày hết hạn) </label>
                					              	<input type="date" class="form-control" name="date_off" id="date_off" placeholder="Mã sản phẩm" value="{{$listProductQrcode->date_off}}" maxlength="50"  >
                					              	
                					            </div>
                					             <!-- /.form-group -->
                					              <div class="form-group {{$errors->has('protected_time') ? 'has-error' : ''}}">
                						            <label class="" for="protected_time">Thời gian bảo hành (Nếu không muốn hiện thì 0 tháng)  </label>
                						            <select class="form-control" id="protected_time" name="protected_time" style="width: 50%;">
                						                @for($i=0;$i<121;$i++)
                						                <option value="{{$i}}" {{$i == $listProductQrcode->protected_time ? 'selected' : ''}}>{{$i.' tháng'}}</option>
                						                @endfor
                						            </select>
                						            <span class="help-block">{{$errors->first("protected_time")}}</span>
                						      	</div>
        						      	
        					             </div>
        					             <div class="alert alert-success">
        					                 <h4>TÙY CHỌN </h4>
                					             <div class="form-group ">
                            		              	
                            		              <input type="checkbox" name="serialshow" value="1" {{$listProductQrcode->serialshow==1 ? 'checked' : ''}} > <label class="" for="code">Hiện thông tin mã tem khi quét </label>
                            		              	
                            		            </div>
                            		            
                            		            
                					            
                					            <div class="form-group ">
                            		              
                            		              <input type="checkbox" name="activeform" value="1" {{$listProductQrcode->activeform==1 ? 'checked' : ''}} > <label class="" for="code">Kích hoạt hiện thông tin bảo hành hoặc lấy thông tin khách hàng  </label>
                            		              	
                            		            </div>
                            		            <div class="form-group ">
                            		              	
                            		              <input type="checkbox" name="Reward_activecode" value="1" {{$listProductQrcode->Reward_activecode==1 ? 'checked' : ''}} > <label class="" for="code">Kích hoạt tạo số dự thưởng </label>
                            		              	
                            		            </div>
                            		       </div>     
        					            <div class="alert alert-success">
        					                <H4>FORM NHẬN THÔNG TIN HOẶC BẢO HÀNH </H4> 
            						      	 <!-- /.form-group -->
                        		            <div class="form-group ">
                        		              	<label class="" for="code">Sửa đổi tiêu đề form nhập đăng ký thông tin</label>
                        		              	<input type="text" class="form-control" name="form_label" id="code" placeholder="Nhập tiêu đề form" value="{{$listProductQrcode->form_label}}" maxlength="250">
                        		              	
                        		            </div>
                        		            <!-- /.form-group -->
                        		            <!-- /.form-group -->
                        		            <div class="form-group ">
                        		              	<label class="" for="code">Sửa đổi ghi chú form nhập đăng ký thông tin</label>
                        		              	<textarea name="form_mesage" id="form_mesage" class="form-control" rows="4"> {{$listProductQrcode->form_mesage}} </textarea>
                        		              	
                        		              	<span class="help-block">{{$errors->first('code')}}</span>
                        		            </div>
                        		            <!-- /.form-group -->
                    		            </div>
                    		            <div class="box-footer text-center">
                    			        	<button type="submit" id="submit" class="btn btn-primary mrg-10">Lưu lại</button>
                    			        	<button type="reset" class="btn btn-default mrg-10">Hủy</button>
                    			      	</div>
        						      	
                    		            </form>
                    		         </div>
                    		         
                    		          
                    		</div>
                    		
					            
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