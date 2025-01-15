<?php
$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "company");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "DELETE FROM team WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
