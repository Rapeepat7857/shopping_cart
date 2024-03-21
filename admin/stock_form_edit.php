<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tbl_ingredient WHERE s_id=$ID";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
?>
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<form action="stock_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="col-sm-2 control-label">
      ชื่อวัตถุดิบ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="s_name" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ปริมาณ :
    </div>
    <div class="col-sm-1">
      <input type="number" name="s_stock" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      หน่วย :
    </div>
    <div class="col-sm-1">
    <select name="s_unit" id="s_unit" required>
              <option value="">กรุณาเลือก</option>
              <option value="ชิ้น">ชิ้น</option>
              <option value="กล่อง">กล่อง</option>
              <option value="อัน">อัน</option>
              <option value="อัน">แก้ว</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      รูปวัตถุดิบ :
    </div>
    <div class="col-sm-4">
      รูปวัตถุดิบเก่า <br>
      <img src="../s_img/<?php echo $row['s_img'];?>" width="200px">
      <br>
      <input type="file" name="s_img"  class="form-control" accept="image/*" onchange="readURL(this);"/>
      <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="s_img2" value="<?php echo $row['s_img'];?>">
      <input type="hidden" name="s_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="stock.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>