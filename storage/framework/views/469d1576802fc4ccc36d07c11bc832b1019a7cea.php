
<?php $__env->startSection('title', 'Doanh nghiệp'); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">

<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">THÔNG TIN CHI TIẾT BẢO HÀNH
  </ol>
</section>
<section class="content">
<!-- Form nhập tt nhật ký bảo hành -->
<div class="container">
  <h3> Cập nhật thông tin bảo hành</h3>
<form  class="form-horizontal"action="<?php echo e(route('backend.warranty.addhistory')); ?>" method="POST" enctype="multipart/form-data">
	 
	    <input type="hidden" class="form-control" id="email" name="warrantyid" value="<?php echo e($warrantyid); ?>">
	 
    <div class="form-group">
      <label class="control-label col-sm-2" for="email" required>Nội dung yêu cầu:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="content" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd" required>Nội dung xử lý:</label>
      <div class="col-sm-10">          
        <textarea class="form-control" rows="3" id="comment" name="process" required></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email" >kinh phí:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="price" value="0" required>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Ghi lại</button>
      </div>
    </div>
  </form>
</div>



<!-- End of Form nhập tt nhật ký bảo hành -->
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>