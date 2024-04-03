@extends('backend.layouts.main')
@section('title', 'Nhà phân phối')
@section('content')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
@if (Session::has('msg_partner'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_partner")}}', 'Thông báo');
   	});
   	</script>
@endif
<section class="content-header">
  <h1>
    Danh sách nhà phân phối
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách nhà phân phối</li>
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
							<input type="hidden" id="delUrl" value="{{url('partner/delete')}}">
							@endif
							<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
							@if(Auth::user()->hasAnyRole([1,2]))
							<a class="btn btn-primary mrg-r-10" href="{{route('backend.partner.vAdd')}}">Thêm mới nhà phân phối</a>
							@endif
						</div>
						<div class="col-sm-4">
							<div class="dataTables_length pull-right">
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
				<!-- search form -->
				<form id="search-form" action="{{route('backend.partner.index')}}" method="GET">
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
							            <select class="form-control col-md-6" id="company_id" name="company_id" style="width: auto;">
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
					        			<label for="sName" class="control-label">Tên nhà phân phối:</label>
					        			<input type="text" class="form-control" id="sName" name="name" value="{{isset($filter['name']) ? $filter['name'] : ''}}">
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
						                 	<th width="2%">ID</th>
							        		<th width="20%">Tên nhà phân phối</th>
							        		<th width="20%">Thuộc doanh nghiệp</th>
							        		<th width="10%">Email</th>
							        		<th width="15%">SĐT</th>
							        		<th width="25%">Địa chỉ</th>
							        		@if(Auth::user()->hasAnyRole([1,2]))
							        		<th width="7%">Tùy chọn</th>
							        		@endif
						        		</tr>
				        			</thead>
				        			<tbody>
				        				@forelse ($listPartner as $key => $item)
				              			<tr class="{{$key%2 == 0 ? 'even' : 'odd'}}">
				              				@if(Auth::user()->hasAnyRole([1,2]))
				              				<td>
				              					<input type="checkbox" class="checkItem" value="{{$item->id}}">
			              					</td>
			              					@endif
			              					<td>{{$item->id}}</td>
							          		<td>{{$item->name}}</td>
							          		<td>{{@$item->company->name}}</td>
								          	<td>{{$item->email}}</td>
								          	<td>{{$item->tel}}</td>
								          	<td>{{$item->address}}</td>
								          	@if(Auth::user()->hasAnyRole([1,2]))
								          	<td class="text-center">
								          		<a href="{{route('backend.partner.vEdit',['id'=>$item->id])}}" class="editItem" id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a>
								          		<a href="javascript: void(0);" class="deleteItem" id="{{$item->id}}" title="Xóa"><i class="fa fa-fw fa-remove"></i></a>
								          	</td>
								          	@endif
								        </tr>
								        @empty
								    	<tr class="even">
								    		<td colspan="11" style="font-style: italic;">Không có dữ liệu</td>
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
	      							{{ $listPartner->appends($filter)->links() }}
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
@stop