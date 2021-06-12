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



/* $res = $mysqli->query("SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password'");
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

$full_name = $getdetails['full_name'];
$password = $getdetails['password'];
$user_id = $getdetails['user_id'];
$user_type = $getdetails['approval'];




if ($rowcount == "0") {


    $mysqli->query("INSERT INTO `logs_mis`
            (`message`,
             `logdate`,
             `username`,
             `mac_address`,
             `ip_address`,
             `action`)
VALUES ('Log In Error (Wrong Username or Password)',
        '$today',
        '$username',
        '$mac_address',
        '$ip_add',
        'Failed')") or die(mysqli_error($mysqli));

    echo 2;

} else {

    $mysqli->query("INSERT INTO `logs_mis`
            (`message`,
             `logdate`,
             `username`,
             `mac_address`,
             `ip_address`,
             `action`)
VALUES ('Logged in Successfully',
        '$today',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));

    $_SESSION['full_name'] = $full_name;
    $_SESSION['password'] = $password;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['username'] = $username;

    echo 1;


}

 */
?>