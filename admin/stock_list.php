<?php 
  $query = "SELECT * FROM tbl_ingredient as s
  ORDER BY s.s_id DESC";
  
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
          <th width='30%' class='hidden-xs'>ปริมาณ</th>
          <th>หน่วย</th>
          <th></th>
        </tr>";
  echo "</thead>";
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td class='hidden-xs'>" . $row["p_id"] . "</td> ";
      echo "<td> ชื่อ: " . $row["s_name"] . "</td> ";
      echo "<td class='hidden-xs'>"."<img src='../s_img/".$row['s_img']."' width='100%'>"."</td>";
      echo "<td class='hidden-xs'>" . $row["s_stock"] . "</td> ";
      echo "<td> " . $row["s_unit"] ."</td> ";
      "</td> ";
      "</td> ";
      echo "<td><a href='stock.php?act=edit&ID=$row[s_id]' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-edit'></span></a> 
            <a href='stock_del_db.php?ID=$row[s_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-trash'></span></a>        
        </td> ";
  
      echo "</tr>";
  }
  echo "</table>";
  mysqli_close($con);
  ?>