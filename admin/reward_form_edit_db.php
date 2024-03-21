<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['m_level']!='admin'){
	Header("Location: index.php");
}
	$id = mysqli_real_escape_string($con,$_POST["id"]);
	$reward_name = mysqli_real_escape_string($con,$_POST["reward_name"]);
	$reward_point = mysqli_real_escape_string($con,$_POST["reward_point"]);
    $reward_status = mysqli_real_escape_string($con,$_POST["reward_status"]);

	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$s_img = (isset($_POST['s_img']) ? $_POST['s_img'] : '');
	$upload=$_FILES['s_img']['name'];
	if($upload !='') { 

		$path="../reward/";
		$type = strrchr($_FILES['reward_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../reward/".$newname;
		move_uploaded_file($_FILES['reward_img']['tmp_name'],$path_copy);  
	}else{
		$newname=$reward_img2;
	}

	$sql = "UPDATE tbl_reward 
	SET 
		reward_name='$reward_name',
		reward_point='$reward_point',
		reward_status='$reward_status',
		reward_img='$newname'
	WHERE 
		id=$id ";	

	 $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	 mysqli_close($con); //ปิดการเชื่อมต่อ database 
	  
	 //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	   
	   if($result){
	   echo "<script type='text/javascript'>";
	   echo "alert('Update');";
	   echo "window.location = 'reward.php'; ";
	   echo "</script>";
	   }
	   else{
	   echo "<script type='text/javascript'>";
	   echo "alert('Error back to Update again');";
	   echo "</script>";
	 }
	 ?>