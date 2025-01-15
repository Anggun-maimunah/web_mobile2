<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ContactManagement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Contact Messages</h1>
    <table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <a href="edit_contact.php?id=1">Edit Contact</a>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['subject']}</td>
                    <td>{$row['message']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='edit_contact.php?id={$row['id']}'>Edit</a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No messages found</td></tr>";
    }
    ?>
</table>
</body>
</html>
