<?php
include('../../../config.php');

$getnumber = $_POST['getnumber'];
$sql = "select * from `numberconfig` where `numberid`= '$getnumber'";

$res = $mysqli->query($sql);
if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option selected value='".$row->priority."'>".$row->priority."</option>";
    }
}

?>


