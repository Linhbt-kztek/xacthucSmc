<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <input type="text" id="searchInput" class="form-control" oninput="searchTable()" placeholder="Nhập tên hoặc mã sản phẩm!">
        <table id="block-list-product" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
              <th>ID</th>
              <th>Ảnh</th>
              <th>Mã</th>
              <th>Tên sản phẩm</th>
              <th>Thêm</th>
            </tr>
          </thead>
          <tbody id="block-list-product-tbody">
            <?php $__currentLoopData = $listProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr role="row" id="product-<?php echo e($product->id); ?>" class="<?php echo e($key%2 == 0 ? 'even' : 'odd'); ?>">
              <td class="text-left" width="5%"><?php echo e($product->id); ?></td>
              <td class="text-center" width="15%">
                <?php if($product->introimage != ''): ?>
                <img src="<?php echo e(asset($product->introimage)); ?>" alt="" style="width: 50px; height: 50px">
                <?php endif; ?>
              </td>
              <td class="text-left" width="15%"><?php echo e($product->code); ?></td>
              <td class="text-left" width="40%"><?php echo e($product->name); ?></td>
              <td class="text-center" width="7%">
                <a href="javascript: void(0);" data-id="<?php echo e($product->id); ?>" data-name="<?php echo e($product->name); ?>" data-code="<?php echo e($product->code); ?>" data-img="<?php echo e(asset($product->introimage)); ?>" onclick="addItemToBlock(this, 2)" title="Thêm vào khối"><i class="fa fa-fw fa-plus"></i></a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->