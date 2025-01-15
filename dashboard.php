<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit();
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "company");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data tim
$sql = "SELECT * FROM team";
$result = $conn->query($sql);

// Proses logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php'); // Redirect ke halaman login setelah logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnH1zQ+aZpPjRHG4aYB3CwRFDaS8RbA3+jtw5STY2RFG6FYpCF6FA78Gqk0Tgq3QFDFY62W4Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            color: #333;
            text-align: center;
        }
        .logout-btn {
            padding: 10px 15px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #b02a37;
        }
        .add-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .add-btn:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: left;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #f1f9ff;
        }
        .action-btn {
            padding: 8px 12px;
            margin: 2px;
            font-size: 12px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
        }
        .edit-btn {
            background-color: #007bff;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #b02a37;
        }
        img {
            border-radius: 50%;
            object-fit: cover;
        }
        td img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard Admin - Tim Manajemen</h1>
        </div>
        <a href="dash_tak.php" class="kontak"><i class="fas fa-plus"></i> Kontak</a>
        <a href="dashboard_service.php" class="service"><i class="fas fa-plus"></i> Layanan</a>
        <a href="add.php" class="add-btn"><i class="fas fa-plus"></i> Tambah Anggota</a>
        <a href="?logout=true" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['role']; ?></td>
                        <td><img src="<?= $row['photo']; ?>" alt="<?= $row['name']; ?>"></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id']; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                            <a href="delete.php?id=<?= $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada data tim.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>
