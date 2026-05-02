<?php
include('session_check.php');
include('db_config.php');

$action = $_REQUEST['action'] ?? '';

if ($action == 'create' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = mysqli_real_escape_string($conn, $_POST['project_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $desc   = mysqli_real_escape_string($conn, $_POST['description']);
    $stack  = mysqli_real_escape_string($conn, $_POST['tech_stack']);
    $url    = mysqli_real_escape_string($conn, $_POST['url']);

    $sql = "INSERT INTO projects (project_name, status, description, tech_stack, url) 
            VALUES ('$name', '$status', '$desc', '$stack', '$url')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_projects.php?status=success");
    } else {
        echo "EXECUTION_ERROR: " . mysqli_error($conn);
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $sql = "DELETE FROM projects WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_projects.php?status=deleted");
    } else {
        echo "EXECUTION_ERROR: " . mysqli_error($conn);
    }
}