<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ang"; // Change to your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
