@foreach($listPartner as $key => $partner)
  <tr role="row" id="partner-{{$partner->id}}" class="{{$key%2 == 0 ? 'even' : 'odd'}}">
	  <td style="text-align: left !important;">{{$partner->name}}</td>
	  <td><input type="number" name="partner[{{$partner->id}}][start]" class="form-control partner-start" value="{{$partner->start}}" onchange="checkResidual(this,'partner', 'start')" onkeyup="changeInputBlock(this, 'partner', 'start')"></td>
	  <td><input type="number" name="partner[{{$partner->id}}][amount]" class="form-control partner-amount" value="{{$partner->amount}}" onchange="checkResidual(this,'partner', 'amount')" onkeyup="changeInputBlock(this, 'partner', 'amount')"></td>
	  <td><input type="number" name="partner[{{$partner->id}}][end]" class="form-control partner-end" value="{{$partner->end}}" onchange="checkResidual(this,'partner', 'end')" onkeyup="changeInputBlock(this, 'partner', 'end')"></td>
	  <td class="text-center">
	    <a href="javascript: void(0);" class="deleteItemBlock" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
	  </td>
	</tr>
@endforeach