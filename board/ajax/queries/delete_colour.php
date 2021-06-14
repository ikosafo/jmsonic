<?php
include('../../../config.php');

$colourid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("UPDATE `colourconfig`
SET `status` = 'Deleted'
WHERE `colourid` = '$colourid'") or die(mysqli_error($mysqli));
    echo 1;

?>