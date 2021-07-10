<?php
include('../../../config.php');

$id = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("DELETE
FROM `announcements`
WHERE `id` = '$id'") or die(mysqli_error($mysqli));
    echo 1;

?>