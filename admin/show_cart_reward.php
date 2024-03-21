<?php 
  $query = "SELECT * FROM tbl_reward as r
  INNER JOIN tbl_point_used AS u ON r.id = u.ref_reward_id
  INNER JOIN tbl_member AS m ON u.ref_member_id = m.member_id
  WHERE r.reward_status=2"; 
//   ORDER BY r.id DESC";
  $result = mysqli_query($con, $query) or die (mysqli_error($con)); // Fix variable name to $result
  
  echo '<table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
  echo "<tr class=''>
          <th width='3%' class='hidden-xs'>ID</th>
          <th width='20%' class='hidden-xs'>สมาชิก</th>
          <th width='20%'>ชื่อสินค้า</th>
          <th width='15%' class='hidden-xs'>รูป</th>
          <th width='20%' class='hidden-xs'>แต้มที่ใช้แลก</th>

          <th></th>
        </tr>";
  echo "</thead>";
  while ($row_reward = mysqli_fetch_array($result)) { // Use $result here instead of $query
      echo "<tr>";
      echo "<td class='hidden-xs'>" . $row_reward["id"] . "</td> ";
      echo "<td class='hidden-xs'>" . $row_reward["m_name"] . "</td> "; // Assuming member_id exists in the result
      echo "<td> ชื่อ: " . $row_reward["reward_name"] . "</td> ";
      echo "<td class='hidden-xs'>"."<img src='../reward/".$row_reward['reward_img']."' width='100%'>"."</td>";
      echo "<td class='hidden-xs'>" . $row_reward["reward_point"] . "</td> ";
      echo "<td class='hidden-xs'>";
    //   if($row_reward["reward_status"]==2){
    //     echo 'รอส่ง';
    // } else {
    //     echo 'ส่งแล้ว';
    // }
      echo "</td> "; // Close td tag properly
      echo "<td><a></a> 
            <a href='reward_del_db.php?ID=$row_reward[id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-trash'></span></a>        
        </td> ";
  
      echo "</tr>";
  }
  echo "</table>";
  mysqli_close($con);
?>
