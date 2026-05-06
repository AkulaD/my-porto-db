<?php
include('session_check.php');
include('db_config.php');

$action = $_REQUEST['action'] ?? '';

if ($action == 'create_work' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $role    = mysqli_real_escape_string($conn, $_POST['role']);
    $cp      = mysqli_real_escape_string($conn, $_POST['company_project']);
    $period_start  = mysqli_real_escape_string($conn, $_POST['period_start']);
    $period_end    = mysqli_real_escape_string($conn, $_POST['period_end']);
    $status  = mysqli_real_escape_string($conn, $_POST['status']);

    $start = strtoupper(date('M Y', strtotime($period_start)));
    $end   = strtoupper(date('M Y', strtotime($period_end)));
    $period = "$start - $end";

    $sql = "INSERT INTO work_logs (period, status, role, company_project) VALUES ('$period', '$status', '$role', '$cp')";
    mysqli_query($conn, $sql);
    header("Location: manage_work.php");
}

if ($action == 'add_detail' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $work_id = (int)$_POST['work_id'];
    $point   = mysqli_real_escape_string($conn, $_POST['point']);

    $sql = "INSERT INTO work_details (work_id, description_point) VALUES ($work_id, '$point')";
    mysqli_query($conn, $sql);
    header("Location: manage_work.php");
}

if ($action == 'delete_work' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM work_logs WHERE id = $id");
    header("Location: manage_work.php");
}

if ($action == 'delete_detail' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM work_details WHERE id = $id");
    header("Location: manage_work.php");
}