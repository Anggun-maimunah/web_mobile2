<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'admin_dashboard';
$username = 'root'; // Ganti sesuai dengan username database Anda
$password = '';     // Ganti sesuai dengan password database Anda

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Query untuk validasi login
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $inputUsername);
    $stmt->bindParam(':password', $inputPassword);
    $stmt->execute();

    // Cek apakah user ditemukan
    if ($stmt->rowCount() > 0) {
        session_start();
        $_SESSION['username'] = $inputUsername;
        header('Location: dashboard.php'); // Redirect ke dashboard setelah login
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #ffffff;
            color: #333;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
        }
        .login-container input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }
        .login-container input:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .login-container button:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: scale(1.05);
        }
        .error {
            color: red;
            font-size: 14px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login Admin</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
