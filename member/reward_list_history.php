
<h4>ประวัติการแลก</h4>
<table class="table table-hover table-striped table-hover table-bordered">
<thead align="center">
  <tr>
    <th>ID</th>
    <th>ภาพ</th>
    <th>ชื่อ</th>
    <th>คะแนนที่ใช้</th>
    <th>สถานะ</th>
  </tr>
  </thead>
  <tbody>
    <?php
//คิวรี่ประวัติ
$query_history="SELECT u.no, u.ems_status, r.reward_name, r.reward_point, r.reward_img
FROM tbl_point_used AS u
INNER JOIN tbl_reward AS r ON u.ref_reward_id=r.id
WHERE u.ref_member_id=$member_id";

$result_history=mysqli_query($con, $query_history);
 foreach($result_history as $row){
?>
    <tr align="center">
        <td><?php echo $row['no'];?></td>
        <td>
        <img src="../reward/<?php echo $row['reward_img'];?>" width="70px">
    </td>
        <td><?php echo $row['reward_name'];?></td>
        <td><?php echo $row['reward_point'];?></td>
        <td align="center">
        <?php 
        if($row['ems_status']==0){
            echo 'รอส่ง';
        }else{
            echo 'ส่งแล้ว';
        };?>
        
    </td>
    </tr>
<?php } ?>
   </tbody>
   </table>