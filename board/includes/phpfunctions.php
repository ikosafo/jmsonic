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
function getintroducer($applicant_id) {
    include ('db.php');
    $q = mysqli_query($con,"select * from users where introid = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);
    $title = $result['title'];
    if ($title == "Other") {
        $title = $result['othertitle'];
        return $result["surname"] . " " . $result["first_name"] . " " . $result["other_name"]."(".$title.")";
    } else {
        return $result["surname"] . " " . $result["first_name"] . " " . $result["other_name"]."(".$title.")";
    }

}
