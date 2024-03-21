<?php  require_once('../condb.php'); ?>
<?php
 //$m_user = $_GET['m_user'];
$query_mm ="SELECT * FROM tbl_member WHERE member_id = $member_id";
$mm = mysqli_query($con, $query_mm) or die ("Error in query: $query_mm " . mysqli_error());
$row_mm = mysqli_fetch_assoc($mm);
$totalRows_mm = mysqli_num_rows($mm);
// echo ($query_mm);
// exit();
$member_id = $row_mm['member_id'];

$query_mycart ="
SELECT 
o.order_id as oid, o.member_id, o.order_status, o.order_date,
d.order_id , COUNT(d.order_id) as coid, SUM(d.total) as ctotal
FROM tbl_order  as o, tbl_order_detail as d
WHERE o.member_id =$member_id 
AND o.order_id=d.order_id
GROUP BY o.order_id
ORDER BY o.order_id DESC";
$mycart = mysqli_query($con, $query_mycart) or die ("Error in query: $query_mycart " . mysqli_error());
$row_mycart = mysqli_fetch_assoc($mycart);
$totalRows_mycart = mysqli_num_rows($mycart);

?>
<?php //include('datatable.php');?>

<div class="form-group" >
  <div class="col-12" align="left">
  <div class="card">
  <div class="card-body">


<p><b>ประวัติการสั่งซื้อ</b> <button class="btn btn-info btn-sm" onclick="window.print()"> พิมพ์ </button> 


 
<table id="example" class="display" cellspacing="0" border="0" width="100%">
<thead>
  <tr>
    <th>รหัสสั่งซื้อ</th>
    <th>จำนวนรายการ</th>
    <th>ราคารวม</th>
    <th>สถานะ</th>
    <th>วันที่ทำรายการ</th>
    <th>ชำระเงิน</th>
  </tr>
  </thead>
  <?php do { ?>
    <tr>
<td> 
    <?php echo $row_mycart['oid']; ?>
      </td>
      
  
      <td align="center">
      <?php echo $row_mycart['coid'];?>
      </td>
       <td align="center">
      <?php echo number_format($row_mycart['ctotal'],2);?>
      </td>
      <td align="center">
      <font color="red">
      <?php 
    $status =  $row_mycart['order_status'];
   include('status.php');
    ?>  
      </font> 
      </td>
      <td align="center"><?php echo date('d/m/Y',strtotime($row_mycart["order_date"])); ?></td>
    <td align="right">
       <button type="button" class="btn btn-outline-warning">
      <a href="my_order.php?order_id=<?php echo $row_mycart['oid']; ?>&act=show-order">
     ชำระเงิน
      </a>
      </button>
    </td>
    </tr>
    <?php } while ($row_mycart = mysqli_fetch_assoc($mycart)); ?>
</table>


</div>
</div>
</div>
</div>

<?php
mysqli_free_result($mycart);

mysqli_free_result($mm);
?>
