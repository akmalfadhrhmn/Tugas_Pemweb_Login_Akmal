<?php

$host = "localhost";
$user ="root";
$password ="";
$db = "kuis_pemweb";

$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 
// mysqli_close($conn);
?>
