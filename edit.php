<?php
$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "company");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM team WHERE id = $id";
$result = $conn->query($sql);
$team = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $photoName = $team['photo'];

    if ($_FILES['photo']['name']) {
        $photo = $_FILES['photo'];
        $photoName = time() . "_" . $photo['name'];
        move_uploaded_file($photo['tmp_name'], "" . $photoName);
    }

    $sql = "UPDATE team SET name='$name', role='$role', photo='$photoName' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
</head>
<body>
    <h1>Edit Anggota Tim</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nama:</label><br>
        <input type="text" name="name" value="<?= $team['name']; ?>" required><br><br>
        <label>Jabatan:</label><br>
        <input type="text" name="role" value="<?= $team['role']; ?>" required><br><br>
        <label>Foto:</label><br>
        <input type="file" name="photo"><br>
        <small>Foto saat ini: <?= $team['photo']; ?></small><br><br>
        <button type="submit">Update</button>
    </form>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
