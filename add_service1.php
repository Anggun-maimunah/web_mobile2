<?php
include('db_connect.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $read_more_link = $_POST['read_more_link'];

    // Insert service into the database
    $query = "INSERT INTO services (name, description, icon_url, read_more_link) 
              VALUES ('$name', '$description', '$icon_url', '$read_more_link')";
    if (mysqli_query($conn, $query)) {
        header("Location: dashboard_service.php"); // Redirect to dashboard after adding
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
