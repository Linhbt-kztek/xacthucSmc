
<?php $__env->startSection('title', 'Gia hạn tem'); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php if(Session::has('msg_qrcode')): ?>
   	<script type="text/javascript">
   	$(function() {
   		jAlert('<?php echo e(Session::get("msg_qrcode")); ?>', 'Thông báo');
   	});
   	</script>
<?php endif; ?>
<section class="content-header">
  <h1>
    Gia hạn tem
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(route('backend.qrcode.index')); ?>">Nhật ký in</a></li>
    <li class="active">Gia hạn tem</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-6">
							<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
						</div>
						<div class="col-sm-6">
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
				<!-- /.box-header -->
				<!-- search form -->
				<form id="search-form" action="<?php echo e(route('backend.report.indexGiahantem')); ?>" method="GET">
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
							            <select class="form-control col-md-6" id="company_id" name="company_id" onchange="getPartner(this)" style="width: auto;">
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
					                <label>Chọn thời gian</label>
					                <select class="form-control" name="protected_time_of_tem" id="protected_time_of_tem_search" style="width: 100%;">
					                  	<option value="">--Chọn thời gian--</option>
					                  	<?php for($i=2;$i<37;$i++): ?>
			                            <option value="<?php echo e($i); ?>" <?php echo e((isset($filter['protected_time_of_tem']) && $filter['protected_time_of_tem'] == $i) ? 'selected' : ''); ?>><?php echo e($i.' tháng'); ?></option>
			                            <?php endfor; ?>
					                </select>
					              </div>
					              <!-- /.form-group -->
					          	</div>
					          	<!-- /.col -->
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
							        	<tr role="row">
					                      	<th class="text-center" width="8%">Ảnh</th>
					                      	<th class="text-center" width="8%">Mã sản phẩm</th>
					                      	<th class="text-center" width="20%">Tên sản phẩm</th>
					                      	<th class="text-center" width="8%">Thời gian bảo hành SP</th>
					                      	<th class="text-center" width="20%">Thời gian kích hoạt lần đầu</th>
					                      	<th class="text-center" width="5%">Serial đầu</th>
					                      	<th class="text-center" width="5%">Số lượng</th>
					                      	<th class="text-center" width="5%">Serial cuối</th>
					                      	<th class="text-center" width="10%">Thời hạn tem</th>
					                      	<th class="text-center" width="5%">Tùy chọn</th>
					                    </tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
				              			<tr class="<?php echo e($key%2 == 0 ? 'even' : 'odd'); ?>">
			              					<td class="text-center">
						                        <?php if(isset($item->product) && $item->product->introimage != ''): ?>
						                        <img src="<?php echo e(asset($item->product->introimage)); ?>" alt="" style="width: 50px; height: 50px">
						                        <?php endif; ?>
					                      	</td>
					                      	<td class="text-left"><?php echo e(isset($item->product) ? $item->product->code : ''); ?></td>
					                      	<td class="text-left"><?php echo e(isset($item->product) ? $item->product->name : ''); ?></td>
					                      	<td class="text-left"><?php echo e(isset($item->product) ? $item->product->protected_time.' tháng' : ''); ?></td>
					                      	<td class="text-left"><?php echo e($item->created_at); ?></td>
					                      	<td><?php echo e($item->start); ?></td>
					                      	<td><?php echo e($item->amount); ?></td>
					                      	<td><?php echo e($item->end); ?></td>
					                      	<td class="text-center">
						                        <select class="form-control" id="protected_time_of_tem_<?php echo e($item->product_id); ?>">
						                            <?php for($i=1;$i<100;$i++): ?>
						                            <option value="<?php echo e($i); ?>" <?php echo e($item->protected_time_of_tem == $i ? 'selected' : ''); ?>><?php echo e($i.' tháng'); ?></option>
						                            <?php endfor; ?>
						                        </select>
					                      	</td>
								          	<td class="text-center">
								          		<a href="javascript: void(0);" data-href="<?php echo e(route('backend.report.refreshTime')); ?>" class="editItem refreshTime" data-productid="<?php echo e($item->product_id); ?>" data-companyid="<?php echo e(isset($item->company) ? $item->company->id : ''); ?>" data-guid="<?php echo e($item->guid); ?>" title="Gia hạn tem"><i class="fa fa-refresh"></i></a>
								          	</td>
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
<style type="text/css">
	.select2-container{margin: auto;}
</style>
<script type="text/javascript">
	$('[id^="protected_time_of_tem_"]').select2();
	$('#protected_time_of_tem_search').select2();
	$(function() {
		$('.refreshTime').click(function() {
			$.ajax({
				url: $(this).attr("data-href"),
				type: "POST",
				async: false,
				data: {
					guid: $(this).attr("data-guid"), 
					product_id: $(this).attr("data-productid"),
					company_id: $(this).attr("data-companyid"),
					protected_time_of_tem: $('#protected_time_of_tem_'+$(this).attr("data-productid")).val()
				},
				dataType: 'json',
				success: function(resp) {
					if(resp.error) {
						jAlert('Không tìm thấy yêu cầu của bạn!', 'Thông báo');
					} else {
						jAlert('Gia hạn thành công!', 'Thông báo');
					}
				}
			});
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>