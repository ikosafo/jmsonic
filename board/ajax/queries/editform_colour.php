<?php
include('../../../config.php');

$boardname = mysqli_real_escape_string($mysqli, $_POST['selectboard']);
$colourname = mysqli_real_escape_string($mysqli, $_POST['colourname']);
$selectcolour = mysqli_real_escape_string($mysqli, $_POST['selectcolour']);
$colournumber = mysqli_real_escape_string($mysqli, $_POST['colournumber']);
$colourid = mysqli_real_escape_string($mysqli, $_POST['colourid']);
$getboardid = $mysqli->query("select * from boards where boardname = '$boardname'");
$resboardid = $getboardid->fetch_assoc();
$selectboard = $resboardid['boardid'];

//print_r($_POST);
$datetime = date("Y-m-d H:i:s");

$getcolourdetails = $mysqli->query("select * from colourconfig where colourid = '$colourid'");
$rescolourdetails = $getcolourdetails->fetch_assoc();
$colournamedb = $rescolourdetails['colourname'];
$colourcodedb = $rescolourdetails['colourcode'];
$numberassign = $rescolourdetails['numberassign'];

if (($colournamedb == $colourname) && ($colourcodedb == $selectcolour)) {
    $getnumbervald = $mysqli->query("SELECT SUM(numberassign) AS sumcolour FROM colourconfig WHERE boardid = '$selectboard'");
    $ressum = $getnumbervald->fetch_assoc();
    $sumofcolour = $ressum['sumcolour'];
    $sumcolour = $sumofcolour - $numberassign;

    $gettotal = $mysqli->query("select * from boards where boardid = '$selectboard'");
    $restotal = $gettotal->fetch_assoc();
    $totalnumber = $restotal['boardnumber'];
    $expectednumber = $totalnumber - $sumcolour;

    if (($colournumber < $expectednumber) || ($colournumber == $expectednumber)) {
        $mysqli->query("UPDATE `colourconfig`
SET
  `numberassign` = '$colournumber'
WHERE `colourid` = '$colourid'") or die(mysqli_error($mysqli));

        echo 1;
    }
    else {
        echo 3;
    }
}
else if ($colournamedb == $colourname) {
    $getdetails = $mysqli->query("select * from colourconfig where colourcode = '$selectcolour' and boardid = '$selectboard'");
    $countdetails = mysqli_num_rows($getdetails);
    if ($countdetails == '0') {
        $getnumbervald = $mysqli->query("SELECT SUM(numberassign) AS sumcolour FROM colourconfig WHERE boardid = '$selectboard'");
        $ressum = $getnumbervald->fetch_assoc();
        $sumofcolour = $ressum['sumcolour'];
        $sumcolour = $sumofcolour - $numberassign;

        $gettotal = $mysqli->query("select * from boards where boardid = '$selectboard'");
        $restotal = $gettotal->fetch_assoc();
        $totalnumber = $restotal['boardnumber'];
        $expectednumber = $totalnumber - $sumcolour;

        if (($colournumber < $expectednumber) || ($colournumber == $expectednumber)) {
            $mysqli->query("UPDATE `colourconfig`
SET
  `numberassign` = '$colournumber',
  `colourcode` = '$selectcolour'

WHERE `colourid` = '$colourid'") or die(mysqli_error($mysqli));

            echo 1;
        }
        else {
            echo 3;
        }
    }
    else {
        echo 4;
    }
}
else if ($colourcodedb == $selectcolour) {
    $getdetails = $mysqli->query("select * from colourconfig where colourname = '$colourname' and boardid = '$selectboard'");
    $countdetails = mysqli_num_rows($getdetails);
    if ($countdetails == '0') {
        $getnumbervald = $mysqli->query("SELECT SUM(numberassign) AS sumcolour FROM colourconfig WHERE boardid = '$selectboard'");
        $ressum = $getnumbervald->fetch_assoc();
        $sumofcolour = $ressum['sumcolour'];
        $sumcolour = $sumofcolour - $numberassign;

        $gettotal = $mysqli->query("select * from boards where boardid = '$selectboard'");
        $restotal = $gettotal->fetch_assoc();
        $totalnumber = $restotal['boardnumber'];
        $expectednumber = $totalnumber - $sumcolour;

        if (($colournumber < $expectednumber) || ($colournumber == $expectednumber)) {
            $mysqli->query("UPDATE `colourconfig`
SET
  `numberassign` = '$colournumber',
  `colourname` = '$colourname'

WHERE `colourid` = '$colourid'") or die(mysqli_error($mysqli));

            echo 1;
        }
        else {
            echo 3;
        }
    }
    else {
        echo 4;
    }
}
else {
    $getnumbervald = $mysqli->query("SELECT SUM(numberassign) AS sumcolour FROM colourconfig WHERE boardid = '$selectboard'");
    $ressum = $getnumbervald->fetch_assoc();
    $sumofcolour = $ressum['sumcolour'];
    $sumcolour = $sumofcolour - $numberassign;

    $gettotal = $mysqli->query("select * from boards where boardid = '$selectboard'");
    $restotal = $gettotal->fetch_assoc();
    $totalnumber = $restotal['boardnumber'];
    $expectednumber = $totalnumber - $sumcolour;

    if (($colournumber < $expectednumber) || ($colournumber == $expectednumber)) {
        $mysqli->query("UPDATE `colourconfig`
SET
  `numberassign` = '$colournumber',
  `colourcode` = '$selectcolour',
  `colourname` = '$colourname'

WHERE `colourid` = '$colourid'") or die(mysqli_error($mysqli));

        echo 1;
    }
    else {
        echo 3;
    }
}


/*else  {
    $getdetails = $mysqli->query("select * from colourconfig where colourname = '$selectcolour' and boardid = '$selectboard'");
}*/

//$countdetails = mysqli_num_rows($getdetails);

/*if ($countdetails == '0') {


}
else {
    echo 2;
}*/



?>