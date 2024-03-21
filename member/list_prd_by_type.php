<?php
include("../condb.php");
$type_id = $_GET['type_id'];

$sql = "SELECT * FROM tbl_product 
        WHERE type_id= $type_id
        ORDER BY p_id DESC
";
$result = mysqli_query($con, $sql);
 while($row_prd = mysqli_fetch_array($result)){

?>

   <div class="col-sm-4" align="center">
          <div class="card border-Light mb-2" style="width: 17rem;">
            <br>
  <img class="card-img-top">
  <a href="prd.php?id=<?php echo $row_prd[0]; ?>"> <?php echo"<img src='../p_img/".$row_prd['p_img']."'width='200' height='200'>";?></a>
  <div class="card-body">
    <b><a href="prd.php?id=<?php echo $row_prd[0]; ?>"> <?php echo $row_prd["p_name"];?> </a></b>
    <br>
                ราคา <font color=""> <?php echo $row_prd["p_price"];?></font> บาท
                 <br> 
                
  คงเหลือ <span class="badge badge-info"><?php echo $row_prd["p_qty"];?></span>
  <span class="sr-only">unread messages</span><?php echo $row_prd["p_unit"];?>


  </div>
  <div>
  <button type="button" class="btn btn-info btn-sm">
                        <a style="color: #fff" href="prd.php?id=<?php echo $row_prd[0]; ?>"> รายละเอียด </a></button>
                       <?php include('outstock.php');?>
                     </div>
                     <br>
</div>

     </div>          
<?php } ?>
            