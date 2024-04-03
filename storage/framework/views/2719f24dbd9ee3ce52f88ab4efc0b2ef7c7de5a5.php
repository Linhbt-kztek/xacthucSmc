
<?php $__env->startSection('title', 'Sản phẩm'); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('backend/libout/js/product.js')); ?>"></script>
<?php if(Session::has('msg_product')): ?>
   	<script type="text/javascript">
   	$(function() {
   		jAlert('<?php echo e(Session::get("msg_product")); ?>', 'Thông báo');
   	});
   	</script>
<?php endif; ?>
<section class="content-header">
  <h1>
    Danh sách sản phẩm
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách sản phẩm</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-8">
							<?php if(Auth::user()->hasAnyRole([1,2])): ?>
							<button type="button" class="btn btn-danger mrg-r-10 deleteAll">Delete All Checked</button>
							<input type="hidden" id="delUrl" value="<?php echo e(url('product/delete')); ?>">
							<?php endif; ?>
							<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
							<?php if(Auth::user()->hasAnyRole([1,2])): ?>
							<input type="hidden" id="copyUrl" value="<?php echo e(url('product/copy')); ?>">
							<a class="btn btn-primary mrg-r-10" href="<?php echo e(route('backend.product.vAdd')); ?>">Thêm mới sản phẩm</a>
							<?php endif; ?>
						</div>
						<div class="col-sm-4">
							<div class="dataTables_length pull-right" id="example1_length">
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
				<!-- /.box-header --><!-- search form -->
				<form id="search-form" action="<?php echo e(route('backend.product.index')); ?>" method="GET">
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
							            <label class="" for="company_id">Chọn doanh nghiệp</label>
							            <select class="form-control col-md-6" id="company_id" name="company_id" style="width: auto;">
							            	<option value="">--Chọn doanh nghiệp--</option>
							                <?php $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							                <option value="<?php echo e($item->id); ?>" <?php echo e((isset($filter['company_id']) && $filter['company_id'] == $item->id) ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
							                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							            </select>
							      	</div>
							      	<script type="text/javascript">$('#company_id').select2();</script>
					              <!-- /.form-group -->
					            </div>
					            <div class="col-md-6">
					            	<div class="form-group">
							            <label class="" for="protected_time">Chọn thời gian bảo hành</label>
							            <select class="form-control" id="protected_time" name="protected_time" style="width: auto;">
							            	<option value="">--Chọn thời gian bảo hành--</option>
							                <?php for($i=0;$i<100;$i++): ?>
							                <option value="<?php echo e($i); ?>" <?php echo e(isset($filter['protected_time']) && $i == $filter['protected_time'] ? 'selected' : ''); ?>><?php echo e($i.' tháng'); ?></option>
							                <?php endfor; ?>
							            </select>
							      	</div>
							      	<!-- /.form-group -->
					          	</div>
					          	<!-- /.col -->
			            	</div>
				            <!-- /.row -->
				            <div class="row">
				            	<div class="col-md-6">
				            		<div class="form-group">
					        			<label for="sName" class="control-label">Tên sản phẩm:</label>
					        			<input type="text" class="form-control" id="sName" name="name" value="<?php echo e(isset($filter['name']) ? $filter['name'] : ''); ?>">
				        			</div>
				            	</div>
				            	<div class="col-md-6">
				            		<div class="form-group">
					        			<label for="recipient-name" class="control-label">Mã sản phẩm:</label>
					        			<input type="text" class="form-control" id="sCode" name="code" value="<?php echo e(isset($filter['code']) ? $filter['code'] : ''); ?>">
				        			</div>
					              	<!-- /.form-group -->
				            	</div>
				            </div>
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
							        		<?php if(Auth::user()->hasAnyRole([1,2])): ?>
							        		<th width="1%">
						                      	<input type="checkbox" id="checkAll">
						                 	</th>
						                 	<?php endif; ?>
							        	    	<th class="text-center" width="5%">Id</th>
							        		<th class="text-center" width="3%">Mã/barcode</th>
							        		<th class="text-center" width="3%">Batchcode</th>
							        		<th class="text-center" width="30%">Tên Sản Phẩm</th>
							        			<th class="text-center" width="5%">Giá</th>
							        		<th class="text-center" width="20%">Doanh nghiệp</th>
							        		<th class="text-center" width="7%">Ngày sản xuất</th>
							        		<th class="text-center" width="7%">Ngày hết hạn</th>
							        		<th class="text-center" width="5%">Bảo hành</th>
							        		<th class="text-center" width="3%">Mã DT</th>
							        		<?php if(Auth::user()->hasAnyRole([1,2])): ?>
							        		<th class="text-center" width="7%">Tùy chọn</th>
							        		<?php endif; ?>
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
				              			<tr class="<?php echo e($key%2 == 0 ? 'even' : 'odd'); ?>">
				              				<?php if(Auth::user()->hasAnyRole([1,2])): ?>
				              				<td class="text-center">
				              					<input type="checkbox" class="checkItem" value="<?php echo e($item->id); ?>">
			              					</td>
			              					<?php endif; ?>
							          	    <td><?php echo e($item->id); ?></td>
							          		<td class="text-center"><?php echo e($item->code); ?></td>
							          		<td><?php echo e($item->batchcode); ?></td>
							          		<td><?php echo e($item->name); ?></td>
							          			<td><?php echo e($item->price); ?></td>
							          		<td><?php echo e(@$item->company->name); ?></td>
								          	<td class="text-center"><?php echo e(date('d/m/Y',strtotime($item->date_output))); ?></td>
								          	<td class="text-center"><?php echo e(date('d/m/Y',strtotime($item->date_off))); ?></td>
								          	<td class="text-center"><?php echo e($item->protected_time.' tháng'); ?></td>
								          	<td><?php echo e($item->reward); ?></td>
								          	<?php if(Auth::user()->hasAnyRole([1,2])): ?>
								          	<td class="text-center">
								          		
								          		<a href="javascript: void(0);" class="editItem" id="" title="Copy" onclick="copyProduct(<?php echo e($item->id); ?>)"><i class="fa fa-fw fa-copy"></i></a>

								          		<a href="<?php echo e(route('backend.product.vEdit',['id'=>$item->id])); ?>" class="editItem" id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a>

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
	      							<?php echo e($listProduct->appends($filter)->links()); ?>

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
<!-- /modal add-->
<div id="block-add-product">
  <div class="popup-header">
    <button type="button" id="close-popup" class="close"><span aria-hidden="true" style="color: #f00">×</span></button>
    <h4 class="popup-title" id="block-popup-title"></h4>
  </div>
  <div class="popup-body"></div>
</div>
<style type="text/css">
  @media (min-width: 768px) {
      #block-add-product {
        width: 600px;
        margin: 30px auto;
    }
  }
  .popup-header {
    padding: 15px;
    border-bottom: 1px solid #f4f4f4;
  }
  .popup-header .close {
    margin-top: -2px;
  }
  .popup-title {
    margin: 0;
    line-height: 1.42857143;
  }
  .popup-body {
    position: relative;
    padding: 15px;
  }
  #block-add-product{
    display: none;
    width: 600px;
    height: auto;
    position: fixed;
    background: #fff;
    z-index: 1041;
    left: 50%;
    top: 45%;
    transform: translate(-50%, -50%);
  }
  #form-product .select2-container {
    z-index: 1042;
  }
</style>
<script type="text/javascript">
	$('#protected_time').select2();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>