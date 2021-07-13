<?php
include("../../../config.php");

$username = $_POST['username'];
$pass = $_POST['password'];
$password = md5($pass);
$res = $mysqli->query("SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);
$today = date("Y-m-d H:i:s");

$userid = $getdetails['userid'];

if ($rowcount == "0") {

        $mysqli->query("INSERT INTO `logs`
        (
         `userid`,
         `activity`,
         `periodofactivity`,
         `ipaddress`,
         `macaddress`,
         `entrydate`,
         `status`,
         `username`
         )
    VALUES (
        '$userid',
        'Attempted Login',
        '$today',
        '$ip_add',
        '$mac_address',
        '$today',
        'Not successful',
        '$username'
        )") or die(mysqli_error($mysqli));
        echo 2;

} else {

        $fullname = $getdetails['fullname'];
        $password = $getdetails['password'];
        $roleid = $getdetails['roleid'];

        $_SESSION['fullname'] = $fullname;
        $_SESSION['password'] = $password;
        $_SESSION['userid'] = $userid;
        $_SESSION['roleid'] = $roleid;
        $_SESSION['username'] = $username;

        if ($roleid == '1' || $roleid == '2') {
                $mysqli->query("INSERT INTO `logs`
               (`userid`,
                `activity`,
                `periodofactivity`,
                `ipaddress`,
                `macaddress`,
                `entrydate`,
                `status`,
                `username`
                )
            VALUES (
                '$userid',
                'Admin Attempted Login',
                '$today',
                '$ip_add',
                '$mac_address',
                '$today',
                'Successful',
                '$username'
                )") or die(mysqli_error($mysqli));
            echo 3;
        }
        else {

            
        $mysqli->query("INSERT INTO `logs`
        (
         `userid`,
         `activity`,
         `periodofactivity`,
         `ipaddress`,
         `macaddress`,
         `entrydate`,
         `status`,
         `username`
         )
    VALUES (
        '$userid',
        'User Attempted Login',
        '$today',
        '$ip_add',
        '$mac_address',
        '$today',
        'Successful',
        '$username'
        )") or die(mysqli_error($mysqli));

            echo 1;
        }




}
