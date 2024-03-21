<?php
if(isset($_GET['start_date']) && !empty($_GET['start_date'])){
$member_id = $_SESSION['member_id'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$sql = "SELECT *,SUM(od.p_c_qty) as sell_high_amount,SUM(od.total) as total_sell FROM tbl_product as p INNER JOIN tbl_order_detail as od ON od.p_id = p.p_id WHERE od.datesave BETWEEN '$start_date' AND '$end_date' GROUP BY od.p_id ORDER BY sell_high_amount DESC ";
// echo $sql;
$query_sell = mysqli_query($con, $sql);
$sql_chart = "SELECT *,SUM(od.p_c_qty) as sell_high_amount,SUM(od.total) as total_sell FROM tbl_product as p INNER JOIN tbl_order_detail as od ON od.p_id = p.p_id WHERE od.datesave BETWEEN '$start_date' AND '$end_date' GROUP BY od.p_id ORDER BY sell_high_amount DESC ";
$query_chart = mysqli_query($con, $sql_chart);
$datax2 = array();
foreach ($query_chart as $k) {
$datax2[] = "['".$k['p_name'].'('.$k['sell_high_amount'].")'".", ".$k['sell_high_amount']."]";
}
$datax2 = implode(",", $datax2);
}
?>
<div class="container">
    <div class="row">
        <form method="GET">
            <div class="col-sm-3">
                <label>วันที่เริ่ม</label>
                <input type="date" class="form-control" name="start_date" value="<?=isset($_GET['start_date']) && !empty($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
            </div>
            <div class="col-sm-3">
                <label>วันที่สิ้นสุด</label>
                <input type="date" class="form-control" name="end_date" value="<?=isset($_GET['end_date']) && !empty($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
            </div>
            <div class="col-sm-3">
                <label><br></label>
                <input type="submit" class="btn btn-primary form-control" value="ออกรายงาน">
            </div>
        </form>
    </div>
    <div class="row">
        <?php if(isset($_GET['start_date']) && !empty($_GET['start_date'])){ ?>
        <br>
        <div class="col-sm-10">
            <div id="piechart2" style="width: 100%; height: 300px;"></div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Task', 'Summary per product_type'],
            <?php echo $datax2;?>
            ]);
            var options = {
            title: 'รายงานยอดขาย'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
            chart.draw(data, options);
            }
            </script>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <h4 align="left">รายงานยอดขาย</h4>
            <table width="100%" border="1" class="table table-striped" cellpadding="0"  cellspacing="0" align="center">
                <thead>
                    <tr>
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">รายการสินค้า</th>
                        <th class="text-center">จำนวน</th>
                        <th class="text-center">ยอดขายสุทธิ(บาท)</th>
                    </tr>
                </thead>
                
                <?php $i=1;while($row = mysqli_fetch_array($query_sell)) { ?>
                <tr>
                    <td align="center">
                        <?php echo $i++;?>
                    </td>
                    <td align="center">
                        <?php echo $row['p_name'];?>
                    </td>
                    <td align="center">
                        <?php echo $row['sell_high_amount'];?>
                    </td>
                    <td align="center">
                        <?php echo number_format($row['total_sell'],2);?>
                    </td>
                </tr>
                
                <?php
                $at += $row['total_sell'];
                }
                //echo $at;
                ?>
                <tr>
                    <td align="center" colspan="3"><b>รวม</b></td>
                    <td align="center"><b><?php echo number_format($at,2);?></b></td>
                </tr>
            </table>
            <?php } ?>
            <br><br>
        </div>
    </div>