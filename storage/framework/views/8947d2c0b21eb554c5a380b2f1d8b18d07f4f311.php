<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <input type="text" id="searchInputPartner" class="form-control" oninput="searchTablePartner()" placeholder="Nhập tên nhà phân phối!">
        <table id="block-list-partner" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example2_info">
          <tbody>
            <?php $__currentLoopData = $listPartner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr role="row" id="partner-<?php echo e($partner->id); ?>" class="<?php echo e($key%2 == 0 ? 'even' : 'odd'); ?>">
              <td style="text-align: left !important;"><?php echo e($partner->name); ?></td>
              <td class="text-center">
                <a href="javascript: void(0);" data-id="<?php echo e($partner->id); ?>" data-name="<?php echo e($partner->name); ?>" onclick="addItemToBlock(this, 1)" title="Thêm vào khối"><i class="fa fa-fw fa-plus"></i></a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->