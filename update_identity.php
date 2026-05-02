<?php
include('session_check.php');
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name     = mysqli_real_escape_string($conn, $_POST['full_name']);
    $title         = mysqli_real_escape_string($conn, $_POST['title']);
    $bio           = mysqli_real_escape_string($conn, $_POST['bio']);
    $location      = mysqli_real_escape_string($conn, $_POST['location']);
    $hardware_info = mysqli_real_escape_string($conn, $_POST['hardware_info']);
    $os_info       = mysqli_real_escape_string($conn, $_POST['os_info']);
    $kernel_info   = mysqli_real_escape_string($conn, $_POST['kernel_info']);

    // Menggunakan UPDATE karena kita hanya memiliki 1 baris data profile utama
    $sql = "UPDATE users SET 
            full_name = '$full_name', 
            title = '$title', 
            bio = '$bio', 
            location = '$location', 
            hardware_info = '$hardware_info', 
            os_info = '$os_info', 
            kernel_info = '$kernel_info' 
            WHERE id = 1";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_identity.php?status=success");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}