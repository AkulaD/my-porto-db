<?php
session_start();

/* ==========================================================================
1. DATABASE_CONNECTION
========================================================================== */
$host     = "localhost";
$user     = "root";
$password = "";
$database = "command_center";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("CONNECTION_FAILED: " . mysqli_connect_error());
}

/* ==========================================================================
2. AUTHENTICATION_LOGIC
========================================================================== */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql    = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['status']   = "authorized";

            header("Location: manage_identity.php");
            exit();
        } else {
            header("Location: login.php?error=INVALID_PASSWORD");
            exit();
        }
    } else {
        header("Location: login.php?error=USER_NOT_FOUND");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}