<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "authorized") {
    header("Location: login.php?error=UNAUTHORIZED_ACCESS");
    exit();
}
?>