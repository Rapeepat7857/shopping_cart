<?php require_once('../condb.php'); ?>
<?php 
 
// $query_typeprd = "
// SELECT d.*, COUNT(p.p_id) as ptotal 
// FROM tbl_dstrict as d 
// LEFT JOIN tbl_product as p ON d.d_id=p.d_id
// GROUP BY d.d_id" or die("Error:" . mysqli_error());
// $typeprd = mysqli_query($conn, $query_typeprd) or die ("Error in query: $query_typeprd " . mysqli_error()); 
// $row_typeprd = mysqli_fetch_assoc($typeprd);
// $totalRows_typeprd = mysqli_num_rows($typeprd); 
// echo($query_typeprd);
// exit();

$query_typeprd = "SELECT * FROM tbl_type ORDER BY type_id ASC";
$typeprd =mysqli_query($conn, $query_typeprd) or die ("Error in query: $query_typeprd " . mysqli_error());
// echo($query_typeprd);
// exit();
$row_typeprd = mysqli_fetch_assoc($typeprd);
$totalRows_typeprd = mysqli_num_rows($typeprd);
?>

<div class="list-group">
              <a href="index.php" class="list-group-item list-group-item-dark">ประเภท</a>
              
<?php do { ?>
                <a href="index.php?act=showbytype&type_id=<?php echo $row_typeprd['type_id'];?>" class="list-group-item list-group-item-action list-group-item-light"> <?php echo $row_typeprd['type_name']; ?></a>
<?php } while ($row_typeprd = mysqli_fetch_assoc($typeprd)); ?>
                        
</div>
<?php
mysqli_free_result($typeprd);
?>
