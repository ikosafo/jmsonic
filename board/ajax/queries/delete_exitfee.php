<?php
include('../../../config.php');
$paymentid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("DELETE
FROM `exitfee`
WHERE `exitfeeid` = '$paymentid'") or die(mysqli_error($mysqli));
    echo 1;

?>