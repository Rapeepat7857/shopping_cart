<?php
include('h.php');
include("condb.php");
?>
<!DOCTYPE html>
<head>
  <?php include('boot4.php');?>
</head>
<body>
<?php
  include('banner.php');
  ?>
 <?php
  include('navbar.php');
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="margin-top: 10px">
        <div class="row">
            <?php
            $act = (isset($_GET['act']) ? $_GET['act'] : '');
            $q = $_GET['q'];
            if($act=='showbytype'){
            include('list_prd_by_type.php');
            }else if($q!=''){
            include("show_product_q.php");
            }else if($act=='add'){
            include("member_form_add.php");
            }else if($act=='login'){
            include("form_login.php");
            }else{
            include('show_product.php');
            }
            ?>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<?php include('script4.php');?>