
<?php $__env->startSection('title', 'Thêm sản phẩm'); ?>
<?php $__env->startSection('content'); ?>
<section class="content-header">
  <h1>
    Thêm sản phẩm
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(route('backend.product.index')); ?>">Danh sách sản phẩm</a></li>
    <li class="active">Thêm sản phẩm</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<?php echo $__env->make('backend.component.product.add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>