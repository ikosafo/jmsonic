<?php
include('../../../config.php');

$selectboard = mysqli_real_escape_string($mysqli, $_POST['selectboard']);
$selectcolour = mysqli_real_escape_string($mysqli, $_POST['selectcolour']);
$amounttopay = mysqli_real_escape_string($mysqli, $_POST['amounttopay']);
//print_r($_POST);
$datetime = date("Y-m-d H:i:s");

$getdetails = $mysqli->query("select * from exitfee where boardid = '$selectboard'");
$countdetails = mysqli_num_rows($getdetails);

if ($countdetails == '0') {

    $mysqli->query("INSERT INTO `exitfee`
    (`boardid`,
     `amounttopay`,
     `entrytime`)
    VALUES (
        '$selectboard',
        '$amounttopay',
        '$datetime')") or die(mysqli_error($mysqli));

    echo 1;
    }
else {
    echo 2;
    }

