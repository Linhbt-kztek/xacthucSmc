<?php
use App\Http\Models\Backend\Qrcode;
?>



<input type="hidden" id="url-add-winning" value="{{ route('backend.winning.vAdd') }}">
<form id="form-saveBlockProduct" action="{{ route('backend.qrcode.saveBlockProduct') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" id="product-company-id" name="company_id" value="{{ $block->company_id }}">
    <input type="hidden" id="product-guid" name="guid" value="{{ $block->guid }}">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="text-center">Danh sách sản phẩm đã chia</h3>
            <h3 class="text-center help">{{ $block->company->name }} <a target="_blank"
                    href="{{ route('backend.company.vEdit', ['id' => $block->company->id]) }}" class="editItem"
                    id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a>| GUID: {{ $block->guid }} |
                Serial:
                [{{ $block->start }}-{{ $block->end }}]</h3>
            <p style="color: #f00;">{{ $errors->first() }}</p>
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
                            <b>Tổng: {{ $listProduct->total() }} sản phẩm</b><br>
                            <p>{{ $listProduct->perPage() }} sản phẩm/trang <br> Trang hiện tại: <b>Trang
                                    {{ $listProduct->currentPage() }}</b> ({{ $listProduct->count() }} sản phẩm) </p>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    {{ $listProduct->links() }}
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
                            @foreach ($listProduct as $key => $product)
                                <tr role="row" id="product-{{ $product->id }}"
                                    class="{{ $key % 2 == 0 ? 'even' : 'odd' }}">
                                    <td class="text-left">

                                        <a href="#" onclick="$('#qrcode-{{ $product->start }}').modal('show')"
                                            class="btn btn-sm btn-warning btn-lg">
                                            <i class="fa fa-qrcode" aria-hidden="true"></i> Xem QR</a>

                                    </td>
                                    <input name="product[{{ $key }}][id]" value='{{ $product->id }}'
                                        type='hidden'>
                                    <input name="product[{{ $key }}][product_qrcode_id]"
                                        value='{{ $product->product_qrcode_id }}' type='hidden'>
                                    <td>
                                        {{ $product->id }} 
                                    </td>
                                    <td class="text-center">
                                        @if ($product->introimage != '')
                                            <img src="{{ asset($product->introimage) }}" alt=""
                                                style="width: 50px; height: 50px">
                                        @endif
                                    </td>
                                    <td class="text-left">{{ $product->code }} </td>
                                    <td class="text-left"><a
                                            href="{{ route('backend.product.vEdit', ['id' => $product->id]) }}"
                                            class="editItem" id="" title="Sửa sản phẩm này">ID:
                                            {{ $product->id }} |</a> {{ $product->name }} </td>
                                    <td><input type="number" name="product[{{ $key }}][start]"
                                            class="form-control product-start" value="{{ $product->start }}"
                                            onchange="checkResidual(this,'product', 'start')"
                                            product_qrcode_id="{{ $product->product_qrcode_id }}"
                                            onkeyup="changeInputBlock(this, 'product', 'start')"></td>
                                    <td><input type="number" name="product[{{ $key }}][amount]"
                                            class="form-control product-amount" value="{{ $product->amount }}"
                                            onchange="checkResidual(this,'product', 'amount')"
                                            product_qrcode_id="{{ $product->product_qrcode_id }}"
                                            onkeyup="changeInputBlock(this, 'product', 'amount')"></td>
                                    <td><input type="number" name="product[{{ $key }}][end]"
                                            class="form-control product-end" value="{{ $product->end }}"
                                            product_qrcode_id="{{ $product->product_qrcode_id }}"
                                            onchange="checkResidual(this,'product', 'end')"
                                            onkeyup="changeInputBlock(this, 'product', 'end')"></td>

                                    {{-- <td><input type="number" name="product[{{ $key }}][sdfasdf]"
                                            class="form-control product-end" value="{{ $product->end }}"></td>
                                    <td><input type="number" name="product[{{ $key }}][sdfasdf]"
                                            class="form-control product-end" value="{{ $product->end }}"></td>
                                    <td><input type="number" name="product[{{ $key }}][sdfasdf]"
                                            class="form-control product-end" value="{{ $product->end }}"></td>
                                    <td><input type="number" name="product[{{ $key }}][sdfasdf]"
                                            class="form-control product-end" value="{{ $product->end }}"></td>
                                    <td><input type="number" name="product[{{ $key }}][sdfasdf]"
                                            class="form-control product-end" value="{{ $product->end }}"></td>
                                    <td><input type="number" name="product[{{ $key }}][sdfasdf]"
                                            class="form-control product-end" value="{{ $product->end }}"></td> --}}
                                    <td>
                                        <select class="form-control" id="protected_time_of_tem_{{ $product->id }}"
                                            name="product[{{ $key }}][protected_time_of_tem]">
                                            @for ($i = 0; $i < 100; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $product->protected_time_of_tem == $i ? 'selected' : '' }}>
                                                    {{ $i . ' tháng' }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('backend.qrcode.configserial', ['id' => $product->product_qrcode_id]) }}" class="editItem" id="" title="Cấu hình hiện thị cho lô tem này"> <i class="fa fa-gears"></i></a>  &nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;
                                        <a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i
                                                class="fa fa-fw fa-remove"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal của phần test thử giao diện trên điên thoại -->
                                <div class="modal fade" id="qrcode-{{ @$product->start }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->

                                            @php
                                                @$urlcode =
                                                    'https://xacthuc.smartcheck.vn/?code=@xtsmc' .
                                                    $block->guid .
                                                    '-' .
                                                    Qrcode::encodeSerial(@$product->start) .
                                                    '&check=test';
                                            @endphp
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="row" style="height:700px">

                                                    <div class="col-sm-4">
                                                        <h4 class="modal-title">Quét thử mã QR</h4>
                                                        <hr>
                                                        <b> Tên sản phẩm:</b> {{ @$product->name }} <br>
                                                        <b>Mã tem bắt đầu:</b> {{ @$product->start }} <br>
                                                        <b>Mã tem kết thúc:</b> {{ @$product->end }} <br>
                                                        <b>Tổng số tem chia cho sản phẩm này:</b>
                                                        {{ @$product->amount }} <br>
                                                        <hr>
                                                        <a href="{{ $urlcode }}" target="_Blank"> Xem trên
                                                            web</a>
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-8" style=" "><span>
                                                            <div
                                                                style="background-image: url({{ asset('img/mobile.png') }}); background-size: 330px ; background-repeat: no-repeat; padding: 20px; padding-top: 54px; width: 96%; height: 680px;">
                                                                <iframe src="{{ $urlcode }}" width="92%"
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
                            @endforeach
                        </tbody>

                        {{-- @php
                            $total = 0;
                            $residual_product = [];
                            if (!$check['checkProduct']) {
                                $residual_product = [[$block->start, $block->end]];
                            }
                        @endphp

                        @foreach ($all_list_product as $key => $product)
                            @php
                                if ($check['checkProduct']) {
                                    $start = trim($product->start) != '' ? trim($product->start) : 0;
                                    $end = trim($product->end) != '' ? trim($product->end) : 0;
                                    if ($key == 0 && $start > $block->start) {
                                        $residual_product[] = [$block->start, $start - 1];
                                    }
                                    if ($key > 0 && $start - 1 > $all_list_product[$key - 1]->end) {
                                        $residual_product[] = [$all_list_product[$key - 1]->end + 1, $start - 1];
                                    }
                                    if ($key == count($all_list_product) - 1 && $end < $block->end) {
                                        $residual_product[] = [$end + 1, $block->end];
                                    }
                                }
                                if ($product->amount != '') {
                                    $total += $product->amount;
                                }
                            @endphp
                        @endforeach
                        @php
                            if (count($residual_product) > 0) {
                                foreach ($residual_product as $key => $item) {
                                    $residual_product[$key] = '[' . implode('-', $item) . ']';
                                }
                            }
                        @endphp --}}
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="2" class="text-right">Các khối serial chưa dùng:</th>
                                {{-- <td id="residual_product" colspan="8">{{ implode(',', $residual_product) }}</td> --}}
                                <td id="residual_product" colspan="8"></td>
                            </tr>
                            <tr>
                                <th rowspan="1" colspan="2" class="text-right">Tổng số tem đã chia:</th>
                                {{-- <td id="total-blockproduct" rowspan="1" colspan="7">{{ $total }}</td> --}}
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
        page: '{{ $listProduct->currentPage() }}',
        guid: '{{ $block->guid }}',
        company_id: '{{ $block->company_id }}',
        url_checkResidual: "{{ url('/qrcode/block/checkResidual') }}",
        url_delete_block: "{{ url('qrcode/block/delete/') }}",
        all_list_product: {!! json_encode($all_list_product) !!}
    }
</script>
