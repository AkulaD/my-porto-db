<?php 
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

?>