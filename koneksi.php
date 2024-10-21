<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "db_todolist"; // Pastikan nama ini sesuai dengan nama database di phpMyAdmin

// Membuat koneksi
$db = mysqli_connect($hostname, $username, $password, $database_name);

// Mengecek apakah koneksi berhasil atau tidak
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>