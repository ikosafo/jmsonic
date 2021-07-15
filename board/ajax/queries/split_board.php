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
$lowestpriority = $mysqli->query("select * from colourconfig where colourpriority = 'Lowest' 
                                and status = 'Active' and
                                boardid = '$i_index'");
$resnumlowest = $lowestpriority->fetch_assoc();
$numberassignlowest = $resnumlowest['numberassign']; 
$lowestsep = $numberassignlowest/2;
//Getcolourid for low priority
$getlowcolourid = $mysqli->query("select * from colourconfig where colourpriority = 'Low' 
                                and status = 'Active'
                                and boardid = '$i_index'");
$reslowcolourid = $getlowcolourid->fetch_assoc();
$lowcolourid = $reslowcolourid['colourid'];

//Insert first set of lowest
$getlowestcolour = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Lowest' 
                                 and c.status = 'Active'
                                 and p.boardid = '$i_index' LIMIT $lowestsep");
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
                                        '$lowcolourid',
                                        '$userid',
                                        '4',
                                        '$mainboardid',
                                        '$parentboardid'
                                        )") or die(mysqli_error($mysqli));

                                }   


//Insert second set of lowest
$getlowestcolour2 = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Lowest' 
                                 and c.status = 'Active'
                                 and p.boardid = '$i_index' LIMIT $lowestsep,$numberassignlowest");
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
                                                '$lowcolourid',
                                                '$userid',
                                                '4',
                                                '$mainboardid',
                                                '$parentboardid'
                                                )") or die(mysqli_error($mysqli));
}   


//Get the colour with the low priority
$lowpriority = $mysqli->query("select * from colourconfig where colourpriority = 'Low'
                                and status = 'Active' 
                                and boardid = '$i_index' and status = 'Active'");
$resnumlow = $lowpriority->fetch_assoc();
$numberassignlow = $resnumlow['numberassign']; 
$lowsep = $numberassignlow/2;
//Getcolourid for high priority
$gethighcolourid = $mysqli->query("select * from colourconfig where colourpriority = 'High' and 
                                boardid = '$i_index'");
$reshighcolourid = $gethighcolourid->fetch_assoc();
$highcolourid = $reshighcolourid['colourid'];


//Insert first set of low
$getlowcolour = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Low' and c.status = 'Active' 
                                 and p.boardid = '$i_index' LIMIT $lowsep");
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
                '$highcolourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   


//Insert second set of low
$getlowcolour2 = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'Low' 
                                 and c.status = 'Active'
                                 and p.boardid = '$i_index' LIMIT $lowsep,$numberassignlow");
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
                '$highcolourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   



//Get the colour with the high priority
$highpriority = $mysqli->query("select * from colourconfig where colourpriority = 'High'
                                and status = 'Active' 
                                and boardid = '$i_index'");
$resnumhigh = $highpriority->fetch_assoc();
$numberassignhigh = $resnumhigh['numberassign']; 
$highsep = $numberassignhigh/2;
//Getcolourid for highest priority
$gethighestcolourid = $mysqli->query("select * from colourconfig where colourpriority = 'Highest' and 
                                boardid = '$i_index' and status = 'Active'");
$reshighestcolourid = $gethighestcolourid->fetch_assoc();
$highestcolourid = $reshighestcolourid['colourid'];


//Insert first set of high
$gethighcolour = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'High' and c.status = 'Active' and p.boardid = '$i_index' LIMIT $highsep");
while ($reshighcolour = $gethighcolour->fetch_assoc()) {
    $userid = $reshighcolour['userid'];
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
                '$highestcolourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   


//Insert second set of high
$gethighcolour2 = $mysqli->query("select * from previewboard p JOIN colourconfig c ON p.colourid = c.colourid 
                                 where c.colourpriority = 'High' and c.status = 'Active' and p.status != '2' and p.boardid = '$i_index' LIMIT $highsep,$numberassignhigh");
while ($reshighcolour2 = $gethighcolour2->fetch_assoc()) {
    $userid = $reshighcolour2['userid'];
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
                '$highestcolourid',
                '$userid',
                '4',
                '$mainboardid',
                '$parentboardid'
                )") or die(mysqli_error($mysqli));
}   

            $mysqli->query("UPDATE `boards` SET split = '1' 
            WHERE boardid = '$i_index'") or die(mysqli_error($mysqli));

echo 1;