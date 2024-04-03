
<?php $__env->startSection('title', 'Thêm nhà phân phối'); ?>
<?php $__env->startSection('content'); ?>
<section class="content-header">
  <h1>
    Thêm nhà phân phối
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(route('backend.partner.index')); ?>">Danh sách nhà phân phối</a></li>
    <li class="active">Thêm nhà phân phối</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
	      	<?php echo $__env->make('backend.component.partner.add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
</section>
<script type="text/javascript">
  $('#company_id').select2();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>