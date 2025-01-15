<?php
include('db_connect1.php'); // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $twitter_link = $_POST['twitter_link'];
    $facebook_link = $_POST['facebook_link'];
    $youtube_link = $_POST['youtube_link'];
    $linkedin_link = $_POST['linkedin_link'];

    $query = "UPDATE contact_info SET 
                address = '$address', 
                phone = '$phone', 
                email = '$email', 
                twitter_link = '$twitter_link', 
                facebook_link = '$facebook_link', 
                youtube_link = '$youtube_link', 
                linkedin_link = '$linkedin_link' 
              WHERE id = 1";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard_kontak.php?message=Contact info updated successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
