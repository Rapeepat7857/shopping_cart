<?php require_once('../condb.php'); ?>
<?php
  error_reporting( error_reporting() & ~E_NOTICE );
    session_start(); 
    //$member_id=$_SESSION['member_id'];

  //print_r($_SESSION);
// echo $member_id;
$query_buyer = "SELECT * FROM tbl_member WHERE member_id = $member_id";
$buyer = mysqli_query($con, $query_buyer) or die ("Error in query: $query_buyer " . mysqli_error());
$row_buyer = mysqli_fetch_assoc($buyer);
$totalRows_buyer = mysqli_num_rows($buyer);

//ประกาศตัวแปรแต้มที่มี
$my_point = $row_buyer['my_point'];
//exit();

$query_rb = "SELECT * FROM tbl_bank";
$rb =mysqli_query($con, $query_rb) or die ("Error in query: $query_rb " . mysqli_error());
$row_rb = mysqli_fetch_assoc($rb);
$totalRows_rb = mysqli_num_rows($rb);


  $order_id = $_GET['order_id'];
  
$query_cartdone ="
SELECT * FROM 
tbl_order as o, 
tbl_order_detail as d, 
tbl_product as p,
tbl_member  as m
WHERE o.order_id = $order_id
AND o.order_id=d.order_id 
AND d.p_id=p.p_id
AND o.member_id = m.member_id 
ORDER BY o.order_date ASC";
$cartdone = mysqli_query($con, $query_cartdone) or die ("Error in query: $query_cartdone " . mysqli_error());
// echo($query_cartdone);
// exit();

$row_cartdone = mysqli_fetch_assoc($cartdone);
$totalRows_cartdone = mysqli_num_rows($cartdone);

?>
    <style type="text/css">
input[type='radio'] {
  -webkit-appearance: none;
  width: 20px;
  height: 20px;
  border: 1px solid darkgray;
  border-radius: 50%;
  outline: none;
  box-shadow: 0 0 5px 0px gray inset;
}
input[type='radio']:hover {
  box-shadow: 0 0 5px 0px orange inset;
}
input[type='radio']:before {
  content: '';
  display: block;
  width: 60%;
  height: 60%;
  margin: 20% auto;
  border-radius: 50%;
}
input[type='radio']:checked:before {
  background: red;
}
 
</style>
<form action="add_payslip_db.php" method="post" enctype="multipart/form-data" name="formpay" id="formpay">
  <table width="700" border="1" align="center" class="table">
    <tr>
      <td colspan="5" align="center"><strong>รายการสั่งซื้อล่าสุด คุณ<?php echo $row_cartdone['m_name'];?> <br />
        <font color="red"> สถานะ :
        <?php
        $status =  $row_cartdone['order_status'];
        include('status.php');
        
        ?>
      </font></strong></td>
    </tr>
    <tr>
      <td colspan="5" align="center">
        <strong><font color="red">
        </font></strong>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="41%" align="left" valign="top"><strong><font color="red"><br />
              ชำระเงิน ธ.<?php echo $row_cartdone['b_name'];?> <br />
              เลข บ/ช <?php echo $row_cartdone['b_number'];?> <br />
              จำนวน <?php echo $row_cartdone['pay_amount'];?><br />
              วันที่ชำระ <?php echo date('d/m/Y',strtotime($row_cartdone['pay_date']));?></font><br />
              <h4 style="color:blue">
              เลขพัสดุ :  <?php echo $row_cartdone['postcode'];?>
              </h4>
              </strong>
            </td>
            <td width="59%"><strong><font color="red"><img src="pimg/<?php echo $row_cartdone['pay_slip'];?>"  width="300px"/></font></strong></td>
          </tr>
        </table>
        <strong><font color="red"><br />
        
      </font></strong></td>
    </tr>
    <tr class="success">
      <td width="99" align="center">รหัส</td>
      <td width="120" align="center">สินค้า</td>
      <td width="118" align="center">ราคา</td>
      <td width="238" align="center">จำนวน</td>
      <td width="100" align="center">รวม</td>
    </tr>
    <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_cartdone['d_id'];?></td>
      <td><?php echo $row_cartdone['p_name'];?></td>
      <td align="center"><?php echo $row_cartdone['p_price'];?></td>
      <td align="center"><?php echo $row_cartdone['p_c_qty'];?></td>
      <td align="center"><?php echo number_format($row_cartdone['total'],2);?></td>
    </tr>
    <?php
    $sum  = $row_cartdone['p_price']*$row_cartdone['p_c_qty'];
    $total  += $sum;
    //echo $total;
    ?>
    <?php } while ($row_cartdone = mysqli_fetch_assoc($cartdone)); ?>
    <tr>
      <td colspan="4" align="center"  bgcolor='#F0B27A'>รวม</td>
      <td align="center"  bgcolor='#F0B27A'><b> <?php echo number_format($total,2);?></b></td>
    </tr>

    <tr>
      <td colspan="4" align="center"  bgcolor='#F0B27A'>แต้มที่จะได้รับ</td>
      <td align="center"  bgcolor='#F0B27A'><b> <?php echo number_format($total/40);?> แต้ม </b></td>
    </tr>
    
  </table>

  <?php
  //รวมแต้มของเก่าและของใหม่ที่จะได้รับ
  $total_point = ($my_point + $total/40);

  //echo $total_point;


  // $status =  $row_cartdone['order_status'];
  if($status > 1){ }else{?>
  <br /><br />
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="40" colspan="6" align="left" bgcolor="#FFFFFF">
        <h4>รายละเอียดการโอนเงิน
        <br />   <br />
        <font color="red">
        *เลือกบัญชีที่โอนเงิน
        </font>
      </h4></td>
    </tr>
    <?php do { ?>
    <tr>
      <td width="10%" align="center">&nbsp;</td>
      <td width="5%" align="center">
        <input <?php if (!(strcmp($row_rb['b_name'],"b_bank"))) {echo "checked=\"checked\"";} ?> type="radio" name="bank"  value="<?php echo $row_rb['b_name'].'-'.$row_rb['b_number'];?>" required="required" />
      </td>
      <td ><img src="../b_logo/<?php echo $row_rb['b_logo']; ?>" width="50"></td>
      <td align="left">ธนาคาร <?php echo $row_rb['b_name']; ?></td>
      <td align="left"><?php echo $row_rb['b_number']; ?></td>
      <td align="left"><strong>สาขา</strong> <?php echo $row_rb['bn_name']; ?></td>
    </tr>
    <?php } while ($row_rb = mysqli_fetch_assoc($rb)); ?>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center">วันที่ชำระเงิน</td>
      <td colspan="5" align="left"><label for="pay_date"></label>
      <input type="date" name="pay_date" id="pay_date" value="<?php echo date('Y-m-d');?>"/></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center">จำนวนเงิน</td>
      <td colspan="5" align="left"><label for="pay_amount"></label>
      <input type="number" name="pay_amount" id="pay_amount"  value="<?php echo $total; ?>" required="required"/></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center">หลักฐานการโอน</td>
      <td colspan="5" align="left"><input name="pay_slip" type="file"  required="required"/>
    (ไฟล์ .jpg, gif, png, pdf&nbsp;ไม่เกิน 2mb)</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td><input name="order_id" type="hidden" id="order_id" value="<?php echo $order_id; ?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>

<p align="center"><br />
  <input type="hidden" name="my_point" value="<?php echo $total_point;?>">
  <input type="hidden" name="member_id" value="<?php echo $member_id;?>">
  <button type="submit" name="add" class="btn btn-success"> แจ้งชำระเงิน </button>
    <a href="index.php" class="btn btn-danger">ยกเลิก</a>
</p>
</form>
<?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
    </div>
  </div>
</div>

<?php  
mysqli_free_result($buyer);

mysqli_free_result($rb);

mysqli_free_result($cartdone);
?>