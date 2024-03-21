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
	$s_id = mysqli_real_escape_string($con,$_POST["s_id"]);
	$s_name = mysqli_real_escape_string($con,$_POST["s_name"]);
	$s_unit = mysqli_real_escape_string($con,$_POST["s_unit"]);
    $s_stock = mysqli_real_escape_string($con,$_POST["s_stock"]);

	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$s_img = (isset($_POST['s_img']) ? $_POST['s_img'] : '');
	$upload=$_FILES['s_img']['name'];
	if($upload !='') { 

		$path="../s_img/";
		$type = strrchr($_FILES['s_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../s_img/".$newname;
		move_uploaded_file($_FILES['s_img']['tmp_name'],$path_copy);  
	}else{
		$newname=$s_img2;
	}

	$sql = "UPDATE tbl_ingredient 
	SET 
		s_name='$s_name',
		s_unit='$s_unit',
		s_stock='$s_stock',
		s_img='$newname'
	WHERE 
		s_id=$s_id ";	

	 $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	 mysqli_close($con); //ปิดการเชื่อมต่อ database 
	  
	 //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	   
	   if($result){
	   echo "<script type='text/javascript'>";
	   echo "alert('Update');";
	   echo "window.location = 'stock.php'; ";
	   echo "</script>";
	   }
	   else{
	   echo "<script type='text/javascript'>";
	   echo "alert('Error back to Update again');";
	   echo "</script>";
	 }
	 ?>