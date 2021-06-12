<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include('../../../config.php');

$boardname = mysqli_real_escape_string($mysqli, $_POST['boardname']);
$boardnumber = mysqli_real_escape_string($mysqli, $_POST['boardnumber']);
//print_r($_POST);
$datetime = date("Y-m-d H:i:s");

$getdetails = $mysqli->query("select * from boards where boardname = '$boardname'");
$countdetails = mysqli_num_rows($getdetails);
if ($countdetails == '0') {
    $mysqli->query("INSERT INTO `boards`
            (`boardname`,
             `boardnumber`,
             `entrydate`,
             `status`)
VALUES ('$boardname',
        '$boardnumber',
        '$datetime',
        'Active')") or die(mysqli_error($mysqli));

    echo 1;

}
else {
    echo 2;
}



?>