@extends('backend.layouts.main')
@section('title', 'Danh sách các giải thưởng')
@section('content')

<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
@if (Session::has('msg_winning'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_winning")}}', 'Thông báo');
   	});
   	</script>
@endif
<section class="content-header">
  <h1>
    Danh sách các giải thưởng
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách các giải thưởng</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-8">
							@if(Auth::user()->hasAnyRole([1,2]))
							<button type="button" class="btn btn-danger mrg-r-10 deleteAll">Delete All Checked</button>
							<input type="hidden" id="delUrl" value="{{url('winning/delete')}}">
							@endif
							<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
							@if(Auth::user()->hasAnyRole([1,2]))
							<!-- <a class="btn btn-primary mrg-r-10" href="{{route('backend.winning.vAdd')}}">Tạo giải thưởng</a> -->
							@endif
						</div>
						<div class="col-sm-4">
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
				<!-- /.box-header --><!-- search form -->
				<form id="search-form" action="{{route('backend.winning.index')}}" method="GET">
					<div class="box box-default collapsed-box" id="box-search">
				        <div class="box-header with-border hide">
				          <div class="box-tools pull-right">
				            <button id="collapse-search-form" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				          </div>
				        </div>
				        <!-- /.box-header -->
				        <div class="box-body">
				        	<input type="hidden" name="pageSize" id="pageSize" value="{{$pageSize}}">
			          		<div class="row">
					            <div class="col-md-6">
							    	<div class="form-group">
							            <label class="" for="company_id">Chọn doanh nghiệp</label>
							            <select class="form-control col-md-6" id="company_id" name="company_id" onchange="getProduct(this)" style="width: auto;">
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
					                <label>Chọn sản phẩm</label>
					                <select class="form-control" name="product_id" id="product_id" style="width: 100%;">
					                  	<option value="">--Chọn sản phẩm--</option>
					                  	@if(isset($listProduct))
					                  	@foreach($listProduct as $item)
						                <option value="{{$item->id}}" {{(isset($filter['product_id']) && $filter['product_id'] == $item->id) ? 'selected' : '' }}>{{$item->text}}</option>
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
					            <div class="col-md-12">
					              <div class="form-group">
					                <label>Tên giải thưởng:</label>
					                <input type="text" name="name" value="{{isset($filter['name']) ? $filter['name'] : ''}}" class="form-control">
					              </div>
					              <!-- /.form-group -->
					            </div>
				          	</div>
				          	<!-- /.row -->
				            <div class="row">
					            <div class="col-md-6">
					              <div class="form-group">
					                <label>Thời gian bắt đầu:</label>
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
				<!-- /search form -->
				<div class="box-body">
					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
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
						                 	<th class="text-center" width="25%">Sản phẩm</th>
							        		<th class="text-center" width="20%">Tên giải thưởng</th>
							        		<th class="text-center" width="10%">Giá trị giải thưởng</th>
							        		<th class="text-center" width="7%">Ngày bắt đầu</th>
							        		<th class="text-center" width="7%">Ngày kết thúc</th>
							        		<th class="text-center" width="7%">Số serial</th>
							        		<th class="text-center" width="5%">Số lượng</th>
							        		<th class="text-center" width="5%">Đã trao giải</th>
							        		@if(Auth::user()->hasAnyRole([1,2]))
							        		<th class="text-center" width="7%">Tùy chọn</th>
							        		@endif
						        		</tr>
				        			</thead>
				        			<tbody>
				        				@forelse ($listWinning as $key => $item) 
				              			<tr class="{{$key%2 == 0 ? 'even' : 'odd'}}">
				              				@if(Auth::user()->hasAnyRole([1,2]))
				              				<td class="text-center">
				              					<input type="checkbox" class="checkItem" value="{{$item->id}}">
			              					</td>
			              					@endif
							          		<td >
							          			@if($item->product)
							          			@if($item->product->introimage != "")
							          			<img width="50%" src="{{asset($item->product->introimage)}}">
							          			@else 
							          			<img width="50%" src="{{asset('backend/libout/images/noimage.png')}}">
							          			@endif
							          			{{$item->product->name}}
							          			@endif
							          		</td>
							          		<td>{{$item->name}}</td>
							          		<td>{{number_format($item->total_prize)}} VNĐ</td>
							          		<td class="text-center">{{date('d/m/Y',strtotime($item->start_date))}}</td>
								          	<td class="text-center">{{date('d/m/Y',strtotime($item->end_date))}}</td>
								          	<td class="text-center">{{$item->serial}}</td>
								          	<td class="text-center">{{$item->amount}}</td>
								          	<td class="text-center">{{$item->pay_winning != '' ? $item->pay_winning : 0}}</td>
								          	@if(Auth::user()->hasAnyRole([1,2]))
								          	<td class="text-center">

								          		<!-- <a href="{{route('backend.winning.vEdit',['id'=>$item->id])}}" class="editItem" id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a> -->

								          		<a href="javascript: void(0);" class="deleteItem" id="{{$item->id}}" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
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
	      							{{ $listWinning->appends($filter)->links() }}
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
<!-- /modal add-->
<div id="block-add-product">
  <div class="popup-header">
    <button type="button" id="close-popup" class="close"><span aria-hidden="true" style="color: #f00">×</span></button>
    <h4 class="popup-title" id="block-popup-title"></h4>
  </div>
  <div class="popup-body"></div>
</div>
<style type="text/css">
  @media (min-width: 768px) {
      #block-add-product {
        width: 600px;
        margin: 30px auto;
    }
  }
  .popup-header {
    padding: 15px;
    border-bottom: 1px solid #f4f4f4;
  }
  .popup-header .close {
    margin-top: -2px;
  }
  .popup-title {
    margin: 0;
    line-height: 1.42857143;
  }
  .popup-body {
    position: relative;
    padding: 15px;
  }
  #block-add-product{
    display: none;
    width: 600px;
    height: auto;
    position: fixed;
    background: #fff;
    z-index: 1041;
    left: 50%;
    top: 45%;
    transform: translate(-50%, -50%);
  }
  #form-product .select2-container {
    z-index: 1042;
  }
</style>
<script type="text/javascript">
	$('#product_id').select2();
	function getProduct(el) {
		if($(el).val() != '') {
			$.ajax({
				type: 'GET',
				url: '{{url("winning/getDropdownProduct")}}' + '/' + $(el).val(),
				dataType: 'json',
				success: function(rsp) {
					$('#product_id').empty();
					$('#product_id').select2({
						data: rsp
					});
				}
			});
		} else {
			$("#product_id").empty();
			$('#product_id').select2({
				data: [
					{
						id: '',
						text: '--Chọn sản phẩm--'
					}
				]
			});
		}
	}
</script>
@stop