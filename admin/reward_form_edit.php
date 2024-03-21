<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tbl_reward WHERE id=$ID";
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
<form action="reward_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="col-sm-2 control-label">
      ชื่อสินค้า :
    </div>
    <div class="col-sm-3">
      <input type="text" name="reward_name" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      แต้มที่ใช้แลก :
    </div>
    <div class="col-sm-1">
      <input type="number" name="reward_point" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      สถานะ :
    </div>
    <div class="col-sm-1">
    <select name="reward_status" id="reward_status" required>
              <option value="">กรุณาเลือก</option>
              <option value="1">แลกได้</option>
              <option value="2">รายการที่แลกแล้ว</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      รูป :
    </div>
    <div class="col-sm-4">
      รูปเก่า <br>
      <img src="../reward/<?php echo $row['reward_img'];?>" width="200px">
      <br>
      <input type="file" name="reward_img"  class="form-control" accept="image/*" onchange="readURL(this);"/>
      <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="reward_img2" value="<?php echo $row['reward_img'];?>">
      <input type="hidden" name="id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="raward.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>