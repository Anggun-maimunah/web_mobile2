<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ContactManagement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "UPDATE contacts SET name = ?, email = ?, subject = ?, message = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $subject, $message, $id);

    if ($stmt->execute()) {
        echo "Contact updated successfully!";
        header("Location: dashboard_kontak.php"); // Redirect back to the dashboard
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
