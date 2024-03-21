<meta charset="UTF-8" />
<?php
require_once('../condb.php');

error_reporting( error_reporting() & ~E_NOTICE );

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;
 
 //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());


//$bank = $_POST['bank'];

$resultb = $_POST['bank'];
$result_explode = explode('-', $resultb);
$b_name = $result_explode[0];
$b_number = $result_explode[1];
$pay_date = $_POST['pay_date'];
$pay_amount = $_POST['pay_amount'];
$order_id = $_POST['order_id'];
$order_status = 2;
$pay_slip = (isset($_POST['pay_slip']) ? $_POST['pay_slip'] : '');

$upload=$_FILES['pay_slip'];
	if($upload <> '') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="pimg/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['pay_slip']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname =$numrand.$date1.$type;
 
	$path_copy=$path.$newname;
	$path_link="pimg/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['pay_slip']['tmp_name'],$path_copy);  
		
	
	}
 

 
$sql ="UPDATE tbl_order SET
		order_status='$order_status',
		pay_date='$pay_date',
		pay_amount='$pay_amount',
		b_name='$b_name',
		b_number='$b_number',		
		pay_slip='$newname'	
		WHERE order_id = $order_id
		";
		
		$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	

//update point satatus = 1
	$sqlupdatepoint="UPDATE tbl_point SET
	
	status = 1
	
	WHERE ref_order_id=$order_id
	";
	$resultupdatepoint = mysqli_query($con, $sqlupdatepoint) or die("Error in query : $sqlupdatepoint" .mysql_error($con));

//update total point tbl_member
    $my_point = $_POST['my_point'];
	$member_id = $_POST['member_id'];


    $sqlupdatepointtbl_member ="UPDATE tbl_member SET
	
	my_point='$my_point'
	
	WHERE member_id=$member_id
	
	";
	$resultupdatepointtbl_member = mysqli_query($con, $sqlupdatepointtbl_member);


		mysqli_close($con);
		
// echo $sql;
// exit();		



//exit;
		if($result && $resultupdatepoint && $sqlupdatepointtbl_member){
			echo "<script>";
			echo "alert('อัพโหลดสลิปเรียบร้อยแล้ว');";
			echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
			echo "</script>";
		}

?>