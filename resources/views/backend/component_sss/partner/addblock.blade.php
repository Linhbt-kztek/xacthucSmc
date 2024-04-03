<form id="form-saveBlockPartner" action="{{route('backend.qrcode.saveBlockPartner')}}" method="POST">
  {{csrf_field()}}
  <input type="hidden" id="partner-company-id" name="company_id" value="{{$block->company_id}}" >
  <input type="hidden"  id="partner-guid" name="guid" value="{{$block->guid}}" >
  <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="text-center">Danh sách nhà phân phối đã chia</h3>
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
                <table id="block-partner" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="text-center" width="30%">Tên nhà phân phối</th>
                      <th class="text-center" width="15%">Serial đầu</th>
                      <th class="text-center" width="15%">Số lượng</th>
                      <th class="text-center" width="15%">Serial cuối</th>
                      <th class="text-center" width="5%">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $total = 0;
                    $residual_partner = [];
                    if(!$check['checkPartner']) $residual_partner = [[$block->start,$block->end]];
                    @endphp
                    @foreach($listPartner as $key => $partner)
                    @php
                    if($check['checkPartner']) {
                      $start = trim($partner->start) != '' ? trim($partner->start) : 0;
                      $end = trim($partner->end) != '' ? trim($partner->end) : 0;
                      if($key == 0 && $start > $block->start) {
                        $residual_partner[] = [$block->start,($start - 1)];
                      }
                      if($key > 0 && ($start-1) > $listPartner[$key-1]->end) {
                        $residual_partner[] = [($listPartner[$key-1]->end + 1), ($start - 1)];
                      }
                      if($key == (count($listPartner) - 1) && $end < $block->end) {
                        $residual_partner[] = [($end + 1), $block->end];
                      }
                    }
                    if ($partner->amount != '') {
                      $total += $partner->amount;
                    }
                    @endphp
                    <tr role="row" id="partner-{{$partner->id}}" class="{{$key%2 == 0 ? 'even' : 'odd'}}">
                      <input name="partner[{{$key}}][id]" value="{{$partner->id}}" type="hidden">
                      <td style="text-align: left !important;">{{$partner->name}}</td>
                      <td><input type="number" name="partner[{{$key}}][start]" class="form-control partner-start" value="{{$partner->start}}" onchange="checkResidual(this,'partner', 'start')" onkeyup="changeInputBlock(this, 'partner', 'start')"></td>
                      <td><input type="number" name="partner[{{$key}}][amount]" class="form-control partner-amount" value="{{$partner->amount}}" onchange="checkResidual(this,'partner', 'amount')" onkeyup="changeInputBlock(this, 'partner', 'amount')"></td>
                      <td><input type="number" name="partner[{{$key}}][end]" class="form-control partner-end" value="{{$partner->end}}" onchange="checkResidual(this,'partner', 'end')" onkeyup="changeInputBlock(this, 'partner', 'end')"></td>
                      <td class="text-center">
                        <a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    @php
                    if(count($residual_partner) > 0) {
                      foreach($residual_partner as $key => $item) {
                        $residual_partner[$key] = '['.implode('-', $item).']';
                      }
                    }
                    @endphp
                    <tr>
                      <th rowspan="1" class="text-right">Các khối serial chưa dùng:</th>
                      <td id="residual_partner" colspan="5">{{implode(',',$residual_partner)}}</td>
                    </tr>
                    <tr>
                      <th rowspan="1" class="text-right">Tổng số tem đã chia:</th>
                      <td id="total-blockpartner" rowspan="1" colspan="4">{{$total}}</td>
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
          <button type="button" class="btn btn-primary mrg-10" onclick="saveBlockPartner()">Lưu nhà phân phối</button>
          <button type="button" class="btn btn-primary mrg-10" onclick="blockAddForm(1)">Thêm nhà phân phối mới</button>
          <button type="button" class="btn btn-primary mrg-10" onclick="blockAddForm(3)">Danh sách nhà phân phối</button>
        </div>
    </div>
</form>