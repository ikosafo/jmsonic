<?php

include('../../../config.php');

$boardname = mysqli_real_escape_string($mysqli, $_POST['boardname']);
$boardnumber = mysqli_real_escape_string($mysqli, $_POST['boardnumber']);
$userid = $_SESSION['userid'];
$username = getusername($userid);
$datetime = date("Y-m-d H:i:s");

$getdetails = $mysqli->query("select * from boards where boardname = '$boardname'");
$countdetails = mysqli_num_rows($getdetails);
if ($countdetails == '0') {

    //Count number of boards
    $countboard = mysqli_num_rows($mysqli->query("select * from boards"));
    if ($countboard < 3) {
                $mysqli->query("INSERT INTO `boards`
                (`boardname`,
                `boardnumber`,
                `entrydate`,
                `type`,
                `status`)
        VALUES ('$boardname',
            '$boardnumber',
            '$datetime',
            'Main',
            'Active')") or die(mysqli_error($mysqli));

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
        'Attempted to add board (Maximium number exceeded)',
        '$datetime',
        '$ip_add',
        '$mac_address',
        '$datetime',
        'Unsuccessful',
        '$username'
        )") or die(mysqli_error($mysqli));
        echo 4;
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