<?php
use App\Http\Models\Backend\Qrcode;
?>



<input type="hidden" id="url-add-winning" value="<?php echo e(route('backend.winning.vAdd')); ?>">
<form id="form-saveBlockProduct" action="<?php echo e(route('backend.qrcode.saveBlockProduct')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" id="product-company-id" name="company_id" value="<?php echo e($block->company_id); ?>">
    <input type="hidden" id="product-guid" name="guid" value="<?php echo e($block->guid); ?>">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="text-center">Danh sách sản phẩm đã chia</h3>
            <h3 class="text-center help"><?php echo e($block->company->name); ?> <a target="_blank"
                    href="<?php echo e(route('backend.company.vEdit', ['id' => $block->company->id])); ?>" class="editItem"
                    id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a>| GUID: <?php echo e($block->guid); ?> |
                Serial:
                [<?php echo e($block->start); ?>-<?php echo e($block->end); ?>]</h3>
            <p style="color: #f00;"><?php echo e($errors->first()); ?></p>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <b>Tổng: <?php echo e($listProduct->total()); ?> sản phẩm</b><br>
                            <p><?php echo e($listProduct->perPage()); ?> sản phẩm/trang <br> Trang hiện tại: <b>Trang
                                    <?php echo e($listProduct->currentPage()); ?></b> (<?php echo e($listProduct->count()); ?> sản phẩm) </p>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <?php echo e($listProduct->links()); ?>

                                </ul>
                            </div>
                        </div>
                    </div>







                    <table id="block-product" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="text-center" width="">Mã QR</th>
                                <th class="text-center" width="5%">ID/ Config</th>
                                <th class="text-center" width="5%">Ảnh</th>
                                <th class="text-center" width="10%">Mã sản phẩm</th>
                                <th class="text-center" width="25%">ID/Tên sản phẩm</th>
                                <th class="text-center" width="10%">Serial đầu</th>
                                <th class="text-center" width="10%">Số lượng</th>
                                <th class="text-center" width="10%">Serial cuối</th>
                                <th class="text-center" width="10%">Thời hạn tem</th>
                                <th class="text-center" width="10%">Cấu hình lô tem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $listProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr role="row" id="product-<?php echo e($product->id); ?>"
                                    class="<?php echo e($key % 2 == 0 ? 'even' : 'odd'); ?>">
                                    <td class="text-left">

                                        <a href="#" onclick="$('#qrcode-<?php echo e($product->start); ?>').modal('show')"
                                            class="btn btn-sm btn-warning btn-lg">
                                            <i class="fa fa-qrcode" aria-hidden="true"></i> Xem QR</a>

                                    </td>
                                    <input name="product[<?php echo e($key); ?>][id]" value='<?php echo e($product->id); ?>'
                                        type='hidden'>
                                    <input name="product[<?php echo e($key); ?>][product_qrcode_id]"
                                        value='<?php echo e($product->product_qrcode_id); ?>' type='hidden'>
                                    <td>
                                        <?php echo e($product->id); ?> 
                                    </td>
                                    <td class="text-center">
                                        <?php if($product->introimage != ''): ?>
                                            <img src="<?php echo e(asset($product->introimage)); ?>" alt=""
                                                style="width: 50px; height: 50px">
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-left"><?php echo e($product->code); ?> </td>
                                    <td class="text-left"><a
                                            href="<?php echo e(route('backend.product.vEdit', ['id' => $product->id])); ?>"
                                            class="editItem" id="" title="Sửa sản phẩm này">ID:
                                            <?php echo e($product->id); ?> |</a> <?php echo e($product->name); ?> </td>
                                    <td><input type="number" name="product[<?php echo e($key); ?>][start]"
                                            class="form-control product-start" value="<?php echo e($product->start); ?>"
                                            onchange="checkResidual(this,'product', 'start')"
                                            product_qrcode_id="<?php echo e($product->product_qrcode_id); ?>"
                                            onkeyup="changeInputBlock(this, 'product', 'start')"></td>
                                    <td><input type="number" name="product[<?php echo e($key); ?>][amount]"
                                            class="form-control product-amount" value="<?php echo e($product->amount); ?>"
                                            onchange="checkResidual(this,'product', 'amount')"
                                            product_qrcode_id="<?php echo e($product->product_qrcode_id); ?>"
                                            onkeyup="changeInputBlock(this, 'product', 'amount')"></td>
                                    <td><input type="number" name="product[<?php echo e($key); ?>][end]"
                                            class="form-control product-end" value="<?php echo e($product->end); ?>"
                                            product_qrcode_id="<?php echo e($product->product_qrcode_id); ?>"
                                            onchange="checkResidual(this,'product', 'end')"
                                            onkeyup="changeInputBlock(this, 'product', 'end')"></td>

                                    
                                    <td>
                                        <select class="form-control" id="protected_time_of_tem_<?php echo e($product->id); ?>"
                                            name="product[<?php echo e($key); ?>][protected_time_of_tem]">
                                            <?php for($i = 0; $i < 100; $i++): ?>
                                                <option value="<?php echo e($i); ?>"
                                                    <?php echo e($product->protected_time_of_tem == $i ? 'selected' : ''); ?>>
                                                    <?php echo e($i . ' tháng'); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('backend.qrcode.configserial', ['id' => $product->product_qrcode_id])); ?>" class="editItem" id="" title="Cấu hình hiện thị cho lô tem này"> <i class="fa fa-gears"></i></a>  &nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;
                                        <a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i
                                                class="fa fa-fw fa-remove"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal của phần test thử giao diện trên điên thoại -->
                                <div class="modal fade" id="qrcode-<?php echo e(@$product->start); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->

                                            <?php 
                                                @$urlcode =
                                                    'https://xacthuc.smartcheck.vn/?code=@xtsmc' .
                                                    $block->guid .
                                                    '-' .
                                                    Qrcode::encodeSerial(@$product->start) .
                                                    '&check=test';
                                             ?>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="row" style="height:700px">

                                                    <div class="col-sm-4">
                                                        <h4 class="modal-title">Quét thử mã QR</h4>
                                                        <hr>
                                                        <b> Tên sản phẩm:</b> <?php echo e(@$product->name); ?> <br>
                                                        <b>Mã tem bắt đầu:</b> <?php echo e(@$product->start); ?> <br>
                                                        <b>Mã tem kết thúc:</b> <?php echo e(@$product->end); ?> <br>
                                                        <b>Tổng số tem chia cho sản phẩm này:</b>
                                                        <?php echo e(@$product->amount); ?> <br>
                                                        <hr>
                                                        <a href="<?php echo e($urlcode); ?>" target="_Blank"> Xem trên
                                                            web</a>
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-8" style=" "><span>
                                                            <div
                                                                style="background-image: url(<?php echo e(asset('img/mobile.png')); ?>); background-size: 330px ; background-repeat: no-repeat; padding: 20px; padding-top: 54px; width: 96%; height: 680px;">
                                                                <iframe src="<?php echo e($urlcode); ?>" width="92%"
                                                                    height="575"
                                                                    style="border:none; max-width: 100%"></iframe>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Kết thúc Modal của phần test thử giao diện trên điên thoại -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                        
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="2" class="text-right">Các khối serial chưa dùng:</th>
                                
                                <td id="residual_product" colspan="8"></td>
                            </tr>
                            <tr>
                                <th rowspan="1" colspan="2" class="text-right">Tổng số tem đã chia:</th>
                                
                                <td id="total-blockproduct" rowspan="1" colspan="7"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
            <button type="button" class="btn btn-primary mrg-10" onclick="saveBlockProduct()">Lưu sản phẩm</button>
            <button type="button" class="btn btn-primary mrg-10" onclick="blockAddForm(2)">Thêm sản phẩm
                mới</button>
            <button type="button" class="btn btn-primary mrg-10" onclick="blockAddForm(4)">Danh sách sản
                phẩm</button>
            <button type="button" class="btn btn-primary mrg-10" onclick="blockAddWinning()">Tạo giải
                thưởng</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        callApiCheckResidual('product');
    });
</script>
<script type="text/javascript">
    $('select[id^="protected_time_of_tem"]').select2();

    let addblock_data = {
        page: '<?php echo e($listProduct->currentPage()); ?>',
        guid: '<?php echo e($block->guid); ?>',
        company_id: '<?php echo e($block->company_id); ?>',
        url_checkResidual: "<?php echo e(url('/qrcode/block/checkResidual')); ?>",
        url_delete_block: "<?php echo e(url('qrcode/block/delete/')); ?>",
        all_list_product: <?php echo json_encode($all_list_product); ?>

    }
</script>
