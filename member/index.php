<?php
//session_start();
include('h.php');
include("../condb.php");
?>
<!DOCTYPE html>
<head>
  <?php include('../boot4.php');?>
  
  <style type="text/css">
  input[type=number]{
  width:40px;
  text-align:center;
  color:red;
  font-weight:600;
  }
  </style>
</head>
<body>   
   <div class="container">
 <?php
  include('banner.php');
  include('navbar.php');
  ?>  
      <div class="row">
      <div class="col-md-9">
        <div class="container" style="margin-top: 10px">
          <div class="row">
            <?php
            $act = (isset($_GET['act']) ? $_GET['act'] : '');
            $q = $_GET['q'];
            if($act=='showbytype'){
            include('list_prd_by_type.php');
            }
            else if($q!=''){
            include("show_product_q.php");
            }else if($act=='profile'){
              include("show_profile.php");
              }
            else{
            include('show_product.php');
            }
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="container" style="margin-top: 10px">
          <?php
          include('cart.php');
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php include('script4.php');?>