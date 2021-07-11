<?php
include('../../../config.php');

$previewid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("UPDATE `previewboard` SET `payment` = '1'
WHERE (`previd` = '$previewid')") or die(mysqli_error($mysqli));
    echo 1;

?>