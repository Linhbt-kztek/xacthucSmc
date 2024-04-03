<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/summernote/summernote.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('backend/summernote/summernote.js')); ?>"></script>
<form id="form-winning" action="<?php echo e(route('backend.winning.pAdd')); ?>" method="POST">
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
		        <div class="<?php echo e($isAjax ? 'col-md-12' : 'col-md-6'); ?>">
		        	<?php if(isset($listCompany)): ?>
			    	<div class="form-group <?php echo e($errors->has('company_id') ? 'has-error' : ''); ?>">
			            <label class="required" for="company_id">Chọn doanh nghiệp</label>
			            <select class="form-control" id="company_id" name="company_id">
			            	<option value="">--Chọn doanh nghiệp--</option>
			                <?php $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <option value="<?php echo e($item->id); ?>" <?php echo e((old('company_id') == $item->id) ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			            </select>
			            <span class="help-block"><?php echo e($errors->first("company_id")); ?></span>
			      	</div>
			      	<?php endif; ?>
			      	<?php if(isset($company_id)): ?>
		      		<input type="hidden" name="company_id" id="company_id" value="<?php echo e($company_id); ?>">
		      		<?php endif; ?>
		      		<?php if(isset($guid)): ?>
		      		<input type="hidden" name="guid" id="guid" value="<?php echo e($guid); ?>">
		      		<?php endif; ?>
			      	<!-- /.form-group -->
		        	<div class="form-group <?php echo e($errors->has('product_id') ? 'has-error' : ''); ?>">
			            <label class="required" for="product_id">Chọn sản phẩm</label>
			            <select class="form-control" id="product_id" name="product_id">
			            	<option value="">--Chọn sản phẩm--</option>
			                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <?php if(isset($item->product)): ?>
			                <option value="<?php echo e($item->product->id); ?>" <?php echo e((old('product_id') == $item->product->id) ? 'selected' : ''); ?>><?php echo e($item->product->name); ?></option>
			                <?php endif; ?>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			            </select>
			            <span class="help-block"><?php echo e($errors->first("product_id")); ?></span>
			      	</div>
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
		              	<label class="" for="name">Trúng thưởng giá trị gì(ô tô, xe máy, quà...)?</label>
		              	<input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên giải thưởng" value="<?php echo e(old('name')); ?>" maxlength="255">
		              	<span class="help-block"><?php echo e($errors->first('name')); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('total_prize') ? 'has-error' : ''); ?>">
		              	<label class="" for="total_prize">Tổng giá trị giải thưởng</label>
		              	<input type="text" class="form-control" name="total_prize" id="total_prize" placeholder="Nhập tổng giá trị giải thưởng" value="<?php echo e(old('total_prize')); ?>" maxlength="255">
		              	<span class="help-block"><?php echo e($errors->first('total_prize')); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('start_date') ? 'has-error' : ''); ?>">
		              	<label class="" for="start_date">Từ ngày</label>
		              	<input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo e(old('start_date')); ?>">
		              	<span class="help-block"><?php echo e($errors->first("start_date")); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('end_date') ? 'has-error' : ''); ?>">
		              	<label class="" for="end_date">Đến ngày</label>
		              	<input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo e(old('end_date')); ?>">
		              	<span class="help-block"><?php echo e($errors->first("end_date")); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('amount') ? 'has-error' : ''); ?>">
		              	<label class="" for="amount">Số lượng</label>
		              	<input type="text" class="form-control" name="amount" id="amount" value="<?php echo e(old('amount')); ?>">
		              	<span class="help-block"><?php echo e($errors->first("amount")); ?></span>
		            </div>
		            <!-- /.form-group -->
		            <div class="form-group <?php echo e($errors->has('introimage') ? 'has-error' : ''); ?>">
	                  	<label class="">Ảnh đại diện</label>
	                  	<input class="hidden" type="file" id="introimage" name="introimage" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" placeholder="Ảnh đại diện">
	                  	<button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
	                  	<span class="help-block"><?php echo e($errors->first("introimage")); ?></span>
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
		      		<div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
	                  	<label class="" for="description">Chi tiết giải thưởng</label>
	                  	<textarea name="description" id="description" class="form-control" rows="10" placeholder="Nhập chi tiết giải thưởng"><?php echo e(old('description')); ?></textarea>
	                  	<span class="help-block"><?php echo e($errors->first("description")); ?></span>
	                </div>
                </div>
	      	</div>
      	</div>
	     <!-- /.box-body -->
	    <div class="box-footer text-center">
        	<button type="submit" class="btn btn-primary mrg-10">Save</button>
        	<?php if(isset($company_id)): ?>
        	<button type="button" class="btn btn-primary mrg-10" id="close-popup-btn">Close</button>
        	<?php else: ?>
        	<button type="reset" class="btn btn-default mrg-10">Cancel</button>
        	<?php endif; ?>
      	</div>
  	</div>
</form>
<script type="text/javascript">
	if($('select#company_id').length > 0) {
		$('#company_id').select2();
	}
	$('#description').summernote({
  		height: 300,                 // set editor height
	  	minHeight: null,             // set minimum height of editor
	  	maxHeight: null,             // set maximum height of editor
	  	focus: false                  // set focus to editable area after initializing summernote
	});
</script>