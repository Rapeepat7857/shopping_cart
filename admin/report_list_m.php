<?php
$query3 = "SELECT SUM(total) AS total, DATE_FORMAT(datesave, '%M-%Y') AS o_date
FROM tbl_order_detail
GROUP BY DATE_FORMAT(datesave, '%Y-%m')
ORDER BY DATE_FORMAT(datesave, '%Y-%m') DESC
";
$result3 = mysqli_query($con, $query3);
$resultchart = mysqli_query($con, $query3);
$query4 = "SELECT SUM(total) AS total, DATE_FORMAT(datesave, '%M-%Y') AS o_date
FROM tbl_order_detail
GROUP BY DATE_FORMAT(datesave, '%Y-%m')
ORDER BY DATE_FORMAT(datesave, '%Y-%m') DESC
";
$result4 = mysqli_query($con, $query4);
$resultchart = mysqli_query($con, $query4);
// echo $query5;
// exit();

$datax2 = array();
foreach ($result4 as $k) {
$datax2[] = "['".$k['o_date']."'".", ".$k['total']."]";
}
//cut last commar
$datax2 = implode(",", $datax2);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
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
            title: 'รายงานยอดขายแยกเดือน'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
            chart.draw(data, options);
            }
            </script>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <h3 align="center">รายงานแยกตามเดือน</h3>
            <table width="400" border="1" class="table table-striped" cellpadding="0"  cellspacing="0" align="center">
                <thead>
                    <tr>
                        <th width="40%">เดือน</th>
                        <th width="60%">ยอดขาย</th>
                    </tr>
                </thead>
                <?php while($row2 = mysqli_fetch_array($result3)) { ?>
                <tr>
                    <td align="center">
                        <?php echo date('M Y',strtotime($row2['o_date']));?>
                    </td>
                    <td align="right"><?php echo number_format($row2['total'],2);?></td>
                </tr>
                
                <?php
                $ar += $row2['total'];
                }
                //echo $at;
                ?>
                <tr>
                    <td align="center">รวม</td>
                    <td align="right"><?php echo number_format($ar,2);?></td>
                </tr>
            </table>
        </div>
    </div>