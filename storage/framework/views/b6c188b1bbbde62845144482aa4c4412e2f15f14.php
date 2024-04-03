
<?php $__env->startSection('title', 'Doanh nghiệp'); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php if(Session::has('msg_company')): ?>
   	<script type="text/javascript">
   	$(function() {
   		jAlert('<?php echo e(Session::get("msg_company")); ?>', 'Thông báo');
   	});
   	</script>
<?php endif; ?>
<section class="content-header">
  <h1>
    Danh sách doanh nghiệp
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách doanh nghiệp</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-8">
							<?php if(Auth::user()->hasAnyRole([1])): ?>
							<button type="button" class="btn btn-danger mrg-r-10 deleteAll">Delete All Checked</button>
							<input type="hidden" id="delUrl" value="<?php echo e(url('company/delete')); ?>">
							<?php endif; ?>
							<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
							<?php if(Auth::user()->hasAnyRole([1])): ?>
							<a class="btn btn-primary mrg-r-10" href="<?php echo e(route('backend.company.vAdd')); ?>">Thêm mới doanh nghiệp</a>
							<?php endif; ?>
						</div>
						<div class="col-sm-4">
							<div class="dataTables_length pull-right">
								<label>
									Show <select class="form-control input-sm showPage">
										<option value="10" <?php echo e($pageSize == 10 ? 'selected' : ''); ?>>10</option>
										<option value="25" <?php echo e($pageSize == 25 ? 'selected' : ''); ?>>25</option>
										<option value="50" <?php echo e($pageSize == 50 ? 'selected' : ''); ?>>50</option>
										<option value="100" <?php echo e($pageSize == 100 ? 'selected' : ''); ?>>100</option>
									</select> entries
								</label>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<!-- search form -->
				<form id="search-form" action="<?php echo e(route('backend.company.index')); ?>" method="GET">
					<div class="box box-default collapsed-box" id="box-search">
				        <div class="box-header with-border hide">
				          <div class="box-tools pull-right">
				            <button id="collapse-search-form" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				          </div>
				        </div>
				        <!-- /.box-header -->
				        <div class="box-body">
				        	<input type="hidden" name="pageSize" id="pageSize" value="<?php echo e($pageSize); ?>">
				            <div class="row">
					            <div class="col-md-6">
					              	<div class="form-group">
					        			<label for="sName" class="control-label">Tên doanh nghiệp:</label>
					        			<input type="text" class="form-control" id="sName" name="name" value="<?php echo e(isset($filter['name']) ? $filter['name'] : ''); ?>">
			        				</div>
					              <!-- /.form-group -->
					            </div>
				          	</div>
				          	<!-- /.row -->
				        </div>
				        <!-- /.box-body -->
				        <div class="box-footer text-center">
				          	<button type="submit" class="btn btn-primary mrg-10">Tìm kiếm</button>
				        </div>
			      	</div>
			  	</form>
				<!-- /search form -->
				<div class="box-body">
					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-12">
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        		<?php if(Auth::user()->hasAnyRole([1])): ?>
							        		<th width="1%">
						                      	<input type="checkbox" id="checkAll">
						                 	</th>
						                 	<?php endif; ?>
						                 	<th width="1%">ID</th>
							        		<th width="15%">Tên doanh nghiệp</th>
							        		<th width="7%">Mã số thuế</th>
							        		<th width="15%">Địa chỉ</th>
							        		<th width="7%">SĐT</th>
							        		
							        		<th width="7%">Email</th>
							        		
							        		<?php if(Auth::user()->hasAnyRole([1,2])): ?>
							        		<th width="7%">Tùy chọn</th>
							        		<?php endif; ?>
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				              			<tr class="<?php echo e($key%2 == 0 ? 'even' : 'odd'); ?>">
				              				<?php if(Auth::user()->hasAnyRole([1])): ?>
				              				<td>
				              					<input type="checkbox" class="checkItem" value="<?php echo e($item->id); ?>">
			              					</td>
			              					<?php endif; ?>
			              					<td><?php echo e($item->id); ?></td>
							          		<td><a href="<?php echo e(route('backend.qrcode.index',['company_id' => $item->id])); ?>" title="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></a></td>
							          		<td><?php echo e($item->code_tax); ?></td>
							          		<td><?php echo e($item->address); ?></td>
								          	<td><?php echo e($item->tel); ?></td>
								          	
								          	<td><?php echo e($item->email); ?></td>
								          	
								          	<?php if(Auth::user()->hasAnyRole([1,2])): ?>
								          	<td class="text-center">
								          		<a href="<?php echo e(route('backend.company.vEdit',['id'=>$item->id])); ?>" class="editItem" id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a>
								          		<?php if(Auth::user()->hasAnyRole([1])): ?>
								          		<a href="javascript: void(0);" class="deleteItem" id="<?php echo e($item->id); ?>" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
								          		<?php endif; ?>
								          	</td>
								          	<?php endif; ?>
								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    <?php endif; ?>
							       	</tbody>
				      			</table>
			      			</div>
		      			</div>
		      			<div class="row">
		      				<div class="col-sm-5">
		      					<!-- <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 50 entries</div> -->
	      					</div>
	      					<div class="col-sm-7">
	      						<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
	      							<?php echo e($listCompany->appends($filter)->links()); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>