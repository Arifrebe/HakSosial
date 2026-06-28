<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "haksosial";

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    die(
        "Gagal terhubung ke MySQL: "
        . mysqli_connect_error()
    );
}

mysqli_set_charset($conn, "utf8mb4");
?>