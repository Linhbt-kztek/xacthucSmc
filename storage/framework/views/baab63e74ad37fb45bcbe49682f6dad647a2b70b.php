
<?php $__env->startSection('title', 'User Admin'); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php if(Session::has('msg_user')): ?>
   	<script type="text/javascript">
   	$(function() {
   		jAlert('<?php echo e(Session::get("msg_user")); ?>', 'Thông báo');
   	});
   	</script>
<?php endif; ?>
<section class="content-header">
  <h1>
    Danh sách tài khoản
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách Admin users</li>
  </ol>
</section>
<section class="content">
    
    
    
    <div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-8">
						
						<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
						
													<a class="btn btn-primary" href="<?php echo e(route('backend.user.vAdd')); ?>">Thêm mới tài khoản</a>

		                </div>
						<div class="col-sm-4">
							<div class="dataTables_length pull-right">
								<label>
									Hiện <select class="form-control input-sm showPage">
										<option value="10" <?php echo e($pageSize == 10 ? 'selected' : ''); ?>>10</option>
										<option value="25" <?php echo e($pageSize == 25 ? 'selected' : ''); ?>>25</option>
										<option value="50" <?php echo e($pageSize == 50 ? 'selected' : ''); ?>>50</option>
										<option value="100" <?php echo e($pageSize == 100 ? 'selected' : ''); ?>>100</option>
									</select> dòng/ 1 trang
								</label>
							</div>
						</div>
					</div>
				</div>
				<!-- search form -->
				<form id="search-form" action="<?php echo e(route('backend.user.index')); ?>" method="GET">
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
					        			<label for="sName" class="control-label">Tìm theo tên người đăng ký</label>
					        			<input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo e(isset($filter['fullname']) ? $filter['fullname'] : ''); ?>"> 
			        				</div>
					              <!-- /.form-group -->
					            </div>
				          	</div>
				          	 <div class="row">
					            <div class="col-md-6">
					              	<div class="form-group">
					        			<label for="sName" class="control-label">Tìm theo email</label>
					        			<input type="text" class="form-control" id="email" name="email" value="<?php echo e(isset($filter['email']) ? $filter['email'] : ''); ?>"> 
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
    
    
    
    
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
				  	
						<div class="col-sm-3">
						</div>
				  	</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-1">
								<?php if(Auth::user()->hasAnyRole(1)): ?>
								<button type="button" class="btn btn-danger deleteAll">Delete</button>
								<input type="hidden" id="delUrl" value="<?php echo e(url('user/delete')); ?>">
								<?php endif; ?>
							</div>
							<div class="col-sm-11">
								<div class="dataTables_length pull-right" id="example1_length">
								
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        		<?php if(Auth::user()->hasAnyRole(1)): ?>
							        		<th width="1%">
						                      	<input type="checkbox" id="checkAll">
						                 	</th>
						                 	<?php endif; ?>
							        	    <th width="2%">ID</th>
							        		<th width="15%">Name</th>
							        		<th width="5%">Email</th>
							        		<th width="10%">Tel</th>
							        		<th width="10%">Address</th>
							        		<th width="10%">Type</th>
							        		<?php if(Auth::user()->hasAnyRole([1])): ?>
							        		<th width="2%">Status</th>
							        		<?php endif; ?>
							        		<?php if(Auth::user()->hasAnyRole([1])): ?>
							        		<th width="10%">Action</th>
							        		<?php endif; ?>
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
				              			<tr class="<?php echo e($key%2 == 0 ? 'even' : 'odd'); ?>">
				              				<?php if(Auth::user()->hasAnyRole(1)): ?>
				              				<td>
				              					<input type="checkbox" class="checkItem" value="<?php echo e($item->id); ?>">
			              					</td>
			              					<?php endif; ?>
							            	<td><?php echo e($item->id); ?></td>
							          		<td><?php echo e($item->fullname); ?></td>
							          		<td><?php echo e($item->email); ?></td>
							          		<td><?php echo e($item->tel); ?></td>
								          	<td><?php echo e($item->address); ?></td>
								          	<td><?php echo e($type[$item->is_admin]); ?></td>
								          	<?php if(Auth::user()->hasAnyRole([1])): ?>
								          	<td class="text-center">
								          		<?php if($item->status == 0): ?>
								          		<a href="javascript: void(0);" class="reverseItem" data-id="<?php echo e($item->id); ?>" id="status<?php echo e($item->id); ?>" data-href="<?php echo e(route('backend.user.reverseStatus')); ?>" title="Ẩn"><i class="fa fa-fw fa-question"></i></a>
								          		<?php else: ?>
								          		<a href="javascript: void(0);" class="reverseItem" data-id="<?php echo e($item->id); ?>" id="status<?php echo e($item->id); ?>" data-href="<?php echo e(route('backend.user.reverseStatus')); ?>" title="Hiện"><i class="fa fa-fw fa-check-circle"></i></a>
								          		<?php endif; ?>
								          	</td>
								          	<?php endif; ?>
								          	<?php if(Auth::user()->hasAnyRole([1])): ?>
								          	<td class="text-center">
								          		<a href="<?php echo e(route('backend.user.vEdit',['id'=>$item->id])); ?>" class="editItem" id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a>
								          		<a href="javascript: void(0);" class="deleteItem" id="<?php echo e($item->id); ?>" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
								          	</td>
								          	<?php endif; ?>
								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="9" style="font-style: italic;">Không có dữ liệu</td>
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
	      							<?php echo e($listUser->appends($filter)->links()); ?>

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