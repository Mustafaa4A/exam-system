<?php
session_start();
include "constants.php";



// Create connection
$conn = new mysqli(SERVER_NAME,USERNAME,PASSWORD,DATABASE);


// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
