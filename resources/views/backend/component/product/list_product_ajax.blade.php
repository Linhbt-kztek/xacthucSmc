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
            @foreach($listProduct as $key => $product)
            <tr role="row" id="product-{{$product->id}}" class="{{$key%2 == 0 ? 'even' : 'odd'}}">
              <td class="text-left" width="5%">{{$product->id}}</td>
              <td class="text-center" width="15%">
                @if($product->introimage != '')
                <img src="{{asset($product->introimage)}}" alt="" style="width: 50px; height: 50px">
                @endif
              </td>
              <td class="text-left" width="15%">{{$product->code}}</td>
              <td class="text-left" width="40%">{{$product->name}}</td>
              <td class="text-center" width="7%">
                <a href="javascript: void(0);" data-id="{{$product->id}}" data-name="{{$product->name}}" data-code="{{$product->code}}" data-img="{{asset($product->introimage)}}" onclick="addItemToBlock(this, 2)" title="Thêm vào khối"><i class="fa fa-fw fa-plus"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->