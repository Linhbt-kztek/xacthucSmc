<form id="form-partner" action="<?php echo e(route('backend.partner.pAdd')); ?>" method="POST">
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
			                <option value="<?php echo e($item->id); ?>" <?php echo e((old('company_id') == $item->id) ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			            </select>
			            <span class="help-block"><?php echo e($errors->first("company_id")); ?></span>
			      	</div>
		      		<?php if(isset($guid)): ?>
		      		<input type="hidden" name="guid" value="<?php echo e($guid); ?>">
		      		<?php endif; ?>
			      	<!-- /.form-group -->
			        <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
			          	<label class="required" for="name">Tên nhà phân phối</label>
			          	<input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="Tên nhà phân phối" maxlength="255">
			          	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
			          	<label class="" for="email">Email</label>
			          	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e(old('email')); ?>" maxlength="150">
			          	<span class="help-block"><?php echo e($errors->first("email")); ?></span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group <?php echo e($errors->has('tel') ? 'has-error' : ''); ?>">
			          	<label class="" for="tel">Số điện thoại</label>
			          	<input type="text" class="form-control" name="tel" id="tel" placeholder="Số điện thoại" value="<?php echo e(old('tel')); ?>" maxlength="50">
			          	<span class="help-block"><?php echo e($errors->first("tel")); ?></span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
			          	<label class="" for="address">Địa chỉ</label>
			          	<textarea class="form-control" name="address" rows="3" id="address" placeholder="Địa chỉ" maxlength="255"><?php echo e(old('address')); ?></textarea>
			          	<span class="help-block"><?php echo e($errors->first("address")); ?></span>
			        </div>
			        <!-- /.form-group -->
			        <div class="form-group">
                      	<label class="" for="note">Ghi chú</label>
                      	<textarea class="form-control" name="note" id="note" rows="3" placeholder="Ghi chú"><?php echo e(old('note')); ?></textarea>
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
	    	<?php if(isset($company) && $company->id != ''): ?>
        	<button type="button" class="btn btn-primary mrg-10" data-dismiss="modal">Close</button>
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
</script>