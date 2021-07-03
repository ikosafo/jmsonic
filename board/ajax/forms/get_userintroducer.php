<?php
include('../../../config.php');

$introducerid = $_POST['introducerid'];
/*$sql = "select * from `users` where `introid`= '$introducerid'";
$res = $mysqli->query($sql);

if(mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_object($res)) {
        echo $row->fullname;
    }
}*/

$sql = $mysqli->query("select * from `excel` where `boardname`= '$introducerid'");
if(mysqli_num_rows($sql) > 0) {
    while ($row = $sql->fetch_assoc()) {
        echo $fullname = $row['fullname'];
    }

}

//echo $fullname;
?>
