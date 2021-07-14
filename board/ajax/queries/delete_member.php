<?php
include('../../../config.php');

$previewid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$userid = $_SESSION['userid'];
$username = getusername($userid);
$datetime = date('Y-m-d H:i:s');

$mysqli->query("UPDATE `previewboard` SET `status` = '2'
WHERE (`previd` = '$previewid' AND `payment` = '0')") or die(mysqli_error($mysqli));

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
            'User Removed',
            '$datetime',
            '$ip_add',
            '$mac_address',
            '$datetime',
            'Successful',
            '$username'
            )") or die(mysqli_error($mysqli));
    echo 1;

?>