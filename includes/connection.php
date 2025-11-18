<?php 

// START SESSION
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connection DDBB
$server = "localhost";
$username = "root";
$password = "2025Temporal*";
$database = "bookmood";
$db = mysqli_connect($server, $username, $password, $database);

// VERIFY CONNECTION 
if (!$db) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// CONFIGURE COMPLETE CODIFICATION ON UTF-8 
mysqli_set_charset($db, "utf8mb4");


?>

