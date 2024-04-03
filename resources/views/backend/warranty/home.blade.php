@extends('backend.layouts.main')
@section('title', 'Doanh nghiệp')
@section('content')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
</style>


<section class="content-header">
  <h2>
   
    
  </h2>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">HỆ THỐNG QUẢN LÝ BẢO HÀNH</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
	   
<h4>HỆ THỐNG QUẢN LÝ BẢO HÀNH</h4>	   
	   
	   	<div class="box-header with-border">
				  	<div class="row">
						<div class="col-sm-8">
						
						<button type="button" class="btn btn-primary mrg-r-10" id="search">Khung tìm kiếm</button>
						<a href="{{ URL::to('warranty/downloadExcel') }}"><button class="btn btn-success">Download Excel xls</button></a>
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
				<form id="search-form" action="{{route('backend.warranty.index')}}" method="GET">
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
					            <div class="col-md-2">
					              	<div class="form-group">
					        			
					        			<input type="text" class="form-control" id="fullname" name="fullname" value="{{isset($filter['fullname']) ? $filter['fullname'] : ''}}" placeholder="Tìm theo tên người đăng ký"> 
			        				</div>
					              <!-- /.form-group -->
					            </div>
				          
					            <div class="col-md-2">
					              	<div class="form-group">
					        			
					        			<input type="text" class="form-control" id="sNBH_ten" name="NBH_sdt" value="{{isset($filter['NBH_sdt']) ? $filter['NBH_sdt'] : ''}}" placeholder="Tìm theo số điện thoại"> 
			        				</div>
					              <!-- /.form-group -->
					            </div>
				          
					            <div class="col-md-2">
					              	<div class="form-group">
					        			
					        			<input type="text" class="form-control" id="sNha_pp" name="Nha_pp" value="{{isset($filter['Nha_pp']) ? $filter['Nha_pp'] : ''}}" placeholder="Tìm theo đại lý"> 
			        				</div>
					              <!-- /.form-group -->
					            </div>
					            
					             <div class="col-md-2">
					              	<div class="form-group">
					        			
					        			<input type="text" class="form-control" id="SP_sr" name="SP_sr" value="{{isset($filter['SP_sr']) ? $filter['SP_sr'] : ''}}" placeholder="Tìm theo serial tem"> 
			        				</div>
					              <!-- /.form-group -->
					            </div>
					            
					            </div>
					           <div class="row">
					            <div class="col-md-1">
					              	
					        			  <label for="begin">Ngày đầu</label>
                                            <input class="form-control" type="date" id="begin" name="start_date">
                                </div>
                                <div class="col-md-1">
                                            		  <label for="end">Ngày cuối</label>
                                            <input class="form-control" type="date" id="end" name="end_date"> 
                                	
					              <!-- /.form-group -->
					            </div>
					             <div class="col-md-1">
					                 
					                 <button type="submit" class="btn btn-primary">Tìm kiếm</button>
					             </div>
					            
				          	</div>
				          	
			        </div>
				        <!-- /.box-body -->
				       
			      	</div>
			  	</form>
				<!-- /search form -->
	   <div> 
	   Tổng số sản phẩm đang được đăng ký bảo hành: {{$warrantytotal}}
	   </div>
	   <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-12">
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							        <thead>
							        	<tr>
    							        	<th scope="col">ID</th>
    							        	<th scope="col">TÊN SP</th>
    							        	<th scope="col">Giá</th>
                                            <th scope="col">MÃ SP</th>
                                            <th scope="col">SERIAL </th>
                                            <th scope="col">NGÀY KÍCH HOẠTt</th>
                                            <th scope="col">THỜI GIAN BH</th>
                                            <th scope="col">TÊN KHÁCH HÀNG</th>
                                            <th scope="col">ĐIỆN THOẠI</th>
                                            
                                            <th scope="col">DOANH NGHIỆP</th>
                                            <th scope="col">ĐẠI LÝ/ NHÀ PP</th>
                                            <th scope="col">MÃ DỰ THƯỞNG</th>
                                            <th scope="col">QÙA TẶNG</th>
                                        </tr>
				        			</thead>
				        			<tbody>
				        				@forelse ($listHistory as $key => $item)
				              			<tr>
				              			    
				              			  	<td>{{$item->id}}</td>
				              			  	<td>
				              			  	    <a class="hiddenTab" title="XEM CHI TIẾT" href="{{route('backend.warranty.history',['warranty_id' => $item->id])}}" >{{$item->SP_ten}}</a>
				              			  	    <span class="only-print" >{{$item->SP_ten}}</span>
				              			  	</td>
								          	<td>{{$item->price}}</td>
								          	<td>{{$item->SP_ma}}</td>
								          	<td>{{$item->SP_sr}}</td>
								          	<td>{{ \Carbon\Carbon::parse($item->BH_time)->format('d/m/Y')}}</td>
								          	<td>{{$item->BH_th}} tháng</td>
								          	
								          	<td style="text-transform:uppercase"><b>{{$item->fullname}}</b></td>
								          	<td>{{$item->NBH_sdt}}</td>
								          	<td>	<a href="{{route('backend.company.vEdit',['id'=>$item->idCompany])}}" class="editItem" id="" title="Xem thông tin doanh nghiệp"><i class="fa fa-home" aria-hidden="true"></i> </a>  </td>
								          	
								          	
								          	<td>{{$item->Nha_pp}}</td>
								          	<td>{{$item->ma_dt}}</td>
								          	<td>{{$item->winname}}</td>
    								         
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
	      						<div class="dataTables_paginate paging_simple_numbers hiddenTab" id="example1_paginate">
	      							{{ $listHistory->appends($filter)->links() }}
	      						</div>
	      					</div>
	      				</div>
		      		
      				</div>    
	   
		</div>
	</div>
</section>
@stop