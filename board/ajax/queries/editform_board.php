<?php

include('../../../config.php');
$boardname = mysqli_real_escape_string($mysqli, $_POST['boardname']);
$boardnumber = mysqli_real_escape_string($mysqli, $_POST['boardnumber']);
$boardid = mysqli_real_escape_string($mysqli, $_POST['boardid']);
$userid = $_SESSION['userid'];
$username = getusername($userid);
$datetime = date("Y-m-d H:i:s");

$getdetails = $mysqli->query("select * from boards where boardname = '$boardname'");
$countdetails = mysqli_num_rows($getdetails);
if ($countdetails == '0') {
    $mysqli->query("UPDATE `boards`
SET
  `boardname` = '$boardname',
  `boardnumber` = '$boardnumber'

WHERE `boardid` = '$boardid'") or die(mysqli_error($mysqli));

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
    'Board Updated',
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
        'Attempted to update Board (Already exists)',
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