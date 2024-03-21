<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
    <!-- Left side column. contains the logo and sidebar -->
    
        <?php include('menu_l.php');?>
      
    <div class="content-wrapper">
      <section class="content-header">
      <h1>
        <i class="glyphicon glyphicon-edit hidden-xs"></i> <span class="hidden-xs">รายการสั่งซื้อสินค้า</span>
        &nbsp; <a href="index.php" class="btn btn-danger btn-xs"> รอชำระเงิน </a>  ||
        <a href="index.php?act=show-payed" class="btn btn-success btn-xs"> ชำระเงินแล้ว </a> ||
        <a href="index.php?act=show-post" class="btn btn-primary btn-xs"> ส่งของแล้ว </a>
        <a href="index.php?act=show-reward" class="btn btn-primary btn-xs"> รายการที่ใช้คะแนนแลก </a>
        </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="box-body">
                    <?php
                  $act = (isset($_GET['act']) ? $_GET['act'] : '');
                  if($act=='show-order'){
                  include('detail_order_afer_cartdone.php');
                  }elseif($act=='show-payed'){
                  include('show_cart_pay.php');
                  }elseif($act=='show-post'){
                  include('show_cart_post.php');
                  }elseif($act=='show-reward'){
                  include('show_cart_reward.php');
                  }else{
                  include('show_new_cart.php');
                  }
                  ?>                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </body>
  </html>
  <?php include('footerjs.php');?>