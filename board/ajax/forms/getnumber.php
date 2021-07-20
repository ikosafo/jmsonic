<?php
include('../../../config.php');

$getboard = $_POST['getboard'];
$getmaxnum = $mysqli->query("select * from `boards` where `boardid`= '$getboard'");
$resmaxnum = $getmaxnum->fetch_assoc();
$maxnumber = $resmaxnum['boardnumber'];

$sql = "select * from `numberconfig` where `maxnumber`= '$maxnumber'";

$res = $mysqli->query($sql);
if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option value='".$row->numberid."'>".$row->subnumber."</option>";
    }
}

?>
