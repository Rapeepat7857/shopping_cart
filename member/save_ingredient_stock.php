<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../condb.php");
//print_r($_POST);


$s_id  = $_POST['s_id ']; //ไอดีของวัตุดิบ
$s_stock = $_POST['s_stock']; //จำนวนวัตุดิบ
$p_id = $_POST['p_id']; //ไอดีเมนู


//จำนวนวัตถุดิบที่ใช้
//$quantity_milk = $m_ingredient ;


//อัพเดทแต้มคงเหลือในตารางสต๊อก
$sqlupdateingredient ="UPDATE tbl_ingredient SET s_stock=$s_stock
WHERE s_id=$s_id
";
$resultupdateingredint = mysqli_query($con, $sqlupdateingredint);

//อัพเดทสถานะเป็น 2
$sqlupdatereward = "UPDATE tbl_reward SET reward_status=2
WHERE id=$id
";
$resultupdatereward = mysqli_query($con, $sqlupdatereward);

//บันทึกประวัติการแลก
$sqlInsertPointused ="INSERT INTO tbl_point_used
(ref_reward_id, ref_member_id)
VALUES
($id, $member_id)
";
$resultInsertPointused = mysqli_query($con, $sqlInsertPointused); 

if($resultupdatemember && $resultupdatereward && $resultInsertPointused){
    //echo'บันทึกได้ถูกต้อง';
    echo "<script>";
    echo "alert('บันทึกข้อมูลการแลกได้ถูกต้อง');"; 
    echo "window.location ='my_order.php?page=reward'; ";
    echo "</script>";

}else{
    //echo 'เกิดข้อผิดพลาด';
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาด');"; 
    echo "window.location ='my_order.php?page=reward'; ";
    echo "</script>";
}

?>