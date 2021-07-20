<?php
include('../../../config.php');

$selectboard = mysqli_real_escape_string($mysqli, $_POST['selectboard']);
$colourname = mysqli_real_escape_string($mysqli, $_POST['colourname']);
$selectcolour = mysqli_real_escape_string($mysqli, $_POST['selectcolour']);
$colournum = mysqli_real_escape_string($mysqli, $_POST['colournumber']);
$colourpriority = mysqli_real_escape_string($mysqli, $_POST['colourpriority']);

$getcolournumber = $mysqli->query("select * from numberconfig where numberid = '$colournum'");
$rescolournumber = $getcolournumber->fetch_assoc();
$colournumber = $rescolournumber['subnumber'];

$userid = $_SESSION['userid'];
$username = getusername($userid);
$datetime = date("Y-m-d H:i:s");

$getdetails = $mysqli->query("select * from colourconfig where (colourcode = '$selectcolour' OR colourname = '$colourname')
                              and boardid = '$selectboard' and status = 'Active'");
$countdetails = mysqli_num_rows($getdetails);

if ($countdetails == '0') {
    $getnumbervald = $mysqli->query("SELECT SUM(numberassign) AS sumcolour FROM colourconfig WHERE boardid = '$selectboard' and status = 'Active'");
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
             `status`,
             `colourpriority`
             )
VALUES ('$selectboard',
        '$colournumber',
        '$colourname',
        '$datetime',
        '$selectcolour',
        'Active',
        '$colourpriority'
        )") or die(mysqli_error($mysqli));

        $mysqli->query("INSERT INTO `logs`
        (
        `userid`,
        `activity`,
        `periodofactivity`,
        `ipaddress`,
        `macaddress`,
        `entrydate`,
        `status`,
        `username`
        )
        VALUES (
        '$userid',
        'Colour Added',
        '$datetime',
        '$ip_add',
        '$mac_address',
        '$datetime',
        'Successful',
        '$username'
        )") or die(mysqli_error($mysqli));

        echo 1;
    }
    else {

        $mysqli->query("INSERT INTO `logs`
        (
        `userid`,
        `activity`,
        `periodofactivity`,
        `ipaddress`,
        `macaddress`,
        `entrydate`,
        `status`,
        `username`
        )
        VALUES (
        '$userid',
        'Colour Added failed (Maximum number exceeded)',
        '$datetime',
        '$ip_add',
        '$mac_address',
        '$datetime',
        'Unsuccessful',
        '$username'
        )") or die(mysqli_error($mysqli));

        echo 3;
    }

}
else {

    $mysqli->query("INSERT INTO `logs`
    (
    `userid`,
    `activity`,
    `periodofactivity`,
    `ipaddress`,
    `macaddress`,
    `entrydate`,
    `status`,
    `username`
    )
    VALUES (
    '$userid',
    'Colour Added failed (Colour already exists)',
    '$datetime',
    '$ip_add',
    '$mac_address',
    '$datetime',
    'Unsuccessful',
    '$username'
    )") or die(mysqli_error($mysqli));
    echo 2;
}



?>