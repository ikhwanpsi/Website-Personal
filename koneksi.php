<?php

$servername = "localhost";
$username ="root";
$password = "";
$database = "data_akun";

$db = mysqli_connect($server, $username, $password, $database);
echo "Berhasil terkoneksi..... ";
if(!$db) {
    die("Gagal terhubung dengan database:" . mysqli_connect_error());
}
?>