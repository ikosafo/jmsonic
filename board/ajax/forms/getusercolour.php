<?php
include('../../../config.php');

$getboard = $_POST['getboard'];
$getmainid = $mysqli->query("SELECT * FROM boards where `boardid` = '$getboard'");
$resmainid = $getmainid->fetch_assoc();
$mainboardid = $resmainid['mainboardid'];
if ($mainboardid == "") {
    $mainboardid = $getboard;
}
$sql = "select * from `colourconfig` where `boardid`= '$mainboardid' AND status = 'Active' and colourpriority = 'Lowest'";

$res = $mysqli->query($sql);
if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option value='".$row->colourid."'>".$row->colourname."</option>";
    }
}

?>
