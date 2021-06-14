<?php
include('../../../config.php');

$selectboard = mysqli_real_escape_string($mysqli, $_POST['selectboard']);
$selectcolour = mysqli_real_escape_string($mysqli, $_POST['selectcolour']);
$amounttoreceive = mysqli_real_escape_string($mysqli, $_POST['amounttoreceive']);
$sendcolour = mysqli_real_escape_string($mysqli, $_POST['sendcolour']);
//print_r($_POST);
$datetime = date("Y-m-d H:i:s");

$getdetails = $mysqli->query("select * from paymentconfig where (paycolid = '$sendcolour' OR reccolid = '$selectcolour')
                              and boardid = '$selectboard'");
$countdetails = mysqli_num_rows($getdetails);

if ($countdetails == '0') {

    $mysqli->query("INSERT INTO `paymentconfig`
        (
        `paycolid`,
        `reccolid`,
        `boardid`,
        `entrydate`,
        `amounttopay`)
        VALUES (
        '$sendcolour',
        '$selectcolour',
        '$selectboard',
        '$datetime',
        '$amounttoreceive')
        ") or die(mysqli_error($mysqli));

    echo 1;
    }
else {
    echo 2;
    }

