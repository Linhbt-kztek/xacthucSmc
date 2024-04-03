
<?php $__env->startSection('title', 'Cập nhật sản phẩm'); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/summernote/summernote.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('backend/summernote/summernote.js')); ?>"></script>
<section class="content-header">
  <h1>
    Cập nhật sản phẩm
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(route('backend.product.index')); ?>">Danh sách sản phẩm</a></li>
    <li class="active">Cập nhật sản phẩm</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="<?php echo e(route('backend.product.pEdit', ['id'=>$model->id])); ?>" method="POST" enctype="multipart/form-data">
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
						                <?php $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                <option value="<?php echo e($item->id); ?>" <?php echo e(($item->id == $model->company_id) ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
						                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						            </select>
						            <span class="help-block"><?php echo e($errors->first("company_id")); ?></span>
						      	</div>
						      	<!-- /.form-group -->
						      	<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
					              	<label class="required" for="name">PN- Tên sản phẩm</label>
					              	<input type="text" class="form-control" name="name" id="name" value="<?php echo e($model->name); ?>" placeholder="Nhập tên sản phẩm" maxlength="255" required>
					              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
					            </div>
					            <!-- /.form-group -->
						      	<div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
					              	<label class="required" for="code">Barcode - Mã sản phẩm </label>
					              	<input type="text" class="form-control" name="code" id="code" placeholder="Mã sản phẩm" value="<?php echo e($model->code); ?>" maxlength="50" required>
					              	<span class="help-block"><?php echo e($errors->first('code')); ?></span>
					            </div>
					             <!-- /.form-group -->
						      	<div class="form-group <?php echo e($errors->has('batchcode') ? 'has-error' : ''); ?>">
					              	<label class="" for="code">Batchcode - Mã lô sản phẩm </label>
					              	<input type="text" class="form-control" name="batchcode" id="bathcode" placeholder="Mã batchcode" value="<?php echo e($model->batchcode); ?>" maxlength="50">
					              	<span class="help-block"><?php echo e($errors->first('bachcode')); ?></span>
					            </div>
					            
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('date_output') ? 'has-error' : ''); ?>">
					              	<input type="date" class="form-control" name="date_output" id="date_output" value="<?php echo e($model->date_output); ?>">
					              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
					            </div>
					             <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('date_off') ? 'has-error' : ''); ?>">
					              	<label class="" for="date_output"> EXP - Hạn sử dụng ( hoặc Ngày hết hạn)</label>
					              	<input type="date" class="form-control" name="date_off" id="date_off" value="<?php echo e($model->date_off); ?>">
					              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
					            </div>
					            <!-- /.form-group -->
					            <!--
					            <div class="form-group <?php echo e($errors->has('date_output') ? 'has-error' : ''); ?>">
					              	<label class="required" for="date_output">Giờ sản xuất</label>
					              	<input type="time" class="form-control" name="time_out" id="time_out" value="<?php echo e($model->time_out); ?>">
					              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
					            </div>
					            -->
					            <!-- /.form-group -->
					            <hr>
					             <!-- /.form-group -->
					            
					            <div class="form-group <?php echo e($errors->has('date_output') ? 'has-error' : ''); ?>">
					              	<label class="" for="date_output">Price - Giá</label>
					              	<input type="text" class="form-control" name="price" id="time_out" value="<?php echo e($model->price); ?>">
					              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
					            </div>
					            
					             <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
            		              	<label class="" for="code">Hiện thông tin mã tem khi quét </label>
            		              <input type="checkbox" name="serialshow" value="1" <?php echo e($model->serialshow==1 ? 'checked' : ''); ?> >
            		              	
            		            </div>
            		            
            		            
					            <hr>
					            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
            		              	<label class="" for="code">Kích hoạt hiện thông tin bảo hành hoặc lấy thông tin khách hàng  </label>
            		              <input type="checkbox" name="formactive" value="1" <?php echo e($model->formactive==1 ? 'checked' : ''); ?> >
            		              	
            		            </div>
            		            
					            <div class="form-group <?php echo e($errors->has('protected_time') ? 'has-error' : ''); ?>">
						            <label class="" for="protected_time">Thời gian bảo hành </label>
						            <select class="form-control" id="protected_time" name="protected_time" style="width: 50%;">
						                <?php for($i=0;$i<121;$i++): ?>
						                <option value="<?php echo e($i); ?>" <?php echo e($i == $model->protected_time ? 'selected' : ''); ?>><?php echo e($i.' tháng'); ?></option>
						                <?php endfor; ?>
						            </select>
						            <span class="help-block"><?php echo e($errors->first("protected_time")); ?></span>
						      	</div>
						      	
						      	 <!-- /.form-group -->
            		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
            		              	<label class="" for="code">Tiêu đề form nhập đăng ký thông tin</label>
            		              	<input type="text" class="form-control" name="formlabel" id="code" placeholder="Nhập tiêu đề form" value="<?php echo e($model->formlabel); ?>" maxlength="250">
            		              	<span class="help-block"><?php echo e($errors->first('code')); ?></span>
            		            </div>
            		            <!-- /.form-group -->
            		            <!-- /.form-group -->
            		            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
            		              	<label class="" for="code">Ghi chú form nhập đăng ký thông tin</label>
            		              	<textarea name="formnote1" id="formnote1" class="form-control" rows="4"> <?php echo e($model->formnote); ?> </textarea>
            		              	
            		              	<span class="help-block"><?php echo e($errors->first('code')); ?></span>
            		            </div>
            		            <!-- /.form-group -->
            		            
						      	
						      	  <div class="form-group <?php echo e($errors->has('intro') ? 'has-error' : ''); ?>">
					              	<label class="required" for="intro">Tạo số dự thưởng (1=Có ; 0= Không)</label>
					              	 	<input type="number" class="form-control" name="reward" id="reward" value="<?php echo e($model->reward); ?>" maxlength="1" min="0" max="1" required>
					              	 	
					              
					            </div>
					            
						      	
						      	<!-- /.form-group -->
					          	<div class="form-group <?php echo e($errors->has('introimage') ? 'has-error' : ''); ?>">
				                  	<label class="required">Ảnh đại diện</label>
				                  	<input class="hidden" type="file" id="introimage" name="introimage[]" onchange="uploadImgs(this.files)" placeholder="Ảnh đại diện" multiple>
	                  				<button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
				                  	<p class="mutiple_image">
				                  		<span class="imgs">
				                  			<?php $__currentLoopData = $model->product_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                  			<img src="<?php echo e(asset($img->path)); ?>" alt="" style="max-width: 25%;margin-top: 10px;">
				                  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                  		</span>
				                  	</p>
				                  	<span class="help-block"><?php echo e($errors->first("introimage")); ?></span>
				                </div>
				                <!-- /.form-group -->
				                	<div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
				                  	<label class="required" for="description">Chi tiết sản phẩm</label>
				                  	<textarea name="description" id="description" class="form-control" rows="10" placeholder="Nhập chi tiết sản phẩm"><?php echo e($model->description); ?></textarea>
				                  	<span class="help-block"><?php echo e($errors->first("description")); ?></span>
				                </div>
				                
				                 <!-- /.form-group -->
		            
			      	<h3> THAY ĐỔI NỘI DUNG HIỆN THỊ MẶC ĐỊNH</h3>
			      	            <div class="form-group <?php echo e($errors->has('intro') ? 'has-error' : ''); ?>">
					              	<label class="required" for="intro">Thông báo kết quả xác thực</label>
					              	 	<input type="text" class="form-control" name="alertmessage" id="alertmessage" value="<?php echo e($model->alertmessage); ?>" >
					            </div>
					            <div class="form-group <?php echo e($errors->has('intro') ? 'has-error' : ''); ?>">
					              	<label class="required" for="intro">Tiêu đề thông tin sản phẩm</label>
					              	 	<input type="text" class="form-control" name="productinfo" id="productinfo" value="<?php echo e($model->productinfo); ?>" >
					            </div>
					            <div class="form-group <?php echo e($errors->has('intro') ? 'has-error' : ''); ?>">
					              	<label class="required" for="intro">Thông tin doanh nghiệp sở hữu</label>
					              	 	<input type="text" class="form-control" name="companyinfo" id="companyinfo" value="<?php echo e($model->companyinfo); ?>" >
					            </div>
					            <div class="form-group <?php echo e($errors->has('intro') ? 'has-error' : ''); ?>">
					              	<label class="required" for="intro">Thông tin nhà phân phối, đối tác, nhập khẩu</label>
					              	 	<input type="text" class="form-control" name="parnerinfo" id="parnerinfo" value="<?php echo e($model->parnerinfo); ?>" >
					            </div>
			      	<!-- /.form-group -->
			      	
				                
					        </div>
					        <!-- /.col -->
					  	</div>
				  	<!-- /.row -->
					</div>
				    <!-- /.box-body -->
				   
				     <!-- /.box-body -->
				    <div class="box-footer text-center">
			        	<button type="submit" id="submit" class="btn btn-primary mrg-10">Save</button>
			        	<button type="reset" class="btn btn-default mrg-10">Cancel</button>
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
	$('#company_id').select2();
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>