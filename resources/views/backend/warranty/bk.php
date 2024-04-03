@extends('backend.layouts.main')
@section('title', 'Doanh nghiệp')
@section('content')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

<?php
    $servername = "localhost";
    $username = "xacthucs_backend";
    $password = "admin123!@#";
    $dbname = "xacthucs_smartcheck";
    
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset( $conn, 'utf8');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
     //kết nói db

  
    // If đăng nhập thành công thi gán biến
          $sql = "SELECT * FROM test";
          $row = mysqli_query($conn,$sql);
          $num_rows = mysqli_num_rows($row);
    
    // Tính tổng số trang
    $records_per_page = 10;
    //$result = mysqli_query($conn, $sql);
    $total_records = mysqli_num_rows($row);
    $total_pages = ceil($total_records / $records_per_page);

// Lấy trang hiện tại
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1;
}

// Xác định giới hạn bản ghi cho truy vấn SQL
$offset = ($current_page - 1) * $records_per_page;

// Thực hiện truy vấn SQL để lấy dữ liệu cho trang hiện tại
$sql = "SELECT * FROM test LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql);




          $today = date("d/m/Y");
  
  
  
  

?>


<section class="content-header">
  <h1>
    HỆ THỐNG QUẢN LÝ BẢO HÀNH |    {{Auth::user()->id}}


   
   <?php 
   ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.site.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">HỆ THỐNG QUẢN LÝ BẢO HÀNH</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
		<!-- Them mói-->
		
		
		<table class="table table-hover" id="headerTable">
  <thead>
    <tr>
    
      <th scope="col">Tên khách hàng</th>
      <th scope="col">Số điện thoại</th>
      <th scope="col">Địa chỉ</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Mã sản phẩm</th>
      <th scope="col">Số serial</th>
      <th scope="col">Thời gian bảo hành</th>
      <th scope="col">Ngày kính hoạt</th>
      <th scope="col">Số ngày bảo hành còn lại</th>
      <th scope="col">Nhà phân phối</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      while ($row = mysqli_fetch_assoc($result)) {
          ?>
    <tr id="cc">
     
      <td ><a href="history.php?id=<?php echo $row['id']; ?>" title="Nhật ký bảo hành"><?php echo mb_convert_case($row['NBH_ten'], MB_CASE_UPPER, "UTF-8"); ?> </a></td>
      <td><?php echo $row['NBH_sdt']; ?></td>
      <td><?php echo $row['NBH_dc']; ?></td>
      <td><?php echo $row['SP_ten']; ?></td>
      <td><?php echo $row['SP_ma']; ?></td>
      <td><?php echo $row['SP_sr']; ?></td>
      <td><?php echo $row['BH_th']." "."(tháng)"; ?></td>
      <td><?php echo $row['BH_time']; ?></td>
      <td><?php
         
          $date1 = date("Y-m-d"); 
          $date2 = $row['BH_time'];
        
          $first_date = strtotime(date("Y-m-d"));
          $second_date = strtotime($date2);
          $datediff = abs($first_date - $second_date);
          $day = $row['BH_th']*30 - floor($datediff / (60*60*24));
          if($day <= 0 ){
              echo "Đã hết hạn bảo hành.";
                 $cl = "cl()"; 
          }else{
             echo $row['BH_th']*30 - floor($datediff / (60*60*24))." "."Ngày";
          
          }
        ?></td>
      <td><?php echo $row['Nha_pp']; ?></td>
    </tr>
    <?php }; ?>

  </tbody>
</table>

<nav aria-label="Page navigation example">
<ul class="pagination">
<?php
// Hiển thị các nút phân trang
if ($total_pages > 1)
{


    if ($current_page > 1) 
    {
        echo "<li class='page-item'><a class='page-link' href='?page=" . ($current_page - 1) . "'>Trang trước</a></li>";
    }
    //for ($i = 1; $i <= $total_pages; $i++)
    for ($i = 1; $i <= 30; $i++)
        {
            if ($i == $current_page) 
                {
                    echo " <li class='page-item'> <span>$i</span> </li>";
                }
                else 
                {
                    echo "<li class='page-item'><a lass='page-link' href='?page=$i'>$i</a></li>";
                }
        }


}
    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
if ($current_page < $total_pages && $total_pages > 1)
{
   echo "<li class='page-item'><a  class='page-link' href='?page=".($current_page+1)."'>Trang tiếp</a> </li> ";
}



?>




 </ul>
</nav>
		

		
		
		
		</div>
	</div>
</section>
@stop