<?php
include('../../../config.php');

$boardid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("UPDATE `boards`
SET `status` = 'Deleted'
WHERE `boardid` = '$boardid'") or die(mysqli_error($mysqli));
    echo 1;

?>