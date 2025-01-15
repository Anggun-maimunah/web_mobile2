<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Manajemen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px 20px;
            text-align: center;
            background: #ffffff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            animation: fadeIn 1s ease-in-out;
        }

        /* Header Styles */
        .header {
            margin-bottom: 20px;
        }

        h1 {
            font-size: 36px;
            margin: 0;
            color: #4b0082;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;  /* Centering the title */
        }

        .back-button {
            text-decoration: none;
            color: #fff;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            margin-top: 30px; /* Add space above the back button */
        }

        .back-button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Team Grid */
        .team {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        /* Team Member Card */
        .team-member {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            width: 250px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-15px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .team-member img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 4px solid #6e8efb;
        }

        .team-member h2 {
            margin: 15px 0 5px;
            font-size: 22px;
            color: #333;
            font-weight: 600;
        }

        .team-member p {
            color: #777;
            font-size: 15px;
            margin-bottom: 10px;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header with Back Button -->
        <div class="header">
            <h1>Tim Manajemen</h1>
        </div>

        <!-- Team Members -->
        <div class="team">
            <?php
            // Koneksi ke database
            $conn = new mysqli("localhost", "root", "", "company");

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mengambil data tim
            $sql = "SELECT name, role, photo FROM team";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data setiap anggota tim
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="team-member">';
                    echo '<img src="' . $row["photo"] . '" alt="' . $row["name"] . '">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p>' . $row["role"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>Belum ada anggota tim.</p>";
            }

            $conn->close();
            ?>
        </div>

        
        <a href="index.php" class="back-button">← Kembali</a>

        <!-- Footer -->
        <div class="footer">
            <p>© Lintasarta | Semua Hak Dilindungi</p>
        </div>
    </div>
</body>
</html>
