<?php
include('../../../config.php');

$selectboard = mysqli_real_escape_string($mysqli, $_POST['selectboard']);
$selectcolour = mysqli_real_escape_string($mysqli, $_POST['selectcolour']);
$countmember = mysqli_real_escape_string($mysqli, $_POST['countmember']);
$userid = $_SESSION['userid'];
$username = getusername($userid);

$datetime = date("Y-m-d H:i:s");
$getdetails = $mysqli->query("select * from colourconfig where colourid = '$selectcolour'");
$resdetails = $getdetails->fetch_assoc();
$actualnumber = $resdetails['numberassign'];

$countnumber = mysqli_num_rows($mysqli->query("select * from previewboard where colourid = '$selectcolour' 
                                         AND boardid = '$selectboard' AND status = '4'"));


//Check if number of members exceeds expectec
    if ($countnumber < $actualnumber) {

        //If one member is expected
        if ($actualnumber == '1') {

            //If only member was selected
            if ($countmember == '1') {
               
                foreach ($_POST['selectmember'] as $selectmember)
            {
                $introusername = getintroducer($selectmember);
                    $mysqli->query("INSERT INTO `previewboard`
                    (`boardid`,
                     `colourid`,
                     `userid`,
                     `status`,
                     `mainboardid`,
                     `introusername`
                     )
            VALUES 
                ('$selectboard',
                '$selectcolour',
                '$selectmember',
                '4',
                '$selectboard',
                '$introusername'
                )") or die(mysqli_error($mysqli));
            }

            $mysqli->query("INSERT INTO `logs`
            (
            `activity`,
            `periodofactivity`,
            `ipaddress`,
            `macaddress`,
            `entrydate`,
            `status`,
            `username`
            )
            VALUES (
            'User added',
            '$datetime',
            '$ip_add',
            '$mac_address',
            '$datetime',
            'Successful',
            '$username'
            )") or die(mysqli_error($mysqli));
            
            echo 3;
            }
            else {
                echo 2;
            }
        }

        //If multiple is expected
        else {
            foreach ($_POST['selectmember'] as $selectmember)
            {
                $introusername = getintroducer($selectmember);
                    $mysqli->query("INSERT INTO `previewboard`
                    (`boardid`,
                     `colourid`,
                     `userid`,
                     `status`,
                     `mainboardid`,
                     `introusername`
                     )
            VALUES 
                ('$selectboard',
                '$selectcolour',
                '$selectmember',
                '4',
                '$selectboard',
                '$introusername'
                )") or die(mysqli_error($mysqli));
            }

            $mysqli->query("INSERT INTO `logs`
            (
            `activity`,
            `periodofactivity`,
            `ipaddress`,
            `macaddress`,
            `entrydate`,
            `status`,
            `username`
            )
            VALUES (
            'Users added',
            '$datetime',
            '$ip_add',
            '$mac_address',
            '$datetime',
            'Successful',
            '$username'
            )") or die(mysqli_error($mysqli));
            echo 1;
        }
       
     }
     else {
        echo 2;
     }
    
    
                                         







