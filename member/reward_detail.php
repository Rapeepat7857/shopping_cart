<?php
//คิวรี่แต้มที่มี
$sql = "SELECT * FROM tbl_member WHERE member_id=$member_id";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
$my_point = $row['my_point'];

//คิวรี่แสดงข้อมูลเมนูแลกซื้อ
$id = $_GET['id'];
$query_reward="SELECT * FROM tbl_reward WHERE id=$id";
$result_reward = mysqli_query($con, $query_reward) or die ("Error in query: $sql " . mysqli_error());
//ไม่ต้องเอารางวัลไปวนซ้ำ
$row_reward = mysqli_fetch_array($result_reward);
//print_r($row_reward);

//แต้มที่ใช้
$reward_point = $row_reward['reward_point'];

//ตัดแต้มว่าเหลือเท่าไหร่ จะอัพเดทที่ tbl_member
$use_poit = ($my_point - $reward_point);
?>

<div class="col-md-4">
    <img src="../reward/<?php echo $row_reward['reward_img'];?>" width="100%">
</div>

<div class="col-md-8">
    ชื่อเมนู <?php echo $row_reward['reward_name'];?> <br>
    แต้มที่ใช้แลก <?php echo $row_reward['reward_point'];?> <br>
    แต้มที่มี <?php echo $my_point;?> <br>
    สถานะ :
    <?php
            //สร้างเงื่อนไขว่าแต้มพอไหม

            if ($my_point >= $row_reward['row_reward']) {
                echo '<font color="green"> แลกได้ </font>';
            }else{
                echo '<font color="red"> แต้มไม่พอ </font>';
            }


// echo '<hr>';
// echo $use_poit;
        ?>

<form action="save_point_used.php" method="post">
    <input type="hidden" name="member_id" value="<?php echo $member_id;?>">
    <input type="hidden" name="my_point" value="<?php echo  $use_poit;?>">
    <input type="hidden" name="id" value="<?php echo  $row_reward['id'];?>">
    <button type="submit" onclick="return confirm('ยืนยัน');"class="btn btn-primary">บันทึกการแลก</button>
</form>
</div>
