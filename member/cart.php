<?php
error_reporting( error_reporting() & ~E_NOTICE );
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
	echo "window.location ='index.php'; ";
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
?>
<br>
<form id="frmcart" name="frmcart" method="post" action="?act=update">
	<table width="100%" border="0" align="center" class="table1 table-hover1">
		<tr>
			<td height="40" colspan="5" align="center" bgcolor="#F8C471"><strong><b>ตะกร้าสินค้า</strong></td>
		</tr>
		<tr>
			<td><center>สินค้า</center></td>
			<td><center>ราคา</center></td>
			<td><center>จำนวน</center></td>
			<td><center>รวม</center></td>
			<td><center>ลบ</center></td>
		</tr>
		<?php
		if(!empty($_SESSION['shopping_cart']))
		{
		require_once('../condb.php');
			foreach($_SESSION['shopping_cart'] as $p_id=>$p_qty)
			{
				$sql = "select * from tbl_product where p_id=$p_id";
				$query = mysqli_query($con, $sql);
				while($row = mysqli_fetch_array($query))
				{
				
				$sum = $row['p_price'] * $p_qty;
				$pqty = $row['p_qty'];
				$total += $sum;
				echo "<tr>";
					echo "<td width='20px'>";
					echo "<img src='../p_img/".$row['p_img']."' width='50'>";
					echo "</td>";
					echo "<td width='70px' align='right'>" .number_format($row["p_price"]) . "</td>";
					echo "<td width='20px' align='right'>";
					echo "<input type='number' name='amount[$p_id]' value='$p_qty' max='$pqty' min='0'  width='20px'/></td>";
					echo "<td width='70px' align='right'>";
					echo  number_format($sum). '  ';
					echo "</td>";
					echo "<td width='100' align='center'><a href='index.php?p_id=$p_id&act=remove' class='btn btn-danger btn-sm'>x</a></td>";	
					echo "</tr>";
					}
			
				}
				echo "<tr>";
					echo "<td colspan='3' bgcolor='#AED6F1' align='left'><b>รวม</b></td>";
					echo "<td colspan='2' align='right' bgcolor='#ECF0F1'>";
					echo "<b>";
					echo  number_format($total,2);
					echo "</b>";
					echo "</td>";
				
				echo "</tr>";
			}
			?>
		</table>
		<p align="">
			<?php if($total > 0){ ?>
				<td colspan="3" align="right"><hr>
				<button type="submit" name="button" id="button" class="btn btn-warning btn-sm"> คำนวณราคา </button>
				<?php $chk = $_GET['act'];
				if($chk=='update'){?>
				<button type="button" name="Submit2"  onclick="window.location='confirm_order.php';" class="btn btn-danger btn-sm">
				บันทึกรายการสั่งซื้อ </button>
				<?php }else{ }?>
			</td>
			<?php }else {
						echo "<font color='red'>";
						echo "ไม่มีรายการสั่งซื้อ";
						echo "</font>";
			} ?>
		</p>
	</form>