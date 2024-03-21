<?php
$query2 = "SELECT * FROM tbl_type ORDER BY type_id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);
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
<?php 
 if(@$_GET['do']=='f'){
            echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
            echo '<meta http-equiv="refresh" content="2;url=durable.php?act=add" />';
 }elseif(@$_GET['do']=='d'){
            echo '<script type="text/javascript">
            swal("", "เลขครุภัณฑ์ซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
            echo '<meta http-equiv="refresh" content="1;url=durable.php?act=add" />';
 }
 ?>

<form action="reward_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
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
              <option value="2">แลกรายการแล้ว</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      รูปภาพสินค้า :
    </div>
    <div class="col-sm-4">
      <input type="file" name="reward_img" required class="form-control" accept="image/*" onchange="readURL(this);"/>
      <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
      <a href="reward.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>