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
(CONCAT(first_name, ' ',last_name) LIKE '%" . $searchValue . "%'
OR CONCAT(last_name, ' ',first_name) LIKE '%" . $searchValue . "%'
OR last_name LIKE '%" . $searchValue . "%'
OR first_name LIKE '%" . $searchValue . "%'
OR email_address LIKE '%" . $searchValue . "%' ) ";
}

//$year = $_GET['year'];
//$email_address = $_GET['email'];


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




while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "fullname"=>$row['fullname'],
        "telephone"=>$row['telephone'],
        "emailaddress"=>$row['emailaddress'],
        "location"=>$row['location'],
        "country"=>$row['country'],
        "nextofkin"=>$row['nextofkin'],
        "nextofkintelephone"=>$row['nextofkintelephone'],
        "introducer"=>getintroducer($row['nextofkintelephone']),
        //"period"=>$row['period'].'<br/> ('.time_elapsed_string($row['period']).')',
        //"email_verified"=>email_verified($row['email_verified']),
       // "email_verified_period"=>email_verified_period($row['email_verified_period'])
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