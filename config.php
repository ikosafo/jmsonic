<?php
$mysqli= new mysqli('localhost:3308','root','root','jmsonic');
if($mysqli->connect_errno){
    echo"cannot connect MYSQLI error no{$mysqli->connect_errno}:{$mysqli->connect_errno}";
    exit();
}

session_start();


/* FUNCTION DEFINITIONS  */

//Function for IP address and MAC address
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


// Function for Lock encryptions
function lock($item){
    return base64_encode(base64_encode(base64_encode($item)));
}
function unlock($item){
    return base64_decode(base64_decode(base64_decode($item)));
}


// Function for time periods
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


////GETTING USER DETAILS////

//FullName
function getfullname ($userid) {
    global $mysqli;
    $getuserdetails = $mysqli->query("select * from users where userid = '$userid'");
    $resuserdetails = $getuserdetails->fetch_assoc();
    return $resuserdetails['fullname'];
}

//Email Address
function getemailaddress ($userid) {
    global $mysqli;
    $getuserdetails = $mysqli->query("select * from users where userid = '$userid'");
    $resuserdetails = $getuserdetails->fetch_assoc();
    return $resuserdetails['emailaddress'];
}

//Location
function getlocation ($userid) {
    global $mysqli;
    $getuserdetails = $mysqli->query("select * from users where userid = '$userid'");
    $resuserdetails = $getuserdetails->fetch_assoc();
    return $resuserdetails['location'];
}

//Username
function getusername ($userid) {
    global $mysqli;
    $getuserdetails = $mysqli->query("select * from users where userid = '$userid'");
    $resuserdetails = $getuserdetails->fetch_assoc();
    return $resuserdetails['username'];
}

//Get Introducer
function getintroducer ($userid) {
    global $mysqli;
    $getuserdetails = $mysqli->query("select * from users where userid = '$userid'");
    $resuserdetails = $getuserdetails->fetch_assoc();
    return $resuserdetails['introusername'];
}

//User Status
function getuserstatus ($userid) {
    global $mysqli;
    $getuserdetails = $mysqli->query("select * from users where userid = '$userid'");
    $resuserdetails = $getuserdetails->fetch_assoc(); 
    $status = $resuserdetails['userstatus'];
    if ($status == '1') {
        echo "<span class='label label-light-default label-inline 
        font-weight-bolder mr-1 ml-2'>Pending Approval</span>";
    }
    else if ($status == '2') {
        echo "<span class='label label-light-danger label-inline 
        font-weight-bolder mr-1 ml-2'>Removed</span>";
    }
    else if ($status == '3') {
        echo "<span class='label label-light-warning label-inline 
        font-weight-bolder mr-1 ml-2'>Suspended</span>";
    } 
    else if ($status == '4') {
        echo "<span class='label label-light-success label-inline 
        font-weight-bolder mr-1 ml-2'>Active</span>";
    }
    else if ($status == '5') {
        echo "<span class='label label-light-primary label-inline 
        font-weight-bolder mr-1 ml-2'>Approved</span>";
    }

}


//User Roles
function getuserroles ($userid) {
    global $mysqli;
    $getuserdetails = $mysqli->query("select * from users where userid = '$userid'");
    $resuserdetails = $getuserdetails->fetch_assoc(); 
    $roleid = $resuserdetails['roleid'];
    if ($roleid == '1') {
        echo "Administrator";
    }
    else if ($roleid == '2') {
        echo "Superadmin";
    }
    else if ($roleid == '3') {
        echo "Normal";
    }
    else if ($roleid == '4') {
        echo "General";
    }
    else {
        echo "Pending Approval";
    }

}

//Maximum Number for board
function getmaxboardnumber($boardid) {
    global $mysqli;
    $countboard = $mysqli->query("select * from boards where boardid = '$boardid'");
    $rescount = $countboard->fetch_assoc();
    return $rescount['boardnumber'];
} 

//Maximum Number for paid
function getmaxpaidnumber($boardid) {
    global $mysqli;
    $countboard = $mysqli->query("select * from colourconfig where boardid = '$boardid' and 
                                    colourpriority = 'Lowest'");
    $rescount = $countboard->fetch_assoc();
    return $rescount['numberassign'];
} 

//Maximum Number for paid
function getmaxpaidnumbersplit($boardid) {
    global $mysqli;
    $countboard = $mysqli->query("SELECT * FROM boards where `boardid` = '$boardid'");
    $rescount = $countboard->fetch_assoc();
    $mainboardid = $rescount['mainboardid'];
    $countboard = $mysqli->query("select * from colourconfig where boardid = '$mainboardid' and 
    colourpriority = 'Lowest'");
    $rescount = $countboard->fetch_assoc();
    return $rescount['numberassign'];
} 



//Exit fee amount
function getamtexit ($boardid) {
    global $mysqli;
    $countboard = $mysqli->query("select * from exitfee where boardid = '$boardid'");
    $rescount = $countboard->fetch_assoc();
    return $rescount['amounttopay'];
}


//Mainboard id
function getmainboardid ($boardid) {
    global $mysqli;
    $getmainid = $mysqli->query("SELECT * FROM boards where `boardid` = '$boardid'");
    $resmainid = $getmainid->fetch_assoc();
    $mainboardid = $resmainid['mainboardid'];
    if ($mainboardid == "") {
        $mainboardid = $boardid;
    }
    return $mainboardid;
   
}
                    