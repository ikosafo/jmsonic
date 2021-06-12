<?php
include("../../../config.php");

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$nextofkin = $_POST['nextofkin'];
$kintelephone = $_POST['kintelephone'];
$location = $_POST['location'];
$country = $_POST['country'];
$username = $_POST['username'];
$checkedValue = $_POST['checkedValue'];
$pass = $_POST['password'];
$password = md5($pass);
$roleid = 5;
$introducerid = '';
$entrydate = date('Y-m-d H:i:s');
$userstatus = 1;


$chkdetails = $mysqli->query("SELECT * FROM users WHERE 
                                 `username` = '$username' OR 
                                 `emailaddress` = '$email' OR
                                 `telephone` = '$phone'
                                 ");
$countchkdetails = mysqli_num_rows($chkdetails);

//echo $countchkdetails;

if ($countchkdetails == '0') {
    $mysqli->query("INSERT INTO `users`
    (`fullname`,
     `telephone`,
     `emailaddress`,
     `roleid`,
     `location`,
     `nextofkin`,
     `nextofkintelephone`,
     `introducerid`,
     `acceptrules`,
     `entrydate`,
     `userstatus`,
     `country`,
     `username`,
     `password`)
VALUES (
    '$fullname',
    '$phone',
    '$email',
    '$roleid',
    '$location',
    '$nextofkin',
    '$kintelephone',
    '$introducerid',
    '$checkedValue',
    '$entrydate',
    '$userstatus',
    '$country',
    '$username',
    '$password')") or die(mysqli_error($mysqli));

echo 1;
}
else {
echo 2;
}

