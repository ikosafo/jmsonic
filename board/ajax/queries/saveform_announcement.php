<?php

include('../../../config.php');

$anntitle = mysqli_real_escape_string($mysqli, $_POST['anntitle']);
$announcement = mysqli_real_escape_string($mysqli, $_POST['announcement']);
//print_r($_POST);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `announcements`
(`anntitle`,
 `announcement`,
 `periodsent`)
VALUES ('$anntitle',
'$announcement',
'$datetime')") or die(mysqli_error($mysqli));



?>