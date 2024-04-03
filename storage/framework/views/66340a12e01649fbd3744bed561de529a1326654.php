	

                    
	<div class="box box-primary">
	    <!-- /.box-header -->
	    <div class="box-body">
	      	<div class="row">
		        <div class="col-md-12">
			    	<div class="form-group">
			            <label class="required" for="company_renderQrcode">Chọn doanh nghiệp</label>
			            <select class="form-control col-md-6 select2" id="company_renderQrcode" name="company_renderQrcode" onchange="renderQrcode()" style="width: auto;">
			            	<option value="">--Chọn doanh nghiệp--</option>
			                <?php $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			            </select>
			      	</div>
			      	
			      	
			      
			      	
			      	<script type="text/javascript">
			      	$('#company_renderQrcode').select2({
                        dropdownParent: $('#block-add')
                    });
			      	   
			      	 </script>
			      	<!-- /.form-group -->
		        	<div class="form-group">
		              	<label class="required" for="name">Nhập số serial</label>
		              	<input type="text" class="form-control col-md-6" onkeyup="renderQrcode()" name="serial" id="serial" placeholder="Nhập số serial">
		            </div>
		            <!-- /.form-group -->
		          	<div class="form-group hide" id="showQrcode">
	                  	<label style="color: #f00; font-weight: normal; text-align: center;width: 100%; margin-top: 10px;">Vui lòng quét mã QRCode bên dưới để kích hoạt sản phẩm</label>
	                  	<p class="text-center">
	                  		<img src="" id="blah" alt="" style="margin-top: 10px;">
	                  	</p>
	                  	<div id="showurl">(*)</div>
	                <script type="text/javascript">	$('#showQrcode');</script>
	                

	                </div>
	                <!-- /.form-group -->
		        </div>
		        <!-- /.col -->
		  	</div>
	  	<!-- /.row -->
		</div>
	    <!-- /.box-body -->
	    <div class="box-footer text-center">
        	<button type="button" class="btn btn-primary mrg-10" onclick="destroyOrActive(1)">Lưu kích hoạt</button>
        	<button type="button" class="btn btn-primary mrg-10" onclick="destroyOrActive(2)">Hủy kích hoạt</button>
      	</div>
  	</div>
<script type="text/javascript">
	function renderQrcode() {
	   
		if($('#company_renderQrcode').val() == '') {
			jAlert('Bạn chưa chọn doanh nghiệp nào', 'Thông báo', function(){
		    	$('#serial').val('');
		    	$('#blah').attr('src', '');
				$('#showQrcode').addClass('hide');
			});				
			return false;
		} else if($('#serial').val() == '') {
			$('#blah').attr('src', '');
			$('#showQrcode').addClass('hide');
			return false;
		} else {
		     //alert($('#blah').attr('src', rsp._src));
		    
			$.ajax({
				type: 'POST',
				url: '<?php echo e(route("backend.qrcode.renderQrcode")); ?>',
				data: {company_id: $('#company_renderQrcode').val(), serial: $('#serial').val()},
				dataType: 'json',
				success: function(rsp) {
					if(rsp.msg == '') {
						$('#blah').attr('src', rsp._src);
						$('#showQrcode').removeClass('hide');
						$('#showurl').attr('src', rsp._src);
						
					   jAlert(url);
					} else {
						jAlert(rsp.msg, 'Thông báo', function() {
							$('#blah').attr('src', '');
							$('#showQrcode').addClass('hide');
							$('#showurl').attr('src', '');
					
						});
						
						return false;
					}
				}
			});
		}
	}
	function destroyOrActive(type) {
		if($('#company_renderQrcode').val() == '') {
			jAlert('Bạn chưa chọn doanh nghiệp nào', 'Thông báo');				
			return false;
		} else if($('#serial').val() == '') {
			jAlert('Bạn chưa nhập số serial', 'Thông báo');	
			return false;
		} else {
			$.ajax({
				type: 'POST',
				url: '<?php echo e(route("backend.qrcode.destroyOrActiveQrcode")); ?>',
				data: {company_id: $('#company_renderQrcode').val(), serial: $('#serial').val(), type: type},
				dataType: 'json',
				success: function(rsp) {
					if(rsp.msg == '') {
						location.reload();
					} else {
						jAlert(rsp.msg, 'Thông báo', function() {
							$('#blah').attr('src', '');
							$('#showQrcode').addClass('hide');
						});
						return false;
					}
				}
			});
		}
	}
</script>