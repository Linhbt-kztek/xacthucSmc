
<?php $__env->startSection('title', 'Lịch sử quét'); ?>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">
    <?php if(Session::has('msg_qrcode')): ?>
        <script type="text/javascript">
            $(function() {
                jAlert('<?php echo e(Session::get('msg_qrcode')); ?>', 'Thông báo');
            });
        </script>
    <?php endif; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


    <section class="content-header">
        <h1>
            Lịch sử quét
            <small><?php echo e(isset($company) ? $company->name : 'Quản lý'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('backend.site.index')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo e(route('backend.qrcode.index')); ?>">Nhật ký in</a></li>
            <li class="active">Lịch sử quét
                <?php echo e(isset($filter['guid']) ? 'GUID: ' . substr($filter['guid'], 0, 8) . '...' : ''); ?>

            </li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-sm-8">
                                <?php if(Auth::user()->hasAnyRole([1, 2])): ?>
                                    <button type="button" class="btn btn-danger mrg-r-10 deleteAll">Delete All
                                        Checked</button>
                                    <input type="hidden" id="delUrl" value="<?php echo e(url('qrcode/deleteActiveQrcode')); ?>">
                                <?php endif; ?>
                                <button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm
                                    kiếm</button>
                                <?php if(Auth::user()->hasAnyRole([1, 2])): ?>
                                    <button class="btn btn-primary mrg-r-10"
                                        onclick="previewQrcodeForm('<?php echo e(route('backend.qrcode.previewQrcode')); ?>')">Tạo mới
                                        kích hoạt</button>
                                    <button class="btn btn-warning mrg-r-10"
                                        onclick="showModalDestroyOrActiveMutipleQrcode()">Tạo
                                        mới kích hoạt hàng
                                        loạt</button>
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
                    <!-- /.box-header -->
                    <form id="search-form" action="<?php echo e(route('backend.qrcode.active')); ?>" method="GET">
                        <div class="box box-default collapsed-box" id="box-search">
                            <div class="box-header with-border hide">
                                <div class="box-tools pull-right">
                                    <button id="collapse-search-form" type="button" class="btn btn-box-tool"
                                        data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <input type="hidden" id="guid_active_id" name="guid"
                                    value="<?php echo e(isset($filter['guid']) ? $filter['guid'] : ''); ?>">
                                <input type="hidden" name="pageSize" id="pageSize" value="<?php echo e($pageSize); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="" for="company_id">Chọn doanh nghiệp</label>
                                            <select class="form-control col-md-6" id="company_id" name="company_id"
                                                onchange="getPartner(this)" style="width: auto;">
                                                <option value="">--Chọn doanh nghiệp--</option>
                                                <?php $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($item->id); ?>"
                                                        <?php echo e(isset($filter['company_id']) && $filter['company_id'] == $item->id ? 'selected' : ''); ?>>
                                                        <?php echo e($item->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <script type="text/javascript">
                                            $('#company_id').select2();
                                        </script>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn nhà phân phối</label>
                                            <select class="form-control" name="partner_id" id="partner_id"
                                                style="width: 100%;">
                                                <option value="">--Chọn nhà phân phối--</option>
                                                <?php if(isset($listPartner)): ?>
                                                    <?php $__currentLoopData = $listPartner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>"
                                                            <?php echo e(isset($filter['partner_id']) && $filter['partner_id'] == $item->id ? 'selected' : ''); ?>>
                                                            <?php echo e($item->text); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
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
                                            <label>Nhập số serial</label>
                                            <input type="number" name="serial"
                                                value="<?php echo e(isset($filter['serial']) ? $filter['serial'] : ''); ?>"
                                                class="form-control">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nhập tên sản phẩm</label>
                                            <input type="text" name="product_name"
                                                value="<?php echo e(isset($filter['product_name']) ? $filter['product_name'] : ''); ?>"
                                                class="form-control">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Thời gian quét từ:</label>
                                            <input type="date" name="start_date"
                                                value="<?php echo e(isset($filter['start_date']) ? $filter['start_date'] : ''); ?>"
                                                class="form-control">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>đến:</label>
                                            <input type="date" name="end_date"
                                                value="<?php echo e(isset($filter['end_date']) ? $filter['end_date'] : ''); ?>"
                                                class="form-control">
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


                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <?php if(Auth::user()->hasAnyRole([1, 2])): ?>
                                                    <th width="1%">
                                                        <input type="checkbox" id="checkAll">
                                                    </th>
                                                <?php endif; ?>
                                                <th width="1%">ID</th>
                                                <th width="10%">Thời gian quét</th>
                                                <th width="20%">Tên Sản phẩm</th>
                                                <th width="10%">Số serial</th>
                                                <th width="22%">Doanh nghiệp</th>
                                                <th width="22%">Nhà Phân phối</th>
                                                <?php if(Auth::user()->hasAnyRole([1, 2])): ?>
                                                    <th width="10%">Tùy chọn</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $listActiveQrcode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr class="<?php echo e($key % 2 == 0 ? 'even' : 'odd'); ?>">
                                                    <?php if(Auth::user()->hasAnyRole([1, 2])): ?>
                                                        <td>
                                                            <input type="checkbox" class="checkItem"
                                                                value="<?php echo e($item->id); ?>">
                                                        </td>
                                                    <?php endif; ?>
                                                    <td><?php echo e($item->id); ?></td>
                                                    <td><?php echo e($item->active_time); ?></td>
                                                    <td><?php echo e($item->product ? $item->product->name : ''); ?></td>
                                                    <td><?php echo e($item->serial); ?></td>
                                                    <td><?php echo e($item->company ? $item->company->name : ''); ?></td>
                                                    <td><?php echo e($item->partner ? $item->partner->name : ''); ?></td>
                                                    <?php if(Auth::user()->hasAnyRole([1, 2])): ?>
                                                        <td class="text-center">
                                                            <a href="javascript: void(0);" class="deleteItem"
                                                                id="<?php echo e($item->id); ?>" title="Xóa"><i
                                                                    class="fa fa-fw fa-remove"></i></a>
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
                                        <?php echo e($listActiveQrcode->appends($filter)->links()); ?>

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
    <!-- begin modal add -->
    <div class="modal fade" id="block-add" tabindex="-1" data-backdrop="static" role="dialog"
        aria-labelledby="block-modal-title">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="block-modal-title"></h4>
                    <script type="text/javascript">
                        $('#company_id').select2();
                    </script>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mutipleActionModal" tabindex="-1" data-backdrop="static" role="dialog"
        aria-labelledby="block-modal-title">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tạo mới kích hoạt hàng loạt</h4>
                </div>
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="required" for="company_id">Chọn doanh nghiệp</label>
                                         <select class="form-control col-md-6" id="mutipleActionModal_company_id" style="width: auto;">
                                            <option value="">--Chọn doanh nghiệp--</option>
                                            <?php $__currentLoopData = $listCompany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>"
                                                    <?php echo e(isset($filter['company_id']) && $filter['company_id'] == $item->id ? 'selected' : ''); ?>>
                                                    <?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <script type="text/javascript">
                                        $('#mutipleActionModal_company_id').select2();
                                    </script>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required" for="name">Nhập serial bắt đầu</label>
                                        <input type="text" class="form-control col-md-3"
                                            id="mutipleActionModal_start_serial" placeholder="Nhập serial bắt đầu">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required" for="name">Nhập serial kết thúc</label>
                                        <input type="text" class="form-control col-md-3"
                                            id="mutipleActionModal_end_serial" placeholder="Nhập serial kết thúc">
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-top: 15px;">
                                    <input type="checkbox" id="get_customer_info" value="true"
                                        onclick="clickShowFormCustomerInfo()">
                                    <span>Nhập thông tin bảo hành</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-danger d-none" id="customerInfo">
                        <div class="box-body">
                            <center>
                                <h4 class="title">Thông tin khách hàng</h4>
                            </center>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="required" for="name">Họ và
                                            tên:</label>
                                        <input type="text" id="modal_customer_name" class="form-control"
                                            placeholder="Nhập họ và tên">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required" for="name">Email:</label>
                                        <input type="text" id="modal_customer_email" class="form-control"
                                            placeholder="Nhập Email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required" for="name">Số điện
                                            thoại:</label>
                                        <input type="number" id="modal_customer_phone" class="form-control"
                                            placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="required" for="name">Địa
                                            chỉ:</label>
                                        <input type="text" id="modal_customer_address" class="form-control"
                                            placeholder="Nhập địa chỉ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center>
                            <button type="button" class="btn btn-primary"
                                onclick="destroyOrActiveMutipleQrcode(1, '<?php echo e(route('backend.qrcode.destroyOrActiveMutipleQrcode')); ?>')">Lưu
                                kích hoạt</button>
                            <button type="button" class="btn btn-danger"
                                onclick="destroyOrActiveMutipleQrcode(2, '<?php echo e(route('backend.qrcode.destroyOrActiveMutipleQrcode')); ?>')">Hủy
                                kích hoạt</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal add-->
    <style>
        .d-none {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $('#partner_id').select2();

        function getPartner(el) {
            if ($(el).val() != '') {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo e(url('qrcode/getDropdownPartner')); ?>' + '/' + $(el).val(),
                    dataType: 'json',
                    success: function(rsp) {
                        $('#partner_id').empty();
                        $('#partner_id').select2({
                            data: rsp
                        });
                    }
                });
            } else {
                $("#partner_id").empty();
                $('#partner_id').select2({
                    data: [{
                        id: '',
                        text: '--Chọn nhà phân phối--'
                    }]
                });
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>