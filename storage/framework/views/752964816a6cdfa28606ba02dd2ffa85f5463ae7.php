<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/summernote/summernote.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('backend/summernote/summernote.js')); ?>"></script>
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

<form id="form-product" action="<?php echo e(route('backend.product.pAdd')); ?>" method="POST" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?>

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
			    	<div class="form-group <?php echo e($errors->has('company_id') ? 'has-error' : ''); ?>">
			            <label class="required" for="company_id">Chọn doanh nghiệp</label>
			            <select class="form-control" id="company_id" name="company_id">
			            	<option value="">--Chọn doanh nghiệp--</option>
			                <?php $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <option value="<?php echo e($item->id); ?>" <?php echo e((old('company_id') == $item->id || (isset($company_id) && $company_id == $item->id)) ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			            </select>
			            <span class="help-block"><?php echo e($errors->first("company_id")); ?></span>
			      	</div>
		      		<?php if(isset($guid)): ?>
		      		<input type="hidden" name="guid" id="guid" value="<?php echo e($guid); ?>">
		      		<?php endif; ?>
			      	<!-- /.form-group -->
		        	<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
		              	<label class="required" for="name">PN - Tên sản phẩm</label>
		              	<input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="Nhập tên sản phẩm" maxlength="255" required>
		              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		              	<label class="required" for="code">Barcode - Mã sản phẩm</label>
		              	<input type="text" class="form-control" name="code" id="code" placeholder="Mã sản phẩm" value="<?php echo e(old('code')); ?>" maxlength="50" required>
		              	<span class="help-block"><?php echo e($errors->first('code')); ?></span>
		            </div>
		            <!-- /.form-group -->
		             <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		              	<label class="" for="code">Patch code - Mã lô sản phẩm</label>
		              	<input type="text" class="form-control" name="batchcode" id="batchcode" placeholder="Mã Batch" value="<?php echo e(old('batchcode')); ?>" maxlength="50">
		              	<span class="help-block"><?php echo e($errors->first('batchcode')); ?></span>
		            </div>
		            <!-- /.form-group -->
		            
		            <div class="form-group <?php echo e($errors->has('date_output') ? 'has-error' : ''); ?>">
		              	<label class="" for="date_output">MFG - Ngày sản xuất</label>
		              	<input type="date" class="form-control date-input" name="date_output" id="date_output" value="<?php echo e(old('date_output')); ?>"  data-date-format="dd-mm-yyyy"  >

		              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
		            </div>
		            
		            <div class="form-group <?php echo e($errors->has('date_output') ? 'has-error' : ''); ?>">
		              	<label class="" for="date_output">EXP - Hạn sử dụng (hoặc ngày hết hạn) </label>
		              	<input type="date" class="form-control date-input" name="date_off" id="date_off" value="<?php echo e(old('date_off')); ?>"  data-date-format="dd-mm-yyyy"  >

		              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
		            </div>
		            
		            <hr>
		              <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		              	<label class="" for="code">Price - giá sản phẩm</label>
		              	<input type="text" class="form-control" name="price" id="code" placeholder="Giá" value="<?php echo e(old('code')); ?>" maxlength="50">
		              	<span class="help-block"><?php echo e($errors->first('code')); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		              	<label class="" for="code">Kích hoạt hiện thông tin bảo hành hoặc lấy thông tin khách hàng</label>
		              <input type="checkbox" name="formactive" value="1">
		              	
		            </div>
		            <!-- /.form-group -->
		            
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('protected_time') ? 'has-error' : ''); ?>">
			            <label class="" for="protected_time">Chọn thời gian bảo hành </label>
			            <select class="form-control" id="protected_time" name="protected_time" style="width: 50%;">
			                <?php for($i=0;$i<121;$i++): ?>
			                <option value="<?php echo e($i); ?>" <?php echo e(old('protected_time') == $i ? 'selected' : ''); ?>><?php echo e($i.' tháng'); ?></option>
			                <?php endfor; ?>
			            </select>
			            <span class="help-block"><?php echo e($errors->first("protected_time")); ?></span>
			      	</div>
			      	
			      	 <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		              	<label class="" for="code">Tiêu đề form nhập đăng ký thông tin</label>
		              	<input type="text" class="form-control" name="formlabel" id="code" placeholder="Nhập tiêu đề form" value="<?php echo e(old('formlabel')); ?>" maxlength="250">
		              	<span class="help-block"><?php echo e($errors->first('code')); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		              	<label class="" for="code">Ghi chú form nhập đăng ký thông tin</label>
		              		<textarea name="formnote1" id="formnote1" class="form-control" rows="4"><?php echo e(old('formnote')); ?> </textarea>
		              	<span class="help-block"><?php echo e($errors->first('code')); ?></span>
		            </div>
		            <!-- /.form-group -->
		            
			      	
			      	 <div class="form-group <?php echo e($errors->has('intro') ? 'has-error' : ''); ?>">
					              	<label class="required" for="intro">Tạo số dự thưởng (1=Có ; 0= Không)</label>
					              	 	<input type="number" class="form-control" name="reward" id="reward" maxlength="1" min="0" max="1" required value="0">
					              	 	
					              
					            </div>
					            
			      	
			      	<!-- /.form-group -->
		          	<div class="form-group <?php echo e($errors->has('introimage') ? 'has-error' : ''); ?>">
	                  	<label class="">Ảnh đại diện</label>
	                  	<input class="hidden" type="file" id="introimage" name="introimage[]" onchange="uploadImgs(this.files)" placeholder="Ảnh đại diện" multiple>
	                  	<button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
	                  	<p class="mutiple_image">
	                  		<input type="hidden" id="introimage_copy" name="introimage_copy">
	                  		<span class="imgs">
	                  			<img src="" id="blah" alt="" style="max-width: 50%;margin-top: 10px;"> 
	                  		</span>
	                  	</p>
	                  	<span class="help-block"><?php echo e($errors->first("introimage")); ?></span>
	                </div>
	                <!-- /.form-group -->
	                	<div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
	                  	<label class="" for="description">Chi tiết sản phẩm</label>
	                  	<textarea name="description" id="description" class="form-control" rows="10" placeholder="Nhập chi tiết sản phẩm"><?php echo e(old('description')); ?></textarea>
	                  	<span class="help-block"><?php echo e($errors->first("description")); ?></span>
	            
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
        	<?php if(isset($company) && $company->id != ''): ?>
        	<button type="button" class="btn btn-primary mrg-10" id="close-popup-btn">Close</button>
        	<?php else: ?>
        	<button type="reset" class="btn btn-default mrg-10">Cancel</button>
        	<?php endif; ?>
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