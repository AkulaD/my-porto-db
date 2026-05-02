<?php
include('session_check.php');
include('db_config.php');

$action = $_REQUEST['action'] ?? '';

if ($action == 'create' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['skill_name']);
    $val  = (int)$_POST['proficiency'];

    $sql = "INSERT INTO skills (skill_name, proficiency_percent) VALUES ('$name', $val)";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_skills.php?status=success");
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $sql = "DELETE FROM skills WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_skills.php?status=deleted");
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }
}