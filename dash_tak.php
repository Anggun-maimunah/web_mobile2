<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kontakang';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $value = $_POST['value'];

    $sql = "INSERT INTO contacts (type, value) VALUES ('$type', '$value')";
    $conn->query($sql);
}

$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <a href="dashboard.php" class="kembali"><i class="fas fa-plus"></i> Kembali</a>
    <h1>Manage Contacts</h1>
    <form action="dash_tak.php" method="POST">
        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required>
        <br>
        <label for="value">Value:</label>
        <input type="text" id="value" name="value" required>
        <br>
        <button type="submit">Add Contact</button>
    </form>
    <h2>Existing Contacts</h2>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?php echo $row['type'] . ': ' . $row['value']; ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
