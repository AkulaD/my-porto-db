<?php
include('session_check.php');
include('db_config.php');

$action = $_GET['action'] ?? '';

if ($action == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Hapus pesan berdasarkan ID
    $sql = "DELETE FROM messages WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_comments.php?status=purged");
    } else {
        echo "DATABASE_ERROR: " . mysqli_error($conn);
    }
} else {
    header("Location: manage_comments.php");
}