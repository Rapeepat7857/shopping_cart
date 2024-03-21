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
	$reward_name = mysqli_real_escape_string($con,$_POST["reward_name"]);
	$reward_point = mysqli_real_escape_string($con,$_POST["reward_point"]);
	$reward_status = mysqli_real_escape_string($con,$_POST["reward_status"]);

	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$b_logo = (isset($_POST['reward_img']) ? $_POST['reward_img'] : '');
	$upload=$_FILES['reward_img']['name'];
	if($upload !='') { 
		$path="../reward/";
		$type = strrchr($_FILES['reward_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../reward/".$newname;
		move_uploaded_file($_FILES['reward_img']['tmp_name'],$path_copy);  
	}

	$sql = "INSERT INTO tbl_reward
	(
    reward_name,
	reward_point,
	reward_status,
	reward_img
	)
	VALUES
	(
	'$reward_name',
	'$reward_point',
	'$reward_status',
	'$newname'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='reward.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='reward.php?act=add&do=f';";
    echo '</script>';
}
?>
