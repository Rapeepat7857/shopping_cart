<?php 
  $query = "SELECT * FROM tbl_reward as s
  ORDER BY s.id DESC";
  
  $result = mysqli_query($con, $query);
  if (!$result) {
      die("Error: " . mysqli_error($con));
  }
  
  echo '<table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
  echo "<tr class=''>
          <th width='3%' class='hidden-xs'>ID</th>
          <th width='20%'>ชื่อสินค้า</th>
          <th width='8%' class='hidden-xs'>รูป</th>
          <th width='30%' class='hidden-xs'>แต้มที่ใช้แลก</th>
          <th>สถานะ</th>
          <th></th>
        </tr>";
  echo "</thead>";
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td class='hidden-xs'>" . $row["id"] . "</td> ";
      echo "<td> ชื่อ: " . $row["reward_name"] . "</td> ";
      echo "<td class='hidden-xs'>"."<img src='../reward/".$row['reward_img']."' width='100%'>"."</td>";
      echo "<td class='hidden-xs'>" . $row["reward_point"] . "</td> ";
      echo "<td class='hidden-xs'>";
      if($row["reward_status"]==1){
        echo 'แลกได้';
    } else {
        echo 'ถูกแลกไปแล้ว';
    }
      "</td> ";
      "</td> ";
      echo "<td><a href='reward.php?act=edit&ID=$row[id]' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-edit'></span></a> 
            <a href='reward_del_db.php?ID=$row[id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-trash'></span></a>        
        </td> ";
  
      echo "</tr>";
  }
  echo "</table>";
  mysqli_close($con);
  ?>