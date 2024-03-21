<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	error_reporting( error_reporting() & ~E_NOTICE );
    @session_start();  
	// echo "<pre>";
	// print_r($_SESSION);
	// echo "<hr>";
	// print_r($_POST);
	// echo "</pre>";
	// exit();
	include('../condb.php');
	//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');

	$amount = $_POST['amount'];
	$member_id = $_POST['member_id'];
	$name = $_POST["name"]; 
	$address = $_POST["address"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$p_qty = $_POST["p_qty"];
	$total = $_POST['total'];
	$order_date = date("Y-m-d H:i:s");
	$status = 1;
	$pay_slip ='';
	$b_name ='';
	$b_number ='';
	$pay_date ='';
	$pay_amount ='';
	$p_name = $_POST['p_name'];
	$postcode='';

	
	//บันทึกการสั่งซื้อลงใน order_detail
	 mysqli_query($con, "BEGIN"); 
	$sql1 = "INSERT  INTO tbl_order VALUES
	(NULL,
	 '$member_id',  
	 '$name',
	 '$address',
	 '$email',
	 '$phone',
	 '$status',
	 '$pay_slip',
	 '$b_name',
	 '$b_number',
	 '$pay_date',
	 '$pay_amount',
	 '$postcode',
	 '$order_date' 
	 )";
	
	$query1	= mysqli_query($con, $sql1) or die ("Error in query: $query1 " . mysqli_error());

 
 
	$sql2 = "SELECT MAX(order_id) AS order_id FROM tbl_order  WHERE member_id='$member_id'";
	$query2	= mysqli_query($con, $sql2) or die ("Error in query: $sql2 " . mysqli_error());
	$row = mysqli_fetch_array($query2);
	$order_id = $row['order_id'];

	//insert point

	$sqlinsertpoint ="INSERT INTO tbl_point
	(ref_order_id, ref_member_id, amount)
	VALUES
	('$order_id', '$member_id', '$amount')
	";
	$queryinsertpoint = mysqli_query($con, $sqlinsertpoint);

	
	// ดึงข้อมูลจากตาราง tbl_product
	foreach($_SESSION['shopping_cart'] as $p_id => $p_qty ) {

    // ดึงข้อมูลสินค้า
    $sql_product = "SELECT * FROM tbl_product WHERE p_id = $p_id";
    $query_product = mysqli_query($con, $sql_product) or die ("Error in query: $sql_product " . mysqli_error($con));
    $row_product = mysqli_fetch_array($query_product);
	$stock_milk = $row_product['stock_milk'];
    $stock_cream = $row_product['stock_cream'];

    // คำนวณยอดรวม
    $total = $row_product['p_price'] * $p_qty;

    // กำหนดค่า quantity ของวัตถุดิบ
    $quantity_milk = $row_product['quantity_milk'] * $p_qty;
    $quantity_cream = $row_product['quantity_cream'] * $p_qty;

    // บันทึกรายละเอียดการสั่งซื้อลงใน tbl_order_detail
    $sql4 = "INSERT INTO tbl_order_detail 
             VALUES(null, 
                    '$order_id', 
                    '$p_id',
                    '$p_name', 
                    '$p_qty',
                    '$total', 
                    '$order_date',
                    '$quantity_milk',
                    '$quantity_cream')";
    $query4 = mysqli_query($con, $sql4) or die ("Error in query: $query4 " . mysqli_error($con));
	
	// อัพเดทชื่อสินค้าใน tbl_order_detail
    $sqlpname = "UPDATE tbl_order_detail t2, 
                 (SELECT p_name, p_id FROM tbl_product) t1 
                 SET t2.p_name = t1.p_name 
                 WHERE t1.p_id = t2.p_id";
    $querypanem = mysqli_query($con, $sqlpname) or die ("Error in query: $querypanem " . mysqli_error());

    // ตัดสต๊อกสินค้าในตาราง tbl_product
    $stc = $row_product['p_qty'] - $p_qty;
    $sql9 = "UPDATE tbl_product 
             SET p_qty = $stc
             WHERE p_id = $p_id ";
    $query9 = mysqli_query($con, $sql9) or die ("Error in query: $query9 " . mysqli_error($con));

	// อัปเดตสต๊อกวัตถุดิบในตาราง tbl_product
    $stm_milk = $stock_milk - $quantity_milk;
    $stm_cream = $stock_cream - $quantity_cream;
    $sql8 = "UPDATE tbl_product 
                              SET stock_milk = $stm_milk,
                                  stock_cream = $stm_cream
                              WHERE p_id = $p_id ";
    $query8 = mysqli_query($con, $sql8) or die ("Error in query: $query8 " . mysqli_error($con));
}

// exit;
	
	if($query1 && $query4){
		mysqli_query($con, "COMMIT");
		//$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
		foreach($_SESSION['shopping_cart'] as $p_id)
		{	
			unset($_SESSION['shopping_cart']);
			echo "<script>";
			echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
			echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
			echo "</script>";
		}
	}
	else{
		mysqli_query($con, "ROLLBACK");  
			echo "<script>";
			echo "alert('บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่');";
			echo "window.location ='confirm_order.php'; ";
			echo "</script>";	
	}

	mysqli_close($con);
?>