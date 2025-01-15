<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kontakang';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

$contacts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($contacts);

$conn->close();
?>
