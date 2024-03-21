<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');

if($_SESSION['m_level']!='admin'){
    Header("Location: index.php");
}

$s_name = mysqli_real_escape_string($con,$_POST["s_name"]);
$s_unit = mysqli_real_escape_string($con,$_POST["s_unit"]);
$s_stock = mysqli_real_escape_string($con,$_POST["s_stock"]);
$date1 = date("Ymd_His");
$numrand = (mt_rand());
$upload = (isset($_FILES['s_img']) ? $_FILES['s_img']['name'] : '');

if($upload != '') { 
    $path = "../s_img/";
    $type = strrchr($_FILES['s_img']['name'],".");
    $newname = $numrand.$date1.$type;
    $path_copy = $path.$newname;
    $path_link = "../s_img/".$newname;
    move_uploaded_file($_FILES['s_img']['tmp_name'], $path_copy); 
}

$sql = "INSERT INTO tbl_ingredient 
        (
            s_name,
            s_unit,
            s_stock,
            s_img
            
            )
            VALUES
            (
            '$s_name',
            '$s_unit',
            '$s_stock',
            '$newname'
        )";

$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

mysqli_close($con);

if($result){
    echo '<script>';
    echo "window.location='stock.php?do=success';";
    echo '</script>';
}else{
    echo '<script>';
    echo "window.location='stock.php?act=add&do=f';";
    echo '</script>';
}
?>