<?php
include('../../../config.php');

$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);
$userid = $_SESSION['userid'];
$username = getusername($userid);
$userapproved = getusername($id_index);
$datetime = date('Y-m-d H:i:s');

$mysqli->query("UPDATE `users`
SET `userstatus` = '5', `roleid` = '3'
WHERE `userid` = '$id_index'") or die(mysqli_error($mysqli));

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
        'Sign up approved for $userapproved',
        '$datetime',
        '$ip_add',
        '$mac_address',
        '$datetime',
        'Successful',
        '$username'
        )") or die(mysqli_error($mysqli));
echo 1;

?>