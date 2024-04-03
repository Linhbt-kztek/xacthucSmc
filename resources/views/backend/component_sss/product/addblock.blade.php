<input type="hidden" id="url-add-winning" value="{{route('backend.winning.vAdd')}}">
<form id="form-saveBlockProduct" action="{{route('backend.qrcode.saveBlockProduct')}}" method="POST">
  {{csrf_field()}}
  <input type="hidden" id="product-company-id" name="company_id" value="{{$block->company_id}}" >
  <input type="hidden"  id="product-guid" name="guid" value="{{$block->guid}}" >
  <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="text-center">Danh sách sản phẩm đã chia</h3>
        <h3 class="text-center help">{{$block->company->name}} | GUID: {{$block->guid}} | Serial: [{{$block->start}}-{{$block->end}}]</h3>
        <p style="color: #f00;">{{$errors->first()}}</p>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <b>Tổng: {{ $listProduct->total() }} bản ghi</b><br>
                        <p>{{ $listProduct->perPage() }} bản ghi/trang <br> Trang hiện tại: <b>Trang {{ $listProduct->currentPage() }}</b> ({{$listProduct->count()}} bản ghi) </p>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <div class="dataTables_paginate paging_simple_numbers">
        	      			<ul class="pagination">
                                {{ $listProduct->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
                
                <table id="block-product" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="text-center" width="5%">ID</th>
                      <th class="text-center" width="10%">Ảnh</th>
                      <th class="text-center" width="10%">Mã sản phẩm</th>
                      <th class="text-center" width="25%">Tên sản phẩm</th>
                      <th class="text-center" width="12%">Serial đầu</th>
                      <th class="text-center" width="12%">Số lượng</th>
                      <th class="text-center" width="12%">Serial cuối</th>
                      <th class="text-center" width="12%">Thời hạn tem</th>
                      <th class="text-center" width="5%">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($listProduct as $key => $product)
                    <tr role="row" id="product-{{$product->id}}" class="{{$key%2 == 0 ? 'even' : 'odd'}}">
                    <input name="product[{{$key}}][id]" value='{{$product->id}}' type='hidden'>
                    <input name="product[{{$key}}][product_qrcode_id]" value='{{$product->product_qrcode_id}}' type='hidden'>
                    <td> {{$product->id}}</td>
                      <td class="text-center">
                        @if($product->introimage != '')
                        <img src="{{asset($product->introimage)}}" alt="" style="width: 50px; height: 50px">
                        @endif
                      </td>
                      <td class="text-left">{{$product->code}}</td>
                      <td class="text-left">{{$product->name}}</td>
                      <td><input type="number" name="product[{{$key}}][start]" class="form-control product-start" value="{{$product->start}}" onchange="checkResidual(this,'product', 'start')" onkeyup="changeInputBlock(this, 'product', 'start')"></td>
                      <td><input type="number" name="product[{{$key}}][amount]" class="form-control product-amount" value="{{$product->amount}}" onchange="checkResidual(this,'product', 'amount')" onkeyup="changeInputBlock(this, 'product', 'amount')"></td>
                      <td><input type="number" name="product[{{$key}}][end]" class="form-control product-end" value="{{$product->end}}" onchange="checkResidual(this,'product', 'end')" onkeyup="changeInputBlock(this, 'product', 'end')"></td>
                      <td>
                        <select class="form-control" id="protected_time_of_tem_{{$product->id}}" name="product[{{$key}}][protected_time_of_tem]">
                            @for($i=0;$i<100;$i++)
                            <option value="{{$i}}" {{$product->protected_time_of_tem == $i ? 'selected' : ''}}>{{$i.' tháng'}}</option>
                            @endfor
                        </select>
                      </td>
                      <td class="text-center">
                        <a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  
                    @php
                        $total = 0;
                        $residual_product = [];
                        if(!$check['checkProduct']) $residual_product = [[$block->start,$block->end]];
                    @endphp
                    
                    @foreach($all_list_product as $key => $product)
                        @php
                        if($check['checkProduct']) {
                          $start = trim($product->start) != '' ? trim($product->start) : 0;
                          $end = trim($product->end) != '' ? trim($product->end) : 0;
                          if($key == 0 && $start > $block->start) {
                            $residual_product[] = [$block->start,($start - 1)];
                          }
                          if($key > 0 && ($start-1) > $all_list_product[$key-1]->end) {
                            $residual_product[] = [($all_list_product[$key-1]->end + 1), ($start - 1)];
                          }
                          if($key == (count($all_list_product) - 1) && $end < $block->end) {
                            $residual_product[] = [($end + 1), $block->end];
                          }
                        }
                        if ($product->amount != '') {
                          $total += $product->amount;
                        }
                        @endphp
                    @endforeach
                    @php
                        if(count($residual_product) > 0) {
                          foreach($residual_product as $key => $item) {
                            $residual_product[$key] = '['.implode('-', $item).']';
                          }
                        }
                    @endphp
                  <tfoot>
                    <tr>
                      <th rowspan="1" colspan="2" class="text-right">Các khối serial chưa dùng:</th>
                      <td id="residual_product" colspan="8">{{implode(',',$residual_product)}}</td>
                    </tr>
                    <tr>
                      <th rowspan="1" colspan="2" class="text-right">Tổng số tem đã chia:</th>
                      <td id="total-blockproduct" rowspan="1" colspan="7">{{$total}}</td>
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
          <button type="button" class="btn btn-primary mrg-10" onclick="blockAddForm(2)">Thêm sản phẩm mới</button>
          <button type="button" class="btn btn-primary mrg-10" onclick="blockAddForm(4)">Danh sách sản phẩm</button>
          <button type="button" class="btn btn-primary mrg-10" onclick="blockAddWinning()">Tạo giải thưởng</button>
        </div>
    </div>
</form>
<script type="text/javascript">
  $('select[id^="protected_time_of_tem"]').select2();
  
  let addblock_data = {
      page:'{{ $listProduct->currentPage() }}',
      guid:'{{$block->guid}}',
      company_id:'{{$block->company_id}}',
      url_checkResidual:"{{url('/qrcode/block/checkResidual')}}"
  }
</script>