<?php
include('session_check.php');
include('db_config.php');

$action = $_REQUEST['action'] ?? '';

if ($action == 'create' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $platform = mysqli_real_escape_string($conn, $_POST['platform_name']);
    $display  = mysqli_real_escape_string($conn, $_POST['display_value']);
    $url      = mysqli_real_escape_string($conn, $_POST['url']);

    $sql = "INSERT INTO social_protocols (platform_name, url, display_value) 
            VALUES ('$platform', '$url', '$display')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_social.php?status=active");
    } else {
        echo "PROTOCOL_ERROR: " . mysqli_error($conn);
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $sql = "DELETE FROM social_protocols WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_social.php?status=terminated");
    } else {
        echo "PROTOCOL_ERROR: " . mysqli_error($conn);
    }
}