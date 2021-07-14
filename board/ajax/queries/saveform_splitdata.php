<?php
include('../../../config.php');

$firstboard = mysqli_real_escape_string($mysqli, $_POST['firstboard']);
$secondboard = mysqli_real_escape_string($mysqli, $_POST['secondboard']);
$theindex = mysqli_real_escape_string($mysqli, $_POST['theindex']);
$countmaxboard = getmaxboardnumber($theindex);
$userid = $_SESSION['userid'];
$username = getusername($userid);
$datetime = date("Y-m-d H:i:s");

//Getting main board
$getmain = $mysqli->query("select * from boards where boardid = '$theindex'");
$resmain = $getmain->fetch_assoc();
$mainboardid = $resmain['mainboardid'];
if ($mainboardid == "") {
    $mainboardid = $theindex;
}


$getdetails = $mysqli->query("select * from boards where (boardname = '$firstboard' OR boardname = '$secondboard')");
$countdetails = mysqli_num_rows($getdetails);
if ($countdetails == '0') {

         $mysqli->query("INSERT INTO `boards`
         (`boardname`,
          `boardnumber`,
          `entrydate`,
          `status`,
          `type`,
          `parentboardid`,
          `mainboardid`)
VALUES (
     '$firstboard',
     '$countmaxboard',
     '$datetime',
     'Active',
     'Split',
     '$theindex',
     '$mainboardid')") or die(mysqli_error($mysqli));

    $mysqli->query("INSERT INTO `boards`
    (`boardname`,
    `boardnumber`,
    `entrydate`,
    `status`,
    `type`,
    `parentboardid`,
    `mainboardid`)
    VALUES (
    '$secondboard',
    '$countmaxboard',
    '$datetime',
    'Active',
    'Split',
    '$theindex',
    '$mainboardid')") or die(mysqli_error($mysqli));

    $mysqli->query("UPDATE `boards` SET newboards = '1' where boardid = '$theindex'") or die(mysqli_error($mysqli));

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
        'Board Added',
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
        'Attempted to add Board (Already exists)',
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