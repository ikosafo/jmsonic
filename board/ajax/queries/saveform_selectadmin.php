<?php
include('../../../config.php');

$user_id = mysqli_real_escape_string($mysqli, $_POST['selectuser']);
$userid = $_SESSION['userid'];
$username = getusername($userid);
$usermem = getusername($user_id);
$datetime = date('Y-m-d H:i:s');

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
        '$usermem made administrator',
        '$datetime',
        '$ip_add',
        '$mac_address',
        '$datetime',
        'Successful',
        '$username'
        )") or die(mysqli_error($mysqli));

        $mysqli->query("UPDATE `users`
        SET `roleid` = '1'
        WHERE `userid` = '$user_id'") or die(mysqli_error($mysqli));

echo 1

    ?>