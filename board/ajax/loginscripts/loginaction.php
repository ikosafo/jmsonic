<?php
include("../../../config.php");

$username = $_POST['username'];
$pass = $_POST['password'];
$password = md5($pass);
$res = $mysqli->query("SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);
$today = date("Y-m-d H:i:s");

ob_start();
system('ipconfig /all');
$mycom=ob_get_contents();
ob_clean();
$findme = 'physique';
$pmac = strpos($mycom, $findme);
$mac_address = substr($mycom,($pmac+33),17);

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip_address=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip_address=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip_address=$_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;

}
$ip_add = getRealIpAddr();
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
         `status`)
    VALUES (
        '$userid',
        'Attempted Login',
        '$today',
        '$ip_add',
        '$mac_address',
        '$today',
        'Not successful')") or die(mysqli_error($mysqli));
        echo 2;

} else {

        $mysqli->query("INSERT INTO `logs`
        (
         `userid`,
         `activity`,
         `periodofactivity`,
         `ipaddress`,
         `macaddress`,
         `entrydate`,
         `status`)
    VALUES (
        '$userid',
        'Attempted Login',
        '$today',
        '$ip_add',
        '$mac_address',
        '$today',
        'Successful')") or die(mysqli_error($mysqli));

        $fullname = $getdetails['fullname'];
        $password = $getdetails['password'];
        $roleid = $getdetails['roleid'];

        $_SESSION['fullname'] = $fullname;
        $_SESSION['password'] = $password;
        $_SESSION['userid'] = $userid;
        $_SESSION['roleid'] = $roleid;
        $_SESSION['username'] = $username;

        if ($roleid == '1' || $roleid == '2') {
            echo 3;
        }
        else {
            echo 1;
        }




}
