
<?php $__env->startSection('title', 'Thêm Doanh nghiệp'); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/summernote/summernote.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('backend/summernote/summernote.js')); ?>"></script>
<section class="content-header">
  <h1>
    Thêm Doanh nghiệp
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(route('backend.company.index')); ?>">Danh sách Doanh nghiệp</a></li>
    <li class="active">Thêm Doanh nghiệp</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="<?php echo e(route('backend.company.pAdd')); ?>" method="POST" enctype="multipart/form-data">
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
					        <div class="col-md-6 col-sm-6 col-xs-12">
					        	<div class="row text-center"><h3>Thông tin doanh nghiệp</h3></div>
					        	<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
					              	<label class="required" for="name">Tên doanh nghiệp</label>
					              	<input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="Tên doanh nghiệp" maxlength="255">
					              	<span class="help-block"><?php echo e($errors->first("name")); ?></span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
					              	<label class="required" for="email">Email</label>
					              	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e(old('email')); ?>" maxlength="150">
					              	<span class="help-block"><?php echo e($errors->first("email")); ?></span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('tel') ? 'has-error' : ''); ?>">
					              	<label class="required" for="tel">Số điện thoại</label>
					              	<input type="text" class="form-control" name="tel" id="tel" placeholder="Số điện thoại" value="<?php echo e(old('tel')); ?>" maxlength="50">
					              	<span class="help-block"><?php echo e($errors->first("tel")); ?></span>
					            </div>
					             <div class="form-group <?php echo e($errors->has('tel') ? 'has-error' : ''); ?>">
					              	<label class="required" for="tel">facebooklink Chat (chú ý chỉ nhập tên link cá nhân, không lấy cả link facebook) </label>
					              	<input type="text" class="form-control" name="facebooklink" id="tel" placeholder="Link facebook" value="<?php echo e(old('facebooklink')); ?>" maxlength="150">
					              	<span class="help-block"><?php echo e($errors->first("facebooklink")); ?></span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
					              	<label class="required" for="address">Địa chỉ</label>
					              	<textarea class="form-control" name="address" rows="3" id="address" placeholder="Địa chỉ" maxlength="1155"><?php echo e(old('address')); ?></textarea>
					              	<span class="help-block"><?php echo e($errors->first("address")); ?></span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('code_tax') ? 'has-error' : ''); ?>">
					              	<label class="" for="code_tax">Mã số thuế</label>
					              	<input type="text" class="form-control" name="code_tax" id="code_tax" placeholder="Mã số thuế" value="<?php echo e(old('code_tax')); ?>" maxlength="50">
					              	<span class="help-block"><?php echo e($errors->first("code_tax")); ?></span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('website') ? 'has-error' : ''); ?>">
					              	<label class="" for="website">Website</label>
					              	<input type="text" class="form-control" name="website" id="website" placeholder="Website" value="<?php echo e(old('website')); ?>" maxlength="255">
					              	<span class="help-block"><?php echo e($errors->first("website")); ?></span>
					            </div>
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('intro') ? 'has-error' : ''); ?>">
					              	<label class="" for="intro">Giới thiệu công ty</label>
					              	<textarea class="form-control" name="intro" rows="3" id="intro" placeholder="Giới thiệu công ty"><?php echo e(old('intro')); ?></textarea>
					              	<span class="help-block"><?php echo e($errors->first("intro")); ?></span>
					            </div>
					            
					              <div class="form-group">
					              	<label class="" for="intro">Chọn cách chia khối (Mặc định 0 = chia khối theo serial tem/ nếu không muốn nhập số 1)</label>
					              	 	<input type="text" class="form-control" name="warranty" id="warranty" value="0"  maxlength="1" min="0" max="1">
					              	 
					              
					            </div>
					            
					            
					            <!-- /.form-group -->
					            <div class="form-group <?php echo e($errors->has('introimage') ? 'has-error' : ''); ?>">
				                  	<label class="">Ảnh đại diện</label>
				                  	<input class="hidden" type="file" id="introimage" name="introimage" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" placeholder="Ảnh đại diện">
				                  	<button type="button" style="display: block;" class="btn btn-info" onclick="document.getElementById('introimage').click();">Chọn ảnh</button>
				                  	<p>
				                  		<img src="" id="blah" alt="" style="max-width: 50%;margin-top: 10px;">
				                  	</p>
				                  	<span class="help-block"><?php echo e($errors->first("introimage")); ?></span>
				                </div>
				                <!-- /.form-group -->
				                <div class="form-group <?php echo e($errors->has('asign_to') ? 'has-error' : ''); ?>">
						            <label class="required" for="asign_to">Chọn user quản lý</label>
						            <select class="form-control" id="asign_to" name="asign_to">
						            	<option value="">--Chọn user--</option>
						                <?php $__currentLoopData = $listUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                <option value="<?php echo e($item->id); ?>" <?php echo e((old('asign_to') == $item->id) ? 'selected' : ''); ?>><?php echo e($item->email); ?></option>
						                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						            </select>
						            <span class="help-block"><?php echo e($errors->first("asign_to")); ?></span>
						      	</div>
						      	<!-- /.form-group -->
					        </div>
					        <!-- /.col -->
					  	</div>
				  	<!-- /.row -->
					</div>
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
	$('#asign_to').select2();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>