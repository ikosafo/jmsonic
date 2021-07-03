<?php

include ('../../includes/db.php');
include ('../../includes/phpfunctions.php');

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and
(fullname LIKE '%" . $searchValue . "%'
OR telephone LIKE '%" . $searchValue . "%'
OR emailaddress LIKE '%" . $searchValue . "%'
OR location LIKE '%" . $searchValue . "%'
OR nextofkin LIKE '%" . $searchValue . "%'
OR nextofkintelephone LIKE '%" . $searchValue . "%'
OR country LIKE '%" . $searchValue . "%'
OR username LIKE '%" . $searchValue . "%'
OR introusername LIKE '%" . $searchValue . "%'
) ";
}

$status = $_GET['status'];
//$email_address = $_GET['email'];

if ($status == 'All') {

    ## Total number of records without filtering
    $sel = mysqli_query($con,"select count(*) as allcount from users");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

## Total number of record with filtering
    $sel = mysqli_query($con,"select count(*) as allcount from users where fullname IS NOT NULL AND 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

## Fetch records
    $empQuery = "select * from users where fullname IS NOT NULL AND 1 ".$searchQuery." order by userid DESC,fullname limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

}
else if ($status == 'Pending') {

    ## Total number of records without filtering
    $sel = mysqli_query($con,"select count(*) as allcount from users where userstatus = '1'");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

## Total number of record with filtering
    $sel = mysqli_query($con,"select count(*) as allcount from users where  userstatus = '1' AND fullname IS NOT NULL AND 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

## Fetch records
    $empQuery = "select * from users where userstatus = '1' AND fullname IS NOT NULL AND 1 ".$searchQuery." order by userid DESC,fullname limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

}


else {

    ## Total number of records without filtering
    $sel = mysqli_query($con,"select count(*) as allcount from users where userstatus = '5'");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

## Total number of record with filtering
    $sel = mysqli_query($con,"select count(*) as allcount from users where  userstatus = '5' AND fullname IS NOT NULL AND 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

## Fetch records
    $empQuery = "select * from users where userstatus = '5' AND fullname IS NOT NULL AND 1 ".$searchQuery." order by userid DESC,fullname limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();

}




while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "view"=>'',
        "fullname"=>$row['fullname'],
        "telephone"=>$row['telephone'],
        "emailaddress"=>$row['emailaddress'],
        "location"=>$row['location'],
        "country"=>$row['country'],
        "userstatus"=>getuserstatus($row['userstatus']),
        "nextofkin"=>$row['nextofkin'],
        "nextofkintelephone"=>$row['nextofkintelephone'],
        "introducer"=>$row['introusername'],
        "userrole"=>getuserrole($row['roleid']),
        "existing"=>getexisting($row['existing']),
        "userid"=>approvesignup($row['userid'],$row['userstatus'])
    );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecordwithFilter,
    "iTotalDisplayRecords" => $totalRecords,
    "aaData" => $data
);

echo json_encode($response);