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
$pin = mysqli_real_escape_string($mysqli, $_POST['pin']);
$profession = mysqli_real_escape_string($mysqli, $_POST['profession']);

$getp = $mysqli->query("select * from professions WHERE professionname = '$profession'");
$getid = $getp->fetch_assoc();
$professionid = $getid['professionid'];
$datetime = date("Y-m-d H:i:s");

$count = $mysqli->query("select * from renewal_special_cases 
where email_address = '$email_address'");
$res_count = mysqli_num_rows($count);


if ($res_count == "0") {
    $mysqli->query("INSERT INTO `renewal_special_cases`
            (`surname`,
             `firstname`,
             `othername`,
             `email_address`,
             `telephone`,
             `institution`,
             `completion_year`,
             `reason`,
             `pin`,
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
        '$pin',
        '$profession',
        '$professionid',
        '$datetime')") or die(mysqli_error($mysqli));

    $full_name = $surname . ' ' . $firstname . ' ' . $othername;

    /*
        $subject = 'AHPC Code Generation';

        $message = "Dear <span style='text-transform: uppercase'>$full_name</span>, <p>Thank you for registering with <b>Allied Health
    Professions Council.</b>. The code to use for your examination registration is <b>$random</b>. <br/>
    Log in to the examination registration portal with the code. </p>
    <p>Thank you.</p>
    ";

        SendEmail::compose($email_address, $subject, $message);*/

    echo 1;
}

else {
    echo 2;
}

?>