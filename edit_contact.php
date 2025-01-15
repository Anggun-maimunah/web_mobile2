<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ContactManagement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validasi parameter 'id'
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = (int) $_GET['id']; // Pastikan nilai ID adalah integer
$sql = "SELECT * FROM contacts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Periksa apakah data ditemukan
if (!$data) {
    die("Contact not found");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
</head>
<body>

    <h1>Edit Contact</h1>
    <form action="edit_contact.php" method="GET">
    <input type="hidden" name="id" value="1">
    <button type="submit">Edit</button>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $data['name']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" required><br><br>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" value="<?php echo $data['subject']; ?>" required><br><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required><?php echo $data['message']; ?></textarea><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
