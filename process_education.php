<?php
include('session_check.php');
include('db_config.php');

$action = $_REQUEST['action'] ?? '';

// 1. Tambah Instansi Pendidikan
if ($action == 'create_edu' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $inst = mysqli_real_escape_string($conn, $_POST['institution']);
    $period = mysqli_real_escape_string($conn, $_POST['period']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);

    $sql = "INSERT INTO education (institution, period, major) VALUES ('$inst', '$period', '$major')";
    mysqli_query($conn, $sql);
    header("Location: manage_education.php");
}

// 2. Tambah Poin Deskripsi (List)
if ($action == 'add_detail' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $edu_id = (int)$_POST['education_id'];
    $point = mysqli_real_escape_string($conn, $_POST['point']);

    $sql = "INSERT INTO education_details (education_id, description_point) VALUES ($edu_id, '$point')";
    mysqli_query($conn, $sql);
    header("Location: manage_education.php");
}

// 3. Hapus Instansi
if ($action == 'delete_edu' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM education WHERE id = $id");
    header("Location: manage_education.php");
}

// 4. Hapus Poin Deskripsi
if ($action == 'delete_detail' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM education_details WHERE id = $id");
    header("Location: manage_education.php");
}

// 5. Update Instansi Pendidikan
if ($action == 'update_edu' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $inst = mysqli_real_escape_string($conn, $_POST['institution']);
    $period = mysqli_real_escape_string($conn, $_POST['period']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);

    $sql = "UPDATE education SET 
            institution = '$inst', 
            period = '$period', 
            major = '$major' 
            WHERE id = $id";
            
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_education.php?status=updated");
    } else {
        echo "DATABASE_ERROR: " . mysqli_error($conn);
    }
}