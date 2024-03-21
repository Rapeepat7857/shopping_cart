<?php
error_reporting( error_reporting() & ~E_NOTICE );
//1. เชื่อมต่อ database:
include('../condb.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//2. query ข้อมูลจากตาราง tb_admin:
$query_mm = "SELECT * FROM tbl_member WHERE member_id = $member_id";
$mm = mysqli_query($con, $query_mm) or die ("Error in query: $query_mm " . mysqli_error());
$row_mm = mysqli_fetch_assoc($mm);
$totalRows_mm = mysqli_num_rows($mm);

$member_id = $row_mm['member_id'];

$query_mycart ="
SELECT 
o.order_id as oid, o.member_id, o.order_status, o.order_date, o.name,
d.order_id , COUNT(d.order_id) as coid, SUM(d.total) as ctotal
FROM tbl_order  as o, tbl_order_detail as d 
WHERE o.order_id=d.order_id
AND o.order_status=2
GROUP BY o.order_id
ORDER BY o.order_id DESC";
$mycart = mysqli_query($con, $query_mycart) or die ("Error in query: $query_mycart " . mysqli_error());
//$row_mycart = mysqli_fetch_assoc($mycart);
$totalRows_mycart = mysqli_num_rows($mycart);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:
echo ' <table id="example1" class="table table-bordered table-striped">';
  //หัวข้อตาราง
  echo "<thead>";
    echo "<tr class='btn-default'>
      <th>รหัสสั่งซื้อ</th>
      <th width=20%>ลูกค้า</th>
      <th>จำนวนรายการ</th>
      <th>ราคารวม</th>
      <th>สถานะ</th>
      <th>วันที่ทำรายการ</th>
     <th width='5%'>เปิด</th>
    </tr>";
  echo "</thead>";
  while($row = mysqli_fetch_array($mycart)) {
    $oid = $row['oid'];
  echo "<tr>";
    echo "<td>" .$row["oid"] .  "</td> ";
    echo "<td>" .$row["name"] .  "</td> ";
    echo "<td>" .$row["coid"] .  "</td> ";
    echo "<td>" .$row["ctotal"] .  "</td> ";
    echo "<td>" 
    ."<font color='green'>ชำระเงินแล้ว</font>".  "</td> ";
    echo "<td>" .$row["order_date"] .  "</td> ";
      echo "<td><a href='index.php?order_id=$oid&act=show-order' class='btn btn-info btn-xs'>เปิด</a>
    </td> ";
  }
echo "</table>";
//5. close connection
mysqli_close($con);
?>



