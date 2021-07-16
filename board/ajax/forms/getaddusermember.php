<?php
include('../../../config.php');

$getboard = $_POST['getboard'];
$user_id = $_POST['user_id'];
$username = getusername($user_id);
$sql = "select * from `users` where (userstatus = '4' OR userstatus = '5') and introusername = '$username'";

$res = $mysqli->query($sql);
if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option value='".$row->userid."'>".$row->fullname." - ".$row->username."</option>";
    }
}

?>
