<?php
include('../../../config.php');

$boardname = $_POST['boardname'];

$sql = $mysqli->query("select * from `excel` where `boardname`= '$boardname'");
if(mysqli_num_rows($sql) > 0) {
    while ($row = $sql->fetch_assoc()) {
       echo $phone = $row['telephone'];
    }

}

?>
