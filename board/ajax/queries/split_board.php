<?php
include('../../../config.php');

$i_index = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$userid = $_SESSION['userid'];
$username = getusername($userid);
$datetime = date("Y-m-d H:i:s");

//Get the two boards
$getfirstboard = $mysqli->query("select * from boards where parentboardid = '$i_index' LIMIT 1");
$resfirstboard = $getfirstboard->fetch_assoc();
$firstboard = $resfirstboard['boardname'];
$firstboardid = $resfirstboard['boardid'];
$mainboardid = $resfirstboard['mainboardid'];
$parentboardid = $resfirstboard['parentboardid'];

$getsecondboard = $mysqli->query("select * from boards where parentboardid = '$i_index' LIMIT 1,2");
$ressecondboard = $getsecondboard->fetch_assoc();
$secondboard = $ressecondboard['boardname'];
$secondboardid = $ressecondboard['boardid'];


//Get the colour with the lowest priority
$lowestpriority = $mysqli->query("select * from colourconfig where colourpriority = 'Lowest' and 
                                boardid = '$i_index'");
$resnumlowest = $lowestpriority->fetch_assoc();
$colourid = $resnumlowest['colourid'];
$numberassignlowest = $resnumlowest['numberassign']; 
$lowestsep = $numberassignlowest/2;


//Insert first set of lowest
$getlowestcolour = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Lowest' and p.boardid = '$i_index' LIMIT $lowestsep");
while ($reslowestcolour = $getlowestcolour->fetch_assoc()) {
    $userid = $reslowestcolour['userid'];
    $mysqli->query("INSERT INTO `previewboard`
                    (`boardid`,
                     `colourid`,
                     `userid`,
                     `status`,
                     `mainboardid`,
                     `parboardid`
                     )
            VALUES 
                ('$firstboardid',
                '$colourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   


//Insert second set of lowest
$getlowestcolour2 = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Lowest' and p.boardid = '$i_index' LIMIT $lowestsep,$numberassignlowest");
while ($reslowestcolour2 = $getlowestcolour2->fetch_assoc()) {
    $userid = $reslowestcolour2['userid'];
    $mysqli->query("INSERT INTO `previewboard`
                    (`boardid`,
                     `colourid`,
                     `userid`,
                     `status`,
                     `mainboardid`,
                     `parboardid`
                     )
            VALUES 
                ('$secondboardid',
                '$colourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   


//Get the colour with the low priority
$lowpriority = $mysqli->query("select * from colourconfig where colourpriority = 'Low' and 
                                boardid = '$i_index'");
$resnumlow = $lowpriority->fetch_assoc();
$colourid = $resnumlow['colourid'];
$numberassignlow = $resnumlow['numberassign']; 
$lowsep = $numberassignlow/2;


//Insert first set of low
$getlowcolour = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Low' and p.boardid = '$i_index' LIMIT $lowsep");
while ($reslowcolour = $getlowcolour->fetch_assoc()) {
    $userid = $reslowcolour['userid'];
    $mysqli->query("INSERT INTO `previewboard`
                    (`boardid`,
                     `colourid`,
                     `userid`,
                     `status`,
                     `mainboardid`,
                     `parboardid`
                     )
            VALUES 
                ('$firstboardid',
                '$colourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   


//Insert second set of low
$getlowcolour2 = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Low' and p.boardid = '$i_index' LIMIT $lowsep,$numberassignlow");
while ($reslowcolour2 = $getlowcolour2->fetch_assoc()) {
    $userid = $reslowcolour2['userid'];
    $mysqli->query("INSERT INTO `previewboard`
                    (`boardid`,
                     `colourid`,
                     `userid`,
                     `status`,
                     `mainboardid`,
                     `parboardid`
                     )
            VALUES 
                ('$secondboardid',
                '$colourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   

