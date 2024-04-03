@extends('backend.layouts.main')
@section('title', 'User')
@section('content')

<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
@if (Session::has('msg_user'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_user")}}', 'Thông báo');
   	});
   	</script>
@endif
<section class="content-header">
  <h1>
    Danh sách users
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách users</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-3">
							<button class="btn btn-primary" data-toggle="modal" data-target="#search">Tìm kiếm</button>
						</div>
				  	</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-1">
								@if(Auth::user()->hasAnyRole('backend.user.delete'))
								<button type="button" class="btn btn-danger deleteAll">Delete</button>
								<input type="hidden" id="delUrl" value="{{url('admin/user/delete')}}">
								@endif
							</div>
							<div class="col-sm-11">
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
						<div class="row">
							<div class="col-sm-12">
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        		@if(Auth::user()->hasAnyRole('backend.user.delete'))
							        		<th width="1%">
						                      	<input type="checkbox" id="checkAll">
						                 	</th>
						                 	@endif
						                 		<th width="2%">ID</th>
							        		<th width="25%">Name</th>
							        		<th width="25%">Email</th>
							        		<th width="10%">Tel</th>
							        		<th width="10%">Address</th>
							        		<th width="10%">User Id</th>
							        		<th width="10%">Device Id</th>
							        		@if(Auth::user()->hasAnyRole(['backend.user.vEdit']))
							        		<th width="2%">Status</th>
							        		@endif
							        		@if(Auth::user()->hasAnyRole(['backend.user.vEdit','backend.user.delete']))
							        		<th width="10%">Action</th>
							        		@endif
						        		</tr>
				        			</thead>
				        			<tbody>
				        				@forelse ($listUser as $key => $item) 
				              			<tr class="{{$key%2 == 0 ? 'even' : 'odd'}}">
				              				@if(Auth::user()->hasAnyRole('backend.user.delete'))
				              				<td>
				              					<input type="checkbox" class="checkItem" value="{{$item->id}}">
			              					</td>
			              					@endif
			              					<td>{{$item->id}}</td>
							          		<td>{{$item->fullname}}</td>
							          		<td>{{$item->email}}</td>
							          		<td>{{$item->tel}}</td>
								          	<td>{{$item->address}}</td>
								          	<td>{{$item->user_id}}</td>
								          	<td>{{$item->device_id}}</td>
								          	@if(Auth::user()->hasAnyRole(['backend.user.vEdit']))
								          	<td class="text-center">
								          		@if($item->status == 0)
								          		<a href="javascript: void(0);" class="reverseItem" data-id="{{$item->id}}" id="status{{$item->id}}" data-href="{{route('backend.user.reverseStatus')}}" title="Ẩn"><i class="fa fa-fw fa-question"></i></a>
								          		@else
								          		<a href="javascript: void(0);" class="reverseItem" data-id="{{$item->id}}" id="status{{$item->id}}" data-href="{{route('backend.user.reverseStatus')}}" title="Hiện"><i class="fa fa-fw fa-check-circle"></i></a>
								          		@endif
								          	</td>
								          	@endif
								          	@if(Auth::user()->hasAnyRole('backend.user.delete'))
								          	<td class="text-center">
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
	      							{{ $listUser->appends($filter)->links() }}
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
<!-- begin modal -->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="exampleModalLabel">Tìm kiếm</h4>
      		</div>
  			<div class="form-group">
      			<form id="searchForm" action="{{route('backend.sinhvien.index')}}">
	      			<div class="modal-body">
	      				<div class="form-group">
	      					<span style="text-decoration: underline;color: #f00;">Chú ý:</span>
	      					<span>Để tối ưu kết quả tìm kiếm, hệ thống phân biệt <b style="color: #f00;">CÓ DẤU và KHÔNG DẤU</b>. (Ví dụ: "Anh" khác với "Ánh")</span>
	      				</div>
	      				<div class="form-group">
		        			<label for="smsv" class="control-label">Mã SV:</label>
		        			<input type="text" class="form-control" id="sMsv" name="idmsv" value="{{isset($filter['idmsv']) ? $filter['idmsv'] : ''}}">
		        			<input type="hidden" name="pageSize" id="sPageSize" value="{{$pageSize}}">
	        			</div>
	        			<div class="form-group">
		        			<label for="sName" class="control-label">Tên sinh viên:</label>
		        			<input type="text" class="form-control" id="sName" name="name" value="{{isset($filter['name']) ? $filter['name'] : ''}}">
	        			</div>
	      			</div>
      			</form>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		<button type="button" id="searchBtn" class="btn btn-primary">Tìm kiếm</button>
      		</div>
    	</div>
  	</div>
</div>
<!-- /modal -->
@stop