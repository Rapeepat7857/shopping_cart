<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../condb.php");
//print_r($_POST);


$member_id = $_POST['member_id']; //ไอดีของสมาชิก
$my_point = $_POST['my_point']; //แต้มคงเหลือ
$id = $_POST['id']; //ไอดีเมนู


//อัพเดทแต้มคงเหลือในตารางสมาชิก
$sqlupdatemember ="UPDATE tbl_member SET my_point=$my_point
WHERE member_id=$member_id
";
$resultupdatemember = mysqli_query($con, $sqlupdatemember);

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