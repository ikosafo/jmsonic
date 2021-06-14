<?php
include('../../../config.php');

$surname = mysqli_real_escape_string($mysqli, $_POST['surname']);
$firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
$othername = mysqli_real_escape_string($mysqli, $_POST['othername']);
$email_address = mysqli_real_escape_string($mysqli, $_POST['email_address']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$institution = mysqli_real_escape_string($mysqli, $_POST['institution']);
$completion_year = mysqli_real_escape_string($mysqli, $_POST['completion_year']);
$reason = mysqli_real_escape_string($mysqli, $_POST['reason']);
$profession = mysqli_real_escape_string($mysqli, $_POST['profession']);

$getp = $mysqli->query("select * from professions WHERE professionname = '$profession'");
$getid = $getp->fetch_assoc();
$professionid = $getid['professionid'];

$getid = $mysqli->query("select * from permanent_special_cases ORDER BY id DESC LIMIT 1");
$resid = $getid->fetch_assoc();
$lastid = $resid['id'];
$randomid = $lastid + 1;
$random = "Pe" . rand(1, 1000) . $randomid . date('mdy');

$datetime = date("Y-m-d H:i:s");

$count = $mysqli->query("select * from permanent_special_cases where email_address = '$email_address'");
$res_count = mysqli_num_rows($count);


if ($res_count == "0") {
    $mysqli->query("INSERT INTO `permanent_special_cases`
            (`surname`,
             `firstname`,
             `othername`,
             `email_address`,
             `telephone`,
             `institution`,
             `completion_year`,
             `reason`,
             `random_code`,
             `profession`,
             `professionid`,
             `period`)
VALUES ('$surname',
        '$firstname',
        '$othername',
        '$email_address',
        '$telephone',
        '$institution',
        '$completion_year',
        '$reason',
        '$random',
        '$profession',
        '$professionid',
        '$datetime')") or die(mysqli_error($mysqli));

    $full_name = $surname . ' ' . $firstname . ' ' . $othername;
    $subject = 'AHPC Code Generation';

    $message = "Dear <span style='text-transform: uppercase'>$full_name</span>, <p>Thank you for registering with <b>Allied Health
Professions Council.</b>. The code to use for your permanent registration is <b>$random</b>. <br/>
Log in to the permanent registration portal with the code. </p>
<p>Thank you.</p>
";
    SendEmail::compose($email_address, $subject, $message);
    echo 1;

}

else {
    echo 2;
}


?>