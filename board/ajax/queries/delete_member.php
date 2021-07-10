<?php
include('../../../config.php');

$previewid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("UPDATE `previewboard` SET `status` = '2'
WHERE (`previd` = '$previewid' AND `payment` = '0')") or die(mysqli_error($mysqli));
    echo 1;

?>