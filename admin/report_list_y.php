
<?php
$query5 = "SELECT SUM(total) AS total, DATE_FORMAT(datesave, '%Y') AS d_date 
FROM tbl_order_detail
GROUP BY DATE_FORMAT(datesave, '%Y')
ORDER BY DATE_FORMAT(datesave, '%Y') DESC
";
$result5 = mysqli_query($con, $query5);
$resultchart = mysqli_query($con, $query5);
$query6 = "SELECT SUM(total) AS total, DATE_FORMAT(datesave, '%Y') AS o_date 
FROM tbl_order_detail
GROUP BY DATE_FORMAT(datesave, '%Y')
ORDER BY DATE_FORMAT(datesave, '%Y') DESC
";
$result6 = mysqli_query($con, $query6);
$resultchart = mysqli_query($con, $query6);


$o_date = array();
$total = array();

while ($rs = mysqli_fetch_array($resultchart)) {
    $o_date[] = "\"".$rs['o_date']."\"";
    $total[] = "\"".$rs['total']."\"";
}

    $o_date = implode(",", $o_date);
    $total = implode(",", $total);

?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

<div class="container">
<div class="row">
<div class="col-sm-10">
      <canvas id="myChart" width="800px" height="300px"></canvas>
    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: [<?php echo $o_date;?>
    
    ],
    datasets: [{
    label: 'รายงานภาพรวม แยกตามปี(บาท)',
    data: [<?php echo $total;?>
    ],
    backgroundColor: [
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(255, 206, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(255, 159, 64, 0.2)'
    ],
    borderColor: [
    'rgba(255,99,132,1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)'
    ],
    borderWidth: 1
    }]
    },
    options: {
    scales: {
    yAxes: [{
    ticks: {
    beginAtZero:true
    }
    }]
    }
    }
    });
    </script>
    

</div>
</div>  

<div class="row">
	<div class="col-sm-10">
<h3 align="center">รายงานแยกตามปี</h3>
<table width="400" border="1" class="table table-striped" cellpadding="0"  cellspacing="0" align="center">
    <thead>
        <tr>
            <th width="40%">ปี</th>
            <th width="60%">ยอดขาย</th>
        </tr>
    </thead>
    
    <?php foreach ($result5 as $value) { ?>
      

        <td align="center">
            <?php echo date('Y',strtotime($value['d_date']));?>
            
        </td>
        <td align="right"><?php echo number_format($value['total'],2);?></td>
    </tr>

   <?php
    $as += $value['total'];
    }
    //echo $at;
    ?>
    <tr>
        <td align="center">รวม</td>
        <td align="right"><?php echo number_format($as,2);?></td>
    </tr>
</table>




	 </div>
</div>






