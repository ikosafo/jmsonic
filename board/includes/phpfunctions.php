<?php

function lock($item){
    return base64_encode(base64_encode(base64_encode($item)));
}
function unlock($item){
    return base64_decode(base64_decode(base64_decode($item)));
}


// Date Period
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



//Get Introducer details
function getuserstatus($userid) {
    if ($userid == "5") {
        return '<span class="label label-lg font-weight-bold label-light-success label-inline">Approved</span>';
    }
    else if ($userid == "4") {
        return '<span class="label label-lg font-weight-bold label-light-primary label-inline">Active</span>';
    }
    else if ($userid == "3") {
        return '<span class="label label-lg font-weight-bold label-light-warning label-inline">Suspended</span>';
    }
    else if ($userid == "2") {
        return '<span class="label label-lg font-weight-bold label-light-danger label-inline">Removed</span>';
    }
    else {
        return '<span class="label label-lg font-weight-bold label-light-default label-inline">Pending</span>';
    }
}


//Get Introducer details
function getuserrole($roleid) {
    if ($roleid == "5") {
        return '<span>Pending Approval</span>';
    }
    else if ($roleid == "4") {
        return '<span>General</span>';
    }
    else if ($roleid == "3") {
        return '<span>Normal</span>';
    }
    else if ($roleid == "2") {
        return '<span>Superadmin</span>';
    }
    else {
        return '<span style="color: #00b300">Administrator</span>';
    }
}


//Get Existing users
function getexisting($existing) {
    if ($existing == "1") {
        return '<span>Existing User</span>';
    }
    else {
        return '<span>New User</span>';
    }
}


//Get Signup Details
function approvesignup($userid,$userstatus) {
    if ($userstatus == '1') {
        return '<a href="#" class="btn btn-sm btn-outline-success approvesignupbtn" i_index='.$userid.'>
    <i class="flaticon2-check-mark"></i>Approve</a>';
    }
    else {
        return '<span>Application already approved</span>';
    }


}


//Remove Admin
function removeadmin($userid) {
        return '<a href="#" class="btn btn-sm btn-outline-danger removeadminbtn" i_index='.$userid.'>
    <i class="flaticon2-cancel"></i>Remove Admin</a>';

}