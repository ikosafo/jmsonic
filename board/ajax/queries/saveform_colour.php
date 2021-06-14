<?php
include('../../../config.php');

$selectboard = mysqli_real_escape_string($mysqli, $_POST['selectboard']);
$colourname = mysqli_real_escape_string($mysqli, $_POST['colourname']);
$selectcolour = mysqli_real_escape_string($mysqli, $_POST['selectcolour']);
$colournumber = mysqli_real_escape_string($mysqli, $_POST['colournumber']);
//print_r($_POST);
$datetime = date("Y-m-d H:i:s");

$getdetails = $mysqli->query("select * from colourconfig where (colourcode = '$selectcolour' OR colourname = '$colourname')
                              and boardid = '$selectboard'");
$countdetails = mysqli_num_rows($getdetails);

if ($countdetails == '0') {
    $getnumbervald = $mysqli->query("SELECT SUM(numberassign) AS sumcolour FROM colourconfig WHERE boardid = '$selectboard'");
    $ressum = $getnumbervald->fetch_assoc();
    $sumcolour = $ressum['sumcolour'];

    $gettotal = $mysqli->query("select * from boards where boardid = '$selectboard'");
    $restotal = $gettotal->fetch_assoc();
    $totalnumber = $restotal['boardnumber'];
    $expectednumber = $totalnumber - $sumcolour;

    if (($colournumber < $expectednumber) || ($colournumber == $expectednumber)) {
        $mysqli->query("INSERT INTO `colourconfig`
            (`boardid`,
             `numberassign`,
             `colourname`,
             `entrydate`,
             `colourcode`,
             `status`
             )
VALUES ('$selectboard',
        '$colournumber',
        '$colourname',
        '$datetime',
        '$selectcolour',
        'Active'
        )") or die(mysqli_error($mysqli));

        echo 1;
    }
    else {
        echo 3;
    }

}
else {
    echo 2;
}



?>