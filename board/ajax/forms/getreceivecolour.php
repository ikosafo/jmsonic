<?php
include('../../../config.php');

$getboard = $_POST['getboard'];
$sql = "select * from `colourconfig` where `boardid`= '$getboard' AND status = 'Active' AND colourpriority = 'Highest'";

$res = $mysqli->query($sql);
if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option selected value='".$row->colourid."'>".$row->colourname."</option>";
    }
}

?>
