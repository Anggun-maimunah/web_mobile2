<?php
include('db_connect.php'); // Database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the service from the database
    $query = "DELETE FROM services WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: dashboard_service.php"); // Redirect to dashboard after deleting
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
