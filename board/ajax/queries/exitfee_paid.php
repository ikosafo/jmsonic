<?php
include('../../../config.php');

    $boardid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

    $gethigh = $mysqli->query("select * from previewboard p join colourconfig c 
                                ON p.colourid = c.colourid where p.boardid = '$boardid' 
                                and c.colourpriority = 'Highest'");
    $reshigh = $gethigh->fetch_assoc();
    $userid = $reshigh['userid'];
    $datetime = date("Y-m-d H:i:s");

    $mysqli->query("UPDATE `boards`
    SET `exitfeepaid` = '1'
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
    'Exit Fee Paid',
    '$datetime',
    '$ip_add',
    '$mac_address',
    '$datetime',
    'Successful',
    '$username'
    )") or die(mysqli_error($mysqli));
    echo 1;

?>