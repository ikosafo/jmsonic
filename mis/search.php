<?php
// Database configuration
$dbHost     = "localhost:3308";
$dbUsername = "root";
$dbPassword = "root";
$dbName     = "ahpc";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get search term
$searchTerm = $_GET['term'];

// Fetch matched data from the database
$query = $db->query("SELECT * FROM provisional WHERE first_name LIKE '%".$searchTerm."%' ORDER BY first_name ASC");

// Generate array with skills data
$skillData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['provisionalid'];
        $data['value'] = $row['first_name'];
        $data['cp'] = $row['surname'];
        array_push($skillData, $data);
    }
}

// Return results as json encoded array
echo json_encode($skillData);
?>