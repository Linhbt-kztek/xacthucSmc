
<?php $__env->startSection('title', 'QRCode'); ?>
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
    Nhật ký in
    <small><?php echo e(isset(Auth::user()->company) ? Auth::user()->company->name : 'Quản trị in qr code'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Nhật ký in</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-6">
							
							<?php if(Auth::user()->hasAnyRole([1])): ?>
							<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
							<a class="btn btn-primary mrg-r-10" href="<?php echo e(route('backend.qrcode.vAdd')); ?>">Tạo mới khối QRCode</a>
							<?php endif; ?>
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
				<form id="search-form" action="<?php echo e(route('backend.qrcode.index')); ?>" method="GET">
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
				              	<?php if(Auth::user()->hasAnyRole([1])): ?>
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
						      	<?php endif; ?>
			            	</div>
			            	<!-- Em Công vừa thêm mới mục tìmkiếm theo ngày --------->
			            	  <div class="row">
					            <div class="col-md-1">
					              	
					        			  <label for="begin">Ngày đầu</label>
                                            <input class="form-control" type="date" id="begin" name="start_date">
                                </div>
                                <div class="col-md-1">
                                            		  <label for="end">Ngày cuối</label>
                                            <input class="form-control" type="date" id="end" name="end_date"> 
                                	
					              <!-- /.form-group -->
					            </div>
					           
				          	</div>
				          	<!-- End of Em Công vừa thêm mới mục tìmkiếm theo ngày -->
				          	
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
							        		
						                 	<th>STT</th>
							        		<th>KHỐI CODE</th>
							        		<th>Doanh nghiệp</th>
							        		<th>Đối tác</th>
							        		<th>Tiền tố</th>
							        		<th>Serial đầu</th>
							        		<th>Serial cuối</th>
							        		<th>Ngày tạo</th>
							        		<th>Tùy chọn</th>
						        		</tr>
				        			</thead>
				        			<tbody>
				        			    
				        				<?php $__empty_1 = true; $__currentLoopData = $listQrcode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
				              			<tr class="<?php echo e($key%2 == 0 ? 'even' : 'odd'); ?>">
				              				
			              					<td><?php echo e($key+1); ?></td>
							          		<td style="text-align: left !important;"><a href="<?php echo e(route('backend.qrcode.block',['company_id' => $item->company_id, 'guid' => $item->guid])); ?>" title="BẤM VÀO ĐÂY ĐỂ CHI KHỐI CHO SẢN PHẨM & NHÀ PHÂN PHỐI"><?php echo e($item->guid); ?></a></td>
							          		<td>
							          		    
							          		    
							          		    <a href="<?php echo e(route('backend.qrcode.block',['company_id' => $item->company_id, 'guid' => $item->guid])); ?>"> <?php echo e(@$item->company->name); ?></a>
							          		   
							          		    </td>
							          		<td><?php echo e($item->note); ?></td>
							          		<td><?php echo e($item->prefix); ?></td>
								          	<td><?php echo e($item->start); ?></td>
								          	<td><?php echo e($item->end); ?></td>
								          	<td><?php echo e($item->created_at); ?></td>
								          	<td class="text-center">
								          		<a href="<?php echo e(route('backend.qrcode.active',['guid' => $item->guid])); ?>" class="editItem" id="<?php echo e($item->id); ?>" title="Nhật ký quét qrcode" target="_blank" style="margin-right: 10px"><i class="fa fa-eye"></i></a>
								          		<a href="<?php echo e(route('backend.qrcode.block',['company_id' => $item->company_id, 'guid' => $item->guid])); ?>" class="editItem" id="<?php echo e($item->id); ?>" title="Cấu hình block"><i class="fa fa-gears"></i></a>
								          		<?php if(Auth::user()->hasAnyRole([1])): ?>
								          		<!-- <a href="<?php echo e(route('backend.qrcode.exportQrcode',['guid' => $item->guid, 'type' => 1])); ?>" title="Xuất file Excel theo định dạng Smartcheck App" style="margin-left: 10px"><img src="<?php echo e(asset('icon/icon-excel.png')); ?>" alt=""></a>-->
								          		<a href="<?php echo e(route('backend.qrcode.exportQrcode',['guid' => $item->guid, 'type' => 2])); ?>" title="Xuất file Excel theo định dạng Open App" style="margin-left: 10px"><img src="<?php echo e(asset('icon/icon-excel.png')); ?>" alt=""></a>
								          		<?php endif; ?>
								          		<?php if(Auth::user()->hasAnyRole([1,2])): ?>
								          		<!-- <a href="javascript: void(0);" title="Tạo giải thưởng" onclick="blockAddWinning()" style="margin-left: 10px"><img src="<?php echo e(asset('icon/winning-icon.png')); ?>" style="width: 16px; height: 18px;" alt=""></a> -->
								          		<?php endif; ?>
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
	      							<?php echo e($listQrcode->appends($filter)->links()); ?>

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