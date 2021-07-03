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
$introid = $_POST['introid'];
$pass = $_POST['password'];
$password = md5($pass);
$roleid = 5;
$entrydate = date('Y-m-d H:i:s');
$userstatus = 1;


//Check whether user exists in excel sheet
$getuser = $mysqli->query("SELECT * FROM `excel` WHERE 
                                 `boardname` = '$username' OR 
                                 `emailaddress` = '$email' OR
                                 `telephone` = '$phone'
                            ");
$countgetuser = mysqli_num_rows($getuser);


//Check whether user exists in user table
$chkdetails = $mysqli->query("SELECT * FROM users WHERE 
                                 `username` = '$username' OR 
                                 `emailaddress` = '$email' OR
                                 `telephone` = '$phone'
                                 ");
$countchkdetails = mysqli_num_rows($chkdetails);

//echo $countchkdetails;

if ($countgetuser == '0') {

    if ($countchkdetails == '0') {
        $mysqli->query("INSERT INTO `users`
        (`fullname`,
         `telephone`,
         `emailaddress`,
         `roleid`,
         `location`,
         `nextofkin`,
         `nextofkintelephone`,
         `acceptrules`,
         `entrydate`,
         `userstatus`,
         `country`,
         `username`,
         `introusername`,
         `password`)
    VALUES (
        '$fullname',
        '$phone',
        '$email',
        '$roleid',
        '$location',
        '$nextofkin',
        '$kintelephone',
        '$checkedValue',
        '$entrydate',
        '$userstatus',
        '$country',
        '$username',
        '$introid',
        '$password')") or die(mysqli_error($mysqli));
    
        echo 1;
    } else {
        echo 2;
    }
    
}

else {
    echo 3;
}

