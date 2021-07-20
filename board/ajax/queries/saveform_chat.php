<?php
include('../../../config.php');

$chatmessage = mysqli_real_escape_string($mysqli, $_POST['chatmessage']);
$adminusername = mysqli_real_escape_string($mysqli, $_POST['adminusername']);
$userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
$username = getusername($userid);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `chat`
(`adminuser`,
 `message`,
 `user`,
 `dateentry`,
 `messagein`)
VALUES ('$adminusername',
'$chatmessage',
'$username',
'$datetime',
'1')") or die(mysqli_error($mysqli));