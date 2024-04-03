@extends('backend.layouts.main')
@section('title', 'Khóa code')
@section('content')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
@if (Session::has('msg_qrcode'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_qrcode")}}', 'Thông báo');
   	});
   	</script>
@endif


<section class="content-header">
  <h1>
    Khóa mã code
    <small>Dùng cho việc khóa code nào đó mà không muốn hiện thị kết quả quét  {{isset($company) ? $company->name : ''}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('backend.qrcode.index')}}">Nhật ký in</a></li>
    <li class="active">Lịch sử quét {{isset($filter['guid']) ? 'GUID: '.substr($filter['guid'], 0, 8).'...' : ''}}</li>

  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-6">
							@if(Auth::user()->hasAnyRole([1,2]))
							<button type="button" class="btn btn-danger mrg-r-10 deleteAll">Delete All Checked</button>
							<input type="hidden" id="delUrl" value="{{url('qrcode/deleteActiveQrcode')}}">
							@endif
							<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
							@if(Auth::user()->hasAnyRole([1,2]))
							<button class="btn btn-primary" onclick="previewQrcodeForm('{{route('backend.qrcode.previewQrcode')}}')">Tạo khóa code mới</button>
							@endif
						</div>
						<div class="col-sm-6">
							<div class="dataTables_length pull-right" id="example1_length">
								<label>
									Show <select class="form-control input-sm showPage">
										<option value="10" {{$pageSize == 10 ? 'selected' : ''}}>10</option>
										<option value="25" {{$pageSize == 25 ? 'selected' : ''}}>25</option>
										<option value="50" {{$pageSize == 50 ? 'selected' : ''}}>50</option>
										<option value="100" {{$pageSize == 100 ? 'selected' : ''}}>100</option>
									</select> entries
								</label>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<form id="search-form" action="{{route('backend.qrcode.islock')}}" method="GET">
					<div class="box box-default collapsed-box" id="box-search">
				        <div class="box-header with-border hide">
				          <div class="box-tools pull-right">
				            <button id="collapse-search-form" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				          </div>
				        </div>
				        <!-- /.box-header -->
				        <div class="box-body">
				        	<input type="hidden" id="guid_active_id" name="guid" value="{{isset($filter['guid']) ? $filter['guid'] : ''}}">
				        	<input type="hidden" name="pageSize" id="pageSize" value="{{$pageSize}}">
			          		<div class="row">
					            <div class="col-md-6">
							    	<div class="form-group">
							            <label class="" for="company_id">Chọn doanh nghiệp</label>
							            <select class="form-control col-md-6" id="company_id" name="company_id" onchange="getPartner(this)" style="width: auto;">
							            	<option value="">--Chọn doanh nghiệp--</option>
							                @foreach($listCompany as $item)
							                <option value="{{$item->id}}" {{(isset($filter['company_id']) && $filter['company_id'] == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
							                @endforeach
							            </select>
							      	</div>
							      	<script type="text/javascript">$('#company_id').select2();</script>
					              <!-- /.form-group -->
					            </div>
					            <div class="col-md-6">
					              <div class="form-group">
					                <label>Chọn nhà phân phối</label>
					                <select class="form-control" name="partner_id" id="partner_id" style="width: 100%;">
					                  	<option value="">--Chọn nhà phân phối--</option>
					                  	@if(isset($listPartner))
					                  	@foreach($listPartner as $item)
						                <option value="{{$item->id}}" {{(isset($filter['partner_id']) && $filter['partner_id'] == $item->id) ? 'selected' : '' }}>{{$item->text}}</option>
						                @endforeach
						                @endif
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
					                <input type="number" name="serial" value="{{isset($filter['serial']) ? $filter['serial'] : ''}}" class="form-control">
					              </div>
					              <!-- /.form-group -->
					            </div>
					            <div class="col-md-6">
					              <div class="form-group">
					                <label>Nhập tên sản phẩm</label>
					                <input type="text" name="product_name" value="{{isset($filter['product_name']) ? $filter['product_name'] : ''}}" class="form-control">
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
					                <input type="date" name="start_date" value="{{isset($filter['start_date']) ? $filter['start_date'] : ''}}" class="form-control">
					              </div>
					              <!-- /.form-group -->
					            </div>
					            <div class="col-md-6">
					              <div class="form-group">
					                <label>đến:</label>
					                <input type="date" name="end_date" value="{{isset($filter['end_date']) ? $filter['end_date'] : ''}}" class="form-control">
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
						<H3>DANH SÁCH CÁC MÃ CODE ĐÃ BỊ KHÓA</H3>
						<div class="row">
							<div class="col-sm-12">
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        		@if(Auth::user()->hasAnyRole([1,2]))
							        		<th width="1%">
						                      	<input type="checkbox" id="checkAll">
						                 	</th>
						                 	@endif
						                 		<th width="1%">ID</th>
							        		<th width="10%">Thời gian quét</th>
							        		<th width="20%">Tên Sản phẩm</th>
							        		<th width="10%">Số serial</th>
							        		<th width="22%">Doanh nghiệp</th>
							        	  <th> Trạng thái</th>
							        		<th width="30%">Nội dung thông báo</th>
							        		@if(Auth::user()->hasAnyRole([1,2]))
							        		<th width="10%">Tùy chọn</th>
							        		@endif
						        		</tr>
				        			</thead>
				        			<tbody>
				        				@forelse ($listActiveQrcode as $key => $item) 
				              			<tr class="{{$key%2 == 0 ? 'even' : 'odd'}}">
				              				@if(Auth::user()->hasAnyRole([1,2]))
				              				<td>
				              					<input type="checkbox" class="checkItem" value="{{$item->id}}">
			              					</td>
			              					@endif
			              						<td>{{$item->id}}</td>
							          		<td>{{$item->active_time}}</td>
							          		<td>{{$item->product ? $item->product->name : ''}}</td>
								          	<td>{{$item->serial}}</td>
								          	<td>{{$item->company ? $item->company->name : ''}}</td>
								          	<td> <span style=" color:{{$item->islock == 1 ? 'red' : 'green'}}"> <i class="fa fa-fw fa-{{$item->islock == 1 ? 'lock' : 'unlock'}}"></i></span> </td>
								          	<td>{{$item->message}}</td>
							          		@if(Auth::user()->hasAnyRole([1,2]))
								          	<td class="text-center">
								          	    <a href="{{route('backend.qrcode.islockedit',['id' => $item->id])}}" title="Sửa thông tin"><i class="fa fa-fw fa-edit"></i></a>
								          	
								          	</td>
							          		@endif
								        </tr>
								        @empty
								    	<tr class="even">
								    		<td colspan="9" style="font-style: italic;">Không có dữ liệu</td>
								    	</tr>
									    @endforelse
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
	      							{{ $listActiveQrcode->appends($filter)->links() }}
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
<div class="modal fade" id="block-add" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="block-modal-title">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="block-modal-title"></h4>
          </div>
          <div class="modal-body">
          </div>
      </div>
    </div>
</div>
<!-- /modal add-->
<script type="text/javascript">
	$('#partner_id').select2();
	function getPartner(el) {
		if($(el).val() != '') {
			$.ajax({
				type: 'GET',
				url: '{{url("qrcode/getDropdownPartner")}}' + '/' + $(el).val(),
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
				data: [
					{
						id: '',
						text: '--Chọn nhà phân phối--'
					}
				]
			});
		}
	}
</script>
@stop