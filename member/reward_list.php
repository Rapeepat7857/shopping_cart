<?php
//คิวรี่แต้มที่มี
$sql = "SELECT * FROM tbl_member WHERE member_id=$member_id";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);

$my_point = $row['my_point'];

?>

<h4>เมนูที่ใช้คะแนนแลก  :: แต้มที่มี <?php echo $my_point;?> แต้ม </h4>
<table class="table table-hover table-striped table-hover table-bordered">
<thead align="center">
  <tr>
    <th>ID</th>
    <th>ภาพ</th>
    <th>ชื่อ</th>
    <th>คะแนนที่ใช้</th>
    <th>สถานะ</th>
    <th>ทำรายการ</th>
  </tr>
  </thead>
  <tbody>
    <?php
//คิวรีข้อมุลของรางวัล
    $query_reward = "SELECT * FROM tbl_reward WHERE reward_status=1";
    $result_reward = mysqli_query($con, $query_reward);
    foreach($result_reward as $row){
    ?>
    <tr align="center">
      <td><?php echo $row['id'];?></td>
      <td>
        <img src="../reward/<?php echo $row['reward_img'];?>" width="70px">
    </td>
      <td><?php echo $row['reward_name'];?></td>
      <td><?php echo $row['reward_point'];?></td>
      <td align="center">
        <?php
        //สร้างเงื่อนไขว่าแต้มพอไหม

        if ($my_point >= $row['reward_point']) {
            echo '<font color="green"> แลกได้ </font>';
        }else{
            echo '<font color="red"> แต้มไม่พอ </font>';
        }

        ?>

      </td>
      <td align="center">     
      <?php
        //สร้างเงื่อนไขว่าถ้าแต้มพอแลกจะแสดงลิงค์
        if ($my_point >= $row['reward_point']) { ?>
          <a href="my_order.php?page=reward_detail&id=<?php echo $row['id'];?>" class="btn btn-success btn-xs"> แลกซื้อ </a></td>
        <?php } ?>
    </tr>
    <?php } ?>
    </tbody>
  </table>
