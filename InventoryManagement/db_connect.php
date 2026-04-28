<?php
// DB connection info
$DB_HOST = "localhost";
$DB_USER = "webuser";
$DB_PASS = "password";
$DB_NAME = "assigndb";

// Connect to SQL
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

?>
