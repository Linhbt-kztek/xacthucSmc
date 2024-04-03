@foreach($listProduct as $key => $product)
  <tr role="row" id="product-{{$product->id}}" class="{{$key%2 == 0 ? 'even' : 'odd'}}">
      <td class="text-left">{{$product->id}}</td>
    <td class="text-center">
      @if($product->introimage != '')
      <img src="{{asset($product->introimage)}}" alt="" style="width: 50px; height: 50px">
      @endif
    </td>
    <td class="text-left">{{$product->code}}</td>
    <td class="text-left">{{$product->name}}</td>
    <td><input type="number" name="product[{{$product->id}}][start]" class="form-control product-start" value="{{$product->start}}" onchange="checkResidual(this,'product', 'start')" onkeyup="changeInputBlock(this, 'product', 'start')"></td>
    <td><input type="number" name="product[{{$product->id}}][amount]" class="form-control product-amount" value="{{$product->amount}}" onchange="checkResidual(this,'product', 'amount')" onkeyup="changeInputBlock(this, 'product', 'amount')"></td>
    <td><input type="number" name="product[{{$product->id}}][end]" class="form-control product-end" value="{{$product->end}}" onchange="checkResidual(this,'product', 'end')" onkeyup="changeInputBlock(this, 'product', 'end')"></td>
    <td>
      <select class="form-control" id="protected_time_of_tem_{{$product->id}}" name="product[{{$product->id}}][protected_time_of_tem]">
          @for($i=1;$i<100;$i++)
          <option value="{{$i}}" {{$product->protected_time_of_tem == $i ? 'selected' : ''}}>{{$i.' tháng'}}</option>
          @endfor
      </select>
    </td>
    <td class="text-center">
      <a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
    </td>
  </tr>
@endforeach