<?php require_once('condb.php');
$query_typeprd = "SELECT * FROM tbl_type ORDER BY type_id ASC";
$typeprd =mysqli_query($con, $query_typeprd) or die ("Error in query: $query_typeprd " . mysqli_error());
// echo($query_typeprd);
// exit();
$row_typeprd = mysqli_fetch_assoc($typeprd);
$totalRows_typeprd = mysqli_num_rows($typeprd);
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <nav class="navbar navbar-expand-lg navbar-info bg-light">
        <a class="btn btn-Light" href="index.php" role="button">หน้าหลัก</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        &nbsp;<div class="btn-group">
          <button type="button" class="btn btn-Light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ประเภทสินค้า
          </button>
          <div class="dropdown-menu">
            <?php do { ?>
            <a href="index.php?act=showbytype&type_id=<?php echo $row_typeprd['type_id'];?>" class="dropdown-item"> <?php echo $row_typeprd['type_name']; ?></a>
            <?php } while ($row_typeprd = mysqli_fetch_assoc($typeprd)); ?>
            
          </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            &nbsp;
            <div class="btn-group">
              <a class="btn btn-Light" href="index.php?act=add" role="button">สมัครสมาชิก</a>
            </div>
            &nbsp;
            
            <?php
            if ($member_id!='') {
            
            } else {
            ?>
            <div class="btn-group">
              <a class="btn btn-Light" href="index.php?act=login" role="button">เข้าสู่ระบบ</a>
            </div>
            <?php } ?>
            
            
            <?php
            if ($member_id!='') {
            ?>
            <li class="nav-item">
              <a class="btn btn-Light" href="logout.php" role="button" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?')">ออกจากระบบ</a>
            </li>
            <?php } ?>
                                  
          </ul>
          <form class="form-inline my-2 my-lg-0" name="qp" action="index.php" method="GET">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          </form>       
        </div>
      </nav>
    </div>
  </div>
</div>