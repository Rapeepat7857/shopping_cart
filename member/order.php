<?php
require_once('../condb.php');
//error_reporting( error_reporting() & ~E_NOTICE );
 include('navbar.php');

@session_start(); 
    $p_id = $_GET['p_id']; 
  $act = $_GET['act'];

  if($act=='add' && !empty($p_id))
  {
    if(!isset($_SESSION['shopping_cart']))
    {
       
      $_SESSION['shopping_cart']=array();
    }else{
     
    }
    if(isset($_SESSION['shopping_cart'][$p_id]))
    {
      $_SESSION['shopping_cart'][$p_id]++;
    }
    else
    {
      $_SESSION['shopping_cart'][$p_id]=1;
    }
        echo "<script>";
      echo "window.location ='confirm_order.php'; ";
      echo "</script>";
  }

  if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
  {
    unset($_SESSION['shopping_cart'][$p_id]);
  }

  if($act=='update')
  {
    $amount_array = $_POST['amount'];
    foreach($amount_array as $p_id=>$amount)
    {
      $_SESSION['shopping_cart'][$p_id]=$amount;
    }
  }

//  print_r($_SESSION);
$query_buyer = "SELECT * FROM tbl_member WHERE  member_id=$member_id " or die("Error:" . mysqli_error());
$buyer = mysqli_query($con, $query_buyer) or die ("Error in query: $query_buyer " . mysqli_error());
$row_buyer = mysqli_fetch_assoc($buyer);
$totalRows_buyer = mysqli_num_rows($buyer);

	// echo 'ss'.$row_buyer; 
?>

<br>
<div class="form-group" >
  <div class="col-12" align="left">
  <div class="card">
  <div class="card-body">

  
  <table id="example3" class="display" cellspacing="0" border="0" width="100%">
  
    <tr>
    <thead class="thead-dark">
      <td width="1558" colspan="6" align="center">
      <h5><strong>สั่งซื้อสินค้า</strong></h5></td>
      </thead>
    </tr>
    <tr class="success"  style="background-color:#f4f4f4">
      <td width="5%" align="center"><strong>ลำดับ</strong></td>
      <td width="10%" align="center"><strong>ภาพสินค้า</strong></td>
      <td width="20%" align="center"><strong>ชื่อสินค้า</strong></td>
      <td width="15%" align="center"><strong>ราคา</strong></td>
      <td width="15%" align="center"><strong>จำนวน</strong></td>
      <td width="17%" align="center"><strong>รวม/รายการ</strong></td>
    </tr>
  <form  name="formlogin" action="saveorder.php" method="POST" id="login" class="form-horizontal">
<?php
	require_once('../condb.php');
	$total=0;
	foreach($_SESSION['shopping_cart'] as $p_id=>$p_qty)
	{
		$sql = "select * from tbl_product where p_id=$p_id";
		$query = mysqli_query($con, $sql);
		$row	= mysqli_fetch_array($query);
		$sum	= $row['p_price']*$p_qty;
		$total	+= $sum;
    echo "<tr>";
	echo "<td align='center'>";
	echo  $i += 1;
	echo "</td>";
  echo "<td align='center'>";
  echo "<img src='../p_img/".$row['p_img']."' width='100'>";
  echo "</td>";
    echo "<td align='center'>" . $row["p_name"] . "</td>";
    echo "<td align='center'>" .number_format($row['p_price'],2) ."</td>";
    echo "<td align='center'>$p_qty</td>";
    echo "<td align='center'>".number_format($sum,2)."</td>";
    echo "</tr>";
?>

<input type="hidden"  name="p_name[]" value="<?php echo $row['p_name']; ?>" class="form-control" required placeholder="ชื่อ-สกุล" />

    <?php 
	}
	echo "<tr>";
  echo "<tr>";
    echo "<td  align='right' colspan='5' bgcolor='#F0B27A'><b>รวม</b></td>";
    echo "<td align='center' bgcolor='#F0B27A'>"."<b>".number_format($total,2)." บาท </b>"."</td>";
  echo "</tr>";

  echo "<tr>";
    echo "<td  align='right' colspan='5' bgcolor='#F0B27A'><b>แต้มที่คุณจะได้รับ</b></td>";
    echo "<td align='center' bgcolor='#F0B27A'>"."<b>".number_format($total/40)." แต้ม </b>"."</td>";
  echo "</tr>";

?>
</table>
		</div>
	</div>
</div>
<br>
<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
    <div class="col-md-8" style="background-color:#FDEBD0">
      <h4 align="center">
      <span class="glyphicon glyphicon-shopping-cart"> </span>
         <br> <b>ที่อยู่ในการจัดส่งสินค้า</b></h4>

        <div class="form-group">
          <div class="col-sm-12">
            <input type="text"  name="name" value="<?php echo $row_buyer['m_name']; ?>" class="form-control" required placeholder="ชื่อ-สกุล" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <textarea name="address" class="form-control"  rows="3"  required placeholder="ที่อยู่ในการส่งสินค้า"><?php echo $row_buyer['m_address']; ?></textarea> 
          </div>
 
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text"  name="phone" value="<?php echo $row_buyer['m_tel']; ?>" class="form-control" required placeholder="เบอร์โทรศัพท์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="email"  name="email" class="form-control" value="<?php echo $row_buyer['m_email']; ?>" required placeholder="อีเมล์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12" align="center">
            <input name="member_id" type="hidden" id="member_id" value="<?php echo $row_buyer['member_id']; ?>">
            <br>

            <input type="hidden" name="amount" value="<?php echo ($total/40);?>">

            <button type="submit" class="btn btn-success" id="btn">
             ยืนยันสั่งซื้อ </button>
             <a href="index.php" class="btn btn-danger">ยกเลิก</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</div>
</div>
</div>
</div>

<?php
  
mysqli_free_result($buyer);
?>