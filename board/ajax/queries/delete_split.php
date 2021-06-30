<?php
include('../../../config.php');

$splitid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("DELETE
FROM `splitconfig`
WHERE `splitconfigid` = '$splitid'") or die(mysqli_error($mysqli));
echo 1;

?>