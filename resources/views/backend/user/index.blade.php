@extends('backend.layouts.main')
@section('title', 'User Admin')
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
    Danh sách tài khoản
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Danh sách Admin users</li>
  </ol>
</section>
<section class="content">
    
    
    
    <div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-8">
						
						<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
						
													<a class="btn btn-primary" href="{{route('backend.user.vAdd')}}">Thêm mới tài khoản</a>

		                </div>
						<div class="col-sm-4">
							<div class="dataTables_length pull-right">
								<label>
									Hiện <select class="form-control input-sm showPage">
										<option value="10" {{$pageSize == 10 ? 'selected' : ''}}>10</option>
										<option value="25" {{$pageSize == 25 ? 'selected' : ''}}>25</option>
										<option value="50" {{$pageSize == 50 ? 'selected' : ''}}>50</option>
										<option value="100" {{$pageSize == 100 ? 'selected' : ''}}>100</option>
									</select> dòng/ 1 trang
								</label>
							</div>
						</div>
					</div>
				</div>
				<!-- search form -->
				<form id="search-form" action="{{route('backend.user.index')}}" method="GET">
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
					        			<label for="sName" class="control-label">Tìm theo tên người đăng ký</label>
					        			<input type="text" class="form-control" id="fullname" name="fullname" value="{{isset($filter['fullname']) ? $filter['fullname'] : ''}}"> 
			        				</div>
					              <!-- /.form-group -->
					            </div>
				          	</div>
				          	 <div class="row">
					            <div class="col-md-6">
					              	<div class="form-group">
					        			<label for="sName" class="control-label">Tìm theo email</label>
					        			<input type="text" class="form-control" id="email" name="email" value="{{isset($filter['email']) ? $filter['email'] : ''}}"> 
			        				</div>
					              <!-- /.form-group -->
					            </div>
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
    
    
    
    
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<div class="row">
				  	
						<div class="col-sm-3">
						</div>
				  	</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-1">
								@if(Auth::user()->hasAnyRole(1))
								<button type="button" class="btn btn-danger deleteAll">Delete</button>
								<input type="hidden" id="delUrl" value="{{url('user/delete')}}">
								@endif
							</div>
							<div class="col-sm-11">
								<div class="dataTables_length pull-right" id="example1_length">
								
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
							        		@if(Auth::user()->hasAnyRole(1))
							        		<th width="1%">
						                      	<input type="checkbox" id="checkAll">
						                 	</th>
						                 	@endif
							        	    <th width="2%">ID</th>
							        		<th width="15%">Name</th>
							        		<th width="5%">Email</th>
							        		<th width="10%">Tel</th>
							        		<th width="10%">Address</th>
							        		<th width="10%">Type</th>
							        		@if(Auth::user()->hasAnyRole([1]))
							        		<th width="2%">Status</th>
							        		@endif
							        		@if(Auth::user()->hasAnyRole([1]))
							        		<th width="10%">Action</th>
							        		@endif
						        		</tr>
				        			</thead>
				        			<tbody>
				        				@forelse ($listUser as $key => $item) 
				              			<tr class="{{$key%2 == 0 ? 'even' : 'odd'}}">
				              				@if(Auth::user()->hasAnyRole(1))
				              				<td>
				              					<input type="checkbox" class="checkItem" value="{{$item->id}}">
			              					</td>
			              					@endif
							            	<td>{{$item->id}}</td>
							          		<td>{{$item->fullname}}</td>
							          		<td>{{$item->email}}</td>
							          		<td>{{$item->tel}}</td>
								          	<td>{{$item->address}}</td>
								          	<td>{{$type[$item->is_admin]}}</td>
								          	@if(Auth::user()->hasAnyRole([1]))
								          	<td class="text-center">
								          		@if($item->status == 0)
								          		<a href="javascript: void(0);" class="reverseItem" data-id="{{$item->id}}" id="status{{$item->id}}" data-href="{{route('backend.user.reverseStatus')}}" title="Ẩn"><i class="fa fa-fw fa-question"></i></a>
								          		@else
								          		<a href="javascript: void(0);" class="reverseItem" data-id="{{$item->id}}" id="status{{$item->id}}" data-href="{{route('backend.user.reverseStatus')}}" title="Hiện"><i class="fa fa-fw fa-check-circle"></i></a>
								          		@endif
								          	</td>
								          	@endif
								          	@if(Auth::user()->hasAnyRole([1]))
								          	<td class="text-center">
								          		<a href="{{route('backend.user.vEdit',['id'=>$item->id])}}" class="editItem" id="" title="Sửa"><i class="fa fa-fw fa-edit"></i></a>
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
@stop