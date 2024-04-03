
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('keywords', 'Dashboard'); ?>
<?php $__env->startSection('description', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<style>
    .clock {
    border: 2px solid black;
    background-color: rgb(255 255 255);
    box-shadow: 0px 0px 16px rgb(0 0 0 / 50%);
    visibility: hidden;
    width: 360px;
    height: 360px;
    background: url('https://best-tutorials.github.io/analog-clock/images/oclock_bg.png');
    background-size: 100%;
    border-radius: 50%;
    top: 15%;
    right: 25%;
    position: absolute;
    padding: 2rem;
  }
  
  .clock-face {
    position: relative;
    width: 100%;
    height: 100%;
  }
  
  .hand {
    width: 190px;
    height: 20px;
    background-repeat: no-repeat;
    background-size: 190px 14px;
    background-position: right center;
    transform-origin: 150px 10px;
    position: absolute;
    top: calc(50% - 10px);
    right: calc( 50% - 40px);
    transform: rotate(90deg);
  }
  
  .hour-hand {
    background-image: url(https://best-tutorials.github.io/analog-clock/images/hour_oclock.png);

  }
  
  .min-hand {
    background-image: url(https://best-tutorials.github.io/analog-clock/images/minute_oclock.png);
  }
  
  .second-hand {
    background-image: url(https://best-tutorials.github.io/analog-clock/images/second_oclock.png);
  
  }
    
</style>
<section class="content">
  <!-- Small boxes (Stat box) -->
  <!-- /.row (main row) -->
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
        <small>HỆ THỐNG:::</small><BR><b>QUẢN TRỊ TEM XÁC THỰC & BẢO HÀNH ĐIỆN TỬ</b><br>
        <small><?php if(Auth::user()->hasAnyRole([2])): ?>
          Tên doanh nghiệp: <b> <?php echo e(Auth::user()->company->name); ?> </b>
          <?php endif; ?>
          <?php if(Auth::user()->hasAnyRole([1])): ?>
          Khu vực quản trị chính của Admin
          <?php endif; ?></small>
      
      
     

  
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản trị hệ thống</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
       <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo e($company); ?></h3>

              <p>DOANH NGHIỆP</p>
            </div>
            <div class="icon">
            <i class="icon ion-compass"></i>	            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/company/index" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo e(number_format($product)); ?></h3>

              <p>SẢN PHẨM</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/product/index" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo e(number_format($partner)); ?><sup style="font-size: 20px"></sup></h3>

              <p>NHÀ PHÂN PHỐI</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/partner/index" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo e($user); ?></h3>

              <p>TÀI KHOẢN</p>
            </div>
            <div class="icon">
             <i class="icon ion-plus-circled"></i>	
            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/user/index" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
            
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3> <?php echo e($qrcode); ?></h3>

              <p>TỔNG LÔ IN</p>
              
            </div>
            <div class="icon">
             <i class="icon ion-plus-circled"></i>	
            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/qrcode/index" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3> <?php echo e(number_format($activeqrcode)); ?></h3>

              <p>TỔNG XÁC THỰC</p>
            </div>
            <div class="icon">
             <i class="icon ion-plus-circled"></i>	
            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/qrcode/active" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo e(number_format($warranty)); ?></h3>

              <p>ĐĂNG KÝ BẢO HÀNH</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/warranty/index" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo e(number_format($totalcode)); ?></h3>

              <p>MÃ CODE XÁC THỰC ĐÃ IN</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="https://xacthuc.smartcheck.vn/admin/qrcode/index" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
       
   
        
        
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
          
          
          
          
          
          
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            


          <!-- Custom tabs (Charts with tabs)-->
          <!-- /.nav-tabs-custom -->

          
          


<!-- START CUSTOM TABS -->

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-11" data-toggle="tab">Hôm nay</a></li>
              <li><a href="#tab_2-21" data-toggle="tab">Tuần này</a></li>
              <li><a href="#tab_3-21" data-toggle="tab">Tháng này</a></li>
              
              <li class="pull-left header"><i class="fa fa-th"></i>Bảo hành</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-11">
                <b>Ngày hôm nay:</b>
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        	<th scope="col">Tên sản phẩm</th>
                                              <th scope="col">Mã </th>
                                              <th scope="col">Ngày kích hoạt</th>
						                      <th scope="col">Tên khách hàng</th>
                                              <th scope="col">Nhà phân phối</th>

                                            
							        	
							        	
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				              			<tr>
				              			    
				              			  	<td style="text-align:left">
				              			  	    <a class="hiddenTab" title="XEM CHI TIẾT" href="<?php echo e(route('backend.warranty.history',['warranty_id' => $item->id])); ?>" ><?php echo e($item->SP_ten); ?></a>
				              			  	    <span class="only-print" ><?php echo e($item->SP_ten); ?></span>
				              			  	</td>
								          	<td><?php echo e($item->SP_ma); ?></td>
								          	<td><?php echo e(\Carbon\Carbon::parse($item->BH_time)->format('d/m/Y g:i:s A')); ?></td>
								          	<td style="text-transform:uppercase"><b><?php echo e($item->fullname); ?></b></td>
								          	<td><?php echo e($item->Nha_pp); ?></td>

								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    <?php endif; ?>
							       	</tbody>
				      			</table>

               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-21">
                  <b>Tuần này:</b>
               								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        	<th scope="col">Tên sản phẩm</th>
                                              <th scope="col">Mã </th>
                                              <th scope="col">Ngày kích hoạt</th>
						                      <th scope="col">Tên khách hàng</th>
                                              <th scope="col">Nhà phân phối</th>

                                            
							        	
							        	
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				              			<tr>
				              			    
				              			  	<td style="text-align:left">
				              			  	    <a class="hiddenTab" title="XEM CHI TIẾT" href="<?php echo e(route('backend.warranty.history',['warranty_id' => $item->id])); ?>" ><?php echo e($item->SP_ten); ?></a>
				              			  	    <span class="only-print" ><?php echo e($item->SP_ten); ?></span>
				              			  	</td>
								          	<td><?php echo e($item->SP_ma); ?></td>
								          	<td><?php echo e(\Carbon\Carbon::parse($item->BH_time)->format('d/m/Y g:i:s A')); ?></td>
								          	<td style="text-transform:uppercase"><b><?php echo e($item->fullname); ?></b></td>
								          	<td><?php echo e($item->Nha_pp); ?></td>

								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    <?php endif; ?>
							       	</tbody>
				      			</table>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-21">
                  <b>Tháng này:</b>
                								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        	<th scope="col">Tên sản phẩm</th>
                                              <th scope="col">Mã </th>
                                              <th scope="col">Ngày kích hoạt</th>
						                      <th scope="col">Tên khách hàng</th>
                                              <th scope="col">Nhà phân phối</th>

                                            
							        	
							        	
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				              			<tr>
				              			    
				              			  	<td style="text-align:left">
				              			  	    <a class="hiddenTab" title="XEM CHI TIẾT" href="<?php echo e(route('backend.warranty.history',['warranty_id' => $item->id])); ?>" ><?php echo e($item->SP_ten); ?></a>
				              			  	    <span class="only-print" ><?php echo e($item->SP_ten); ?></span>
				              			  	</td>
								          	<td><?php echo e($item->SP_ma); ?></td>
								          	<td><?php echo e(\Carbon\Carbon::parse($item->BH_time)->format('d/m/Y g:i:s A')); ?></td>
								          	<td style="text-transform:uppercase"><b><?php echo e($item->fullname); ?></b></td>
								          	<td><?php echo e($item->Nha_pp); ?></td>

								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    <?php endif; ?>
							       	</tbody>
				      			</table>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-1" data-toggle="tab">Hôm nay</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Tuần này</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Tháng này</a></li>
              
              <li class="pull-left header"><i class="fa fa-th"></i>Xác thực</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                <b>Hôm nay</b>

               								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        	<th scope="col">Tên sản phẩm</th>
                                              <th scope="col">Mã </th>
                                              <th scope="col">Ngày kích hoạt</th>
						                      <th scope="col">Tên khách hàng</th>
                                              <th scope="col">Nhà phân phối</th>

                                            
							        	
							        	
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				              			<tr>
				              			    
				              			  	<td style="text-align:left">
				              			  	    <a class="hiddenTab" title="XEM CHI TIẾT" href="<?php echo e(route('backend.warranty.history',['warranty_id' => $item->id])); ?>" ><?php echo e($item->SP_ten); ?></a>
				              			  	    <span class="only-print" ><?php echo e($item->SP_ten); ?></span>
				              			  	</td>
								          	<td><?php echo e($item->SP_ma); ?></td>
								          	<td><?php echo e(\Carbon\Carbon::parse($item->BH_time)->format('d/m/Y g:i:s A')); ?></td>
								          	<td style="text-transform:uppercase"><b><?php echo e($item->fullname); ?></b></td>
								          	<td><?php echo e($item->Nha_pp); ?></td>

								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    <?php endif; ?>
							       	</tbody>
				      			</table>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                  <b>Tuần này:</b>
               								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        	<th scope="col">Tên sản phẩm</th>
                                              <th scope="col">Mã </th>
                                              <th scope="col">Ngày kích hoạt</th>
						                      <th scope="col">Tên khách hàng</th>
                                              <th scope="col">Nhà phân phối</th>

                                            
							        	
							        	
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				              			<tr>
				              			    
				              			  	<td style="text-align:left">
				              			  	    <a class="hiddenTab" title="XEM CHI TIẾT" href="<?php echo e(route('backend.warranty.history',['warranty_id' => $item->id])); ?>" ><?php echo e($item->SP_ten); ?></a>
				              			  	    <span class="only-print" ><?php echo e($item->SP_ten); ?></span>
				              			  	</td>
								          	<td><?php echo e($item->SP_ma); ?></td>
								          	<td><?php echo e(\Carbon\Carbon::parse($item->BH_time)->format('d/m/Y g:i:s A')); ?></td>
								          	<td style="text-transform:uppercase"><b><?php echo e($item->fullname); ?></b></td>
								          	<td><?php echo e($item->Nha_pp); ?></td>

								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    <?php endif; ?>
							       	</tbody>
				      			</table>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
                  <b>Tháng này:</b>
               								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        	<th scope="col">Tên sản phẩm</th>
                                              <th scope="col">Mã </th>
                                              <th scope="col">Ngày kích hoạt</th>
						                      <th scope="col">Tên khách hàng</th>
                                              <th scope="col">Nhà phân phối</th>

                                            
							        	
							        	
						        		</tr>
				        			</thead>
				        			<tbody>
				        				<?php $__empty_1 = true; $__currentLoopData = $listHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				              			<tr>
				              			    
				              			  	<td style="text-align:left">
				              			  	    <a class="hiddenTab" title="XEM CHI TIẾT" href="<?php echo e(route('backend.warranty.history',['warranty_id' => $item->id])); ?>" ><?php echo e($item->SP_ten); ?></a>
				              			  	    <span class="only-print" ><?php echo e($item->SP_ten); ?></span>
				              			  	</td>
								          	<td><?php echo e($item->SP_ma); ?></td>
								          	<td><?php echo e(\Carbon\Carbon::parse($item->BH_time)->format('d/m/Y g:i:s A')); ?></td>
								          	<td style="text-transform:uppercase"><b><?php echo e($item->fullname); ?></b></td>
								          	<td><?php echo e($item->Nha_pp); ?></td>

								        </tr>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    <?php endif; ?>
							       	</tbody>
				      			</table>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->

          <!-- TO DO List -->
         
          <!-- /.box -->

     <!-- /.info-box -->
          <!-- /.box -->
          


          <!-- quick email widget -->
          
          



        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Đồng hồ 
              </h3>
            </div>
            <div class="box-body" style="height: 400px; background: white; text-align: center">
                <div class="clock">
                    <div class="clock-face">
                      <div class="hand hour-hand"></div>
                      <div class="hand min-hand"></div>
                      <div class="hand second-hand"></div>
                    </div>
                </div>
              </div>
            <!-- /.box-body-->
          </div>
          
          <!-- /.box -->
        <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Vùng xác thực
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label">Exists</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
          </div>


          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 350px;"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Mail-Orders</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">In-Store</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

          <!-- Calendar -->
          <!-- /.box -->

        </section>
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <!-- /.box -->




          <!-- solid sales graph -->
          <!-- /.box -->

          <!-- Calendar -->
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

<script>
/// Đồng hồ/////////////
    const secondHand = document.querySelector(".second-hand");
const minsHand = document.querySelector(".min-hand");
const hourHand = document.querySelector(".hour-hand");
const clockContainer =  document.querySelector(".clock");

function analogClock() {
  const now = new Date();

  const miliseconds = now.getMilliseconds();
  const seconds = now.getSeconds();
  const secondsDegrees = (seconds+(miliseconds/1000)) /  60 * 360  + 90;
  secondHand.style.transform = `rotate(${secondsDegrees}deg)`;

  const mins = now.getMinutes();
  const minsDegrees = mins / 60 * 360 + seconds / 60 * 6 + 90;
  minsHand.style.transform = `rotate(${minsDegrees}deg)`;

  const hour = now.getHours();
  const hourDegrees = hour / 12 * 360 + mins / 60 * 30 + 90;
  hourHand.style.transform = `rotate(${hourDegrees}deg)`;
}

const delay = 1000;
function initialAnalogClock(){
     clockContainer.style.visibility = 'visible';
    analogClock();
    setInterval(analogClock,delay);
}
initialAnalogClock();
</script>

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>