<?php
include('session_check.php');
include('db_config.php');

$action = $_REQUEST['action'] ?? '';

if ($action == 'create' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $date = mysqli_real_escape_string($conn, $_POST['cert_date']);
    $name = mysqli_real_escape_string($conn, $_POST['cert_name']);
    $url = mysqli_real_escape_string($conn, $_POST['link_cert']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO certificates (cert_date, cert_name, issuer, link_cert) VALUES ('$date', '$name', '$desc', '$url')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_certificates.php?status=success");
    } else {
        echo "DATABASE_ERROR: " . mysqli_error($conn);
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $sql = "DELETE FROM certificates WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_certificates.php?status=deleted");
    } else {
        echo "DATABASE_ERROR: " . mysqli_error($conn);
    }
}