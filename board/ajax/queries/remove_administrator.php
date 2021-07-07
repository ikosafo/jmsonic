<?php
include('../../../config.php');

$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);

$mysqli->query("UPDATE `users`
SET `roleid` = '3'
WHERE `userid` = '$id_index'") or die(mysqli_error($mysqli));
echo 1;

?>

