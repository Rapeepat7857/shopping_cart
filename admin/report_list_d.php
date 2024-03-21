<?php
$query = "SELECT SUM(total) AS total, DATE_FORMAT(datesave, '%d-%M-%Y') AS o_date
FROM tbl_order_detail
GROUP BY DATE_FORMAT(datesave, '%Y-%m-%d')
ORDER BY DATE_FORMAT(datesave, '%Y-%m-%d') DESC
";
$result = mysqli_query($con, $query);
$resultchart = mysqli_query($con, $query);
$query2 = "SELECT SUM(total) AS total, DATE_FORMAT(datesave, '%d-%M-%Y') AS o_date
FROM tbl_order_detail
GROUP BY DATE_FORMAT(datesave, '%Y-%m-%d')
ORDER BY DATE_FORMAT(datesave, '%Y-%m-%d') DESC
";
$result2 = mysqli_query($con, $query2);
$resultchart = mysqli_query($con, $query2);
$datax = array();
foreach ($result as $k) {
$datax[] = "['".$k['o_date']."'".", ".$k['total']."]";
}
//cut last commar
$datax = implode(",", $datax);
//echo $datax;


?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="piechart" style="width: 100%; height: 300px;"></div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Task', 'Summary per product_type'],
            <?php echo $datax;?>
            ]);
            var options = {
            title: 'รายงานยอดขายแยกตามวัน'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
            }
            </script>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <h3 align="center">รายงานแยกตามวัน</h3>
            <table width="400" border="1" class="table table-striped" cellpadding="0"  cellspacing="0" align="center">
                <thead>
                    <tr>
                        <th width="40%">วันที่</th>
                        <th width="60%">ยอดขาย</th>
                    </tr>
                </thead>              
                <?php while($row = mysqli_fetch_array($result2)) { ?>
                <tr>
                    <td align="center">
                        <?php echo date('d M Y',strtotime($row['o_date']));?>                       
                    </td>
                    <td align="right"><?php echo number_format($row['total'],2);?></td>
                </tr>                
                <?php
                $at += $row['total'];
                }
                //echo $at;
                ?>
                <tr>
                    <td align="center">รวม</td>
                    <td align="right"><?php echo number_format($at,2);?></td>
                </tr>
            </table>
        </div>
    </div>