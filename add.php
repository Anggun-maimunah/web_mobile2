<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $photo = $_FILES['photo'];

    // Cek apakah file yang di-upload adalah gambar
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
    $fileInfo = pathinfo($photo['name']);
    $fileExt = strtolower($fileInfo['extension']);
    $fileMimeType = mime_content_type($photo['tmp_name']);

    // Validasi ekstensi dan MIME type file
    if (in_array($fileExt, $allowedExts) && strpos($fileMimeType, 'image') !== false) {
        // Menghasilkan nama file unik berdasarkan timestamp
        $photoName = time() . "_" . $photo['name'];

        // Tentukan direktori tempat file di-upload (misalnya, 'uploads/')
        $uploadDir = 'uploads/';
        $uploadFilePath = $uploadDir . $photoName;

        // Pindahkan file yang di-upload ke direktori tujuan
        if (move_uploaded_file($photo['tmp_name'], $uploadFilePath)) {
            // Koneksi ke database
            $conn = new mysqli("localhost", "root", "", "company");

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Simpan data ke database
            $sql = "INSERT INTO team (name, role, photo) VALUES ('$name', '$role', '$photoName')";
            if ($conn->query($sql) === TRUE) {
                header("Location: dashboard.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Gagal meng-upload file gambar.";
        }
    } else {
        echo "Hanya file gambar yang diperbolehkan (jpg, jpeg, png, gif).";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
</head>
<body>
    <h1>Tambah Anggota Tim</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nama:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Jabatan:</label><br>
        <input type="text" name="role" required><br><br>
        <label>Foto:</label><br>
        <input type="file" name="photo" required><br><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
