<?php require_once('../condb.php');
 include('h.php');
 ?>
<?php
session_start();
// print_r($_SESSION);
// echo $_SESSION['MM_Username'];
// echo "<hr>";

$query_pf ="SELECT * FROM tbl_member WHERE m_user";
$pf = mysqli_query($con, $query_pf) or die ("Error in query: $query_pf " . mysqli_error());
$row_pf = mysqli_fetch_assoc($pf);
$totalRows_pf = mysqli_num_rows($pf);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <style type="text/css">
      @media print{
      #hp{
        display:none;
      }
    }
    </style>
  </head>
  <body>
    <div class="container">
     <?php 
     include('banner.php');
     include('navbar.php');?>
      <br>

      <div class="row">

        <!-- menu-->
        <!-- content-->
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <?php
              $page = $_GET['page'];
              if($page=='mycart'){
                include('mycart.php');
              }
              elseif ($page=='appeal'){
                include('appeal_add.php');
              }
              elseif ($page=='evaluation'){
                include('evaluation_add.php');
              }
              elseif($page=='reward'){
                include('reward_list.php');
              }
              elseif($page=='reward_detail'){
                include('reward_detail.php');
              }
              elseif($page=='reward_his'){
                include('reward_list_history.php');
              ////ถ้าใช้ไม่ได้ให้ลบ
              }
              elseif($page=='stock'){
                include('stock_list.php');
              }else{
                include('detail_order_afer_cartdone.php');
              }
              
          ?>
          
          
          
        </div>
      </div>
    </div>
    <!--end show  product-->
    
    
    
    
    
  </body>
</html>
<?php
mysqli_free_result($pf);
?>