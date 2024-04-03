@extends('backend.layouts.main')
@section('title', 'Cập nhật bảo hành')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('backend/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('backend/summernote/summernote.js')}}"></script>




@if (Session::has('msg_warranty'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_warranty")}}', 'Thông báo','OK');
   	});
   	</script>
@endif

@if (Session::has('msg_warranty'))
   	<script type="text/javascript">
   	$(function() {
   		jAlert('{{Session::get("msg_warrantyhistory")}}', 'Thông báo');
   	});
   	</script>
@endif


<script>
    function checkfullname()
    {
    fullname=   document.updateform.fullname.value;
    len=fullname.length;
    if(len<=0)
        {
        alert("Bạn chưa nhập họ tên");
        }
    }
</script>

<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">THÔNG TIN CHI TIẾT BẢO HÀNH
  </ol>
</section>
<section class="content">

	<div class="row">
		<div class="col-sm-12">
	      <h4>THÔNG TIN CHI TIẾT BẢO HÀNH</h4>
    	   <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
    	      	@forelse ($warrantyname as $key => $item1) 
    	       <div class="row">
                  <div class="col-sm-6">
                      <ul class="list-group list-group-flush">
                      <li class="list-group-item">Tên sản phẩm:<b> {{$item1->SP_ten}} </b> </li>
                      <li class="list-group-item">Mã sản phẩm:<b> {{$item1->SP_ma}}</b> </li>
                      <li class="list-group-item">Số serial: <b>{{$item1->SP_sr}} </b> </li>
                      <li class="list-group-item">Thời hạn bảo hành: <b> {{$item1->BH_th}} tháng </b></li>
                    </ul>
                  </div>
                  <form  class="form-horizontal" action="{{route('backend.warranty.pEdit', ['id'=>$item1->id])}}" method="POST" enctype="multipart/form-data" name="updateform">  
                  
                  <div class="col-sm-6">
                      <ul class="list-group list-group-flush">
                      <li class="list-group-item"><b>Ngày kích hoạt:</b> <input name="BH_time" class="form-control"  type="datetime-local"  value="{{$item1->BH_time}}">
                                
                          <b> Thời gian còn lại:</b>  <font style="color:red"> {{$timebh}}</font> (ngày)
                          
                           
                          
                          
                          </li>
                           
                      <li class="list-group-item"><b>Tên khách hàng: </b><input name="fullname" class="form-control"  type="text"  value="{{$item1->fullname}}" required onblur="checkfullname()"> 
                      <b>Điện thoại:</b> <input name="NBH_sdt" class="form-control"  type="text"  value="{{$item1->NBH_sdt}}" required>  </li>
                      <li class="list-group-item"><b>Địa chỉ: </b> <input name="NBH_dc" class="form-control"  type="text" size="90" value=" {{$item1->NBH_dc}}" required> </li>
                      <li class="list-group-item"> <b>Email: </b><input name="email" class="form-control"  type="text" size="90" value=" {{$item1->email}}">  
                      <button type="submit" class="btn btn-primary show_confirm_add" data-toggle="tooltip" title='Lưu thông tin chỉnh sửa?'>Lưu</button> 
                      </li>
                    </ul>
                      
                  </div>
                  </form>
                </div>
                 @empty
            	@endforelse
    	        <h4>LỊCH SỬ CÁC LẦN BẢO HÀNH</h4>						          
        	  	<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
    							        <thead>
    							        	<tr>
            							          <th scope="col">ID</th>
            							          <th scope="col">Ngày tháng</th>
                                                  <th scope="col">Nội dung yêu cầu</th>
                                                  <th scope="col">Nội dung xử lý</th>
                                                  <th scope="col">Kinh phí</th>
                                                  <th scope="col">Xóa</th>
    						        		</tr>
    				        			</thead>							         
    				      			
    				        				@forelse ($listHistory as $key => $item)
    				              			<tr>
    				              			    <td>{{$item->id}}</td>
    				              			    <td>{{$item->warrantydate}}</td>
    								          	<td>{{$item->content}}</td>
    								          	<td>{{$item->process}} </td>
    								          	<td>{{$item->price}}</td>
    								          	<td>
    								          	    <form method="GET" action="{{ route('backend.warranty.delhistory', $item->id) }}">
                            						<input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Xóa</button>
                                             

                                                    
                                                    </form>
                                                </td>
    				              			 </tr> 	
    								        @empty
    								    	<tr class="even">
    								    		<td colspan="6" style="font-style: italic;">Không có thông tin nhật ký bảo hành</td>
    								    	</tr>
    									    @endforelse
    		</table>
          	</div>
          		
  	</div>
	</div>
	

<div style="text-align:center;">
<a  class="btn btn-primary"href="{{route('backend.warranty.index')}}">Quay lại xem danh sách</a> :: 
<a  class="btn btn-primary" href="{{route('backend.warranty.viewadd',['warrantyid' => $item1->id])}}">Cập nhật lịch sử bảo hành</a>
</div>


       
                                                    <label>Chọn ngày: </label>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Bạn có chắc chắn xóa nội dung này không??`,
              text: "Nếu xóa, dữ liệu sẽ mất và không thể phục hồi.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
      
      
        $('.show_confirm_add').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Bạn có chắc chắn muốn lưu thông tin mới sửa không?`,
              text: "Nếu có, dữ liệu mới sẽ được cập nhật..",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
      
      

  
</script>
  
<script type="text/javascript">
$(function () {  
$("#datepicker").datepicker({         
autoclose: true,         
todayHighlight: true 
}).datepicker('update', new Date());
});
</script>



<!-- End of Form nhập tt nhật ký bảo hành -->
</section>

                                            <?php 
    								            /*
                                                  $today = date("d/m/Y");
                                                  $date1 = date("Y-m-d"); 
                                                  $date2 = $row['BH_time'];
                                                  $first_date = strtotime(date("Y-m-d"));
                                                  $second_date = strtotime($date2);
                                                  $datediff = abs($first_date - $second_date);
                                                  $day = $row['BH_th']*30 - floor($datediff / (60*60*24));
                                                  if($day <= 0 )
                                                      {
                                                          echo "Đã hết hạn bảo hành.";
                                                             $cl = "cl()"; 
                                                      }
                                                  else
                                                      {
                                                         echo $row['BH_th']*30 - floor($datediff / (60*60*24))." "."Ngày";
                                                      
                                                      }
                                                      */
                                                ?>   
@stop

