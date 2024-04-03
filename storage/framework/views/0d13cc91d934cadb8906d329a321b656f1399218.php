<?php $__env->startSection('title', 'Block QRCode'); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('backend/libout/js/block.page.js')); ?>"></script>
<section class="content-header">
  <h1>
    Chia khối QRCode
    <small>[<?php echo e(substr($block->guid,0, 38).']'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo e(route('backend.qrcode.index')); ?>">Nhật ký in</a></li>
    <li class="active"><?php echo e($block->company->name); ?></li>
  </ol>
</section>
<input type="hidden" id="block_start" value="<?php echo e($block->start); ?>">
<input type="hidden" id="block_end" value="<?php echo e($block->end); ?>">
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php echo $__env->make('backend.component.partner.addblock', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('backend.component.product.addblock', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
  </div>
</section>
<div id="overlay-loader-layout" class="overlay">
    <div class="loader"></div>
</div>
<input type="hidden" id="getFormUrl" value="<?php echo e(url('qrcode/getForm')); ?>">
<!-- begin modal add -->
<div class="modal fade" id="block-add" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="block-modal-title">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="block-modal-title"></h4>
          </div>
          <div class="modal-body">
          </div>
      </div>
    </div>
</div>

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

<style>
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
    }

    .loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -25px;
        margin-left: -25px;
        animation: spin 2s linear infinite;
    }

    @keyframes  spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes  rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<script>
    let main_layout = {
        show_loader: function() {
            document.getElementById("overlay-loader-layout").style.display = "block";
        },
        hide_loader: function() {
            document.getElementById("overlay-loader-layout").style.display = "none";
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>