<?php
include("condb.php");
$type_id = $_GET['type_id'];
$sql = "SELECT * FROM tbl_product 
        WHERE type_id= $type_id
        ORDER BY p_id DESC
";
// echo($sql);
// exit();
$result = mysqli_query($con, $sql);
while($row_prd = mysqli_fetch_array($result)){
//echo $query;
?>
<div class="col-sm-3" align="center">
    <div class="card border-Light mb-1" style="width: 16.5rem;">
        <br>
        <img class="card-img-top">
        <a href="prd.php?id=<?php echo $row_prd[0]; ?>"> <?php echo"<img src='p_img/".$row_prd['p_img']."'width='200' height='200'>";?></a>
        <div class="card-body">
            <a href="prd.php?id=<?php echo $row_prd[0]; ?>"><b> <?php echo $row_prd["p_name"];?></b> </a>
            <br>
            ราคา <font color=""> <?php echo $row_prd["p_price"];?></font> บาท
            <br>
            
            คงเหลือ <span class="badge badge-succes"><?php echo $row_prd["p_qty"];?></span>
            <span class="sr-only">unread messages</span><?php echo $row_prd["p_unit"];?>
        </div>
        <div>
            <button type="button" class="btn btn-info btn-sm">
            <a style="color: #fff" href="prd.php?id=<?php echo $row_prd[0]; ?>"> รายละเอียด </a></button>
            
        </div>
        <br>
    </div>
</div>

<?php } ?>