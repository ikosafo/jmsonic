<?php
include('../../../config.php');

$selectboard = mysqli_real_escape_string($mysqli, $_POST['selectboard']);
$selectcolour = mysqli_real_escape_string($mysqli, $_POST['selectcolour']);
//print_r($_POST);
$datetime = date("Y-m-d H:i:s");
$getdetails = $mysqli->query("select * from colourconfig where colourid = '$selectcolour'");
$resdetails = $getdetails->fetch_assoc();
$actualnumber = $resdetails['numberassign'];

$countnumber = mysqli_num_rows($mysqli->query("select * from previewboard where colourid = '$selectcolour' 
                                         AND boardid = '$selectboard'"));

if ($actualnumber == '1') {
    $selectmember = $_POST['selectmember'];
    
    $mysqli->query("INSERT INTO `previewboard`
    (`boardid`,
     `colourid`,
     `userid`,
     `status`)
VALUES 
('$selectboard',
'$selectcolour',
'$selectmember',
'4')") or die(mysqli_error($mysqli));

echo 1;
}

else {

    if ($countnumber < $actualnumber) {
        foreach ($_POST['selectmember'] as $selectmember)
        {
                $mysqli->query("INSERT INTO `previewboard`
                (`boardid`,
                 `colourid`,
                 `userid`,
                 `status`)
        VALUES 
            ('$selectboard',
            '$selectcolour',
            '$selectmember',
            '4')") or die(mysqli_error($mysqli));
          
        }
        echo 1;
     }
     else {
        echo 2;
     }
    
    
}
                                         







