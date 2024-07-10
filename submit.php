<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_akun";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data yang dikirim dari JavaScript
$data = json_decode(file_get_contents('php://input'), true);

$nama = $data['nama'];
$email = $data['email'];
$nik = $data['nik'];
$tanggal_lahir = $data['tanggal_lahir'];
$jenis_kelamin = $data['jenis_kelamin'];
$agama = $data['agama'];
$nomor_handphone = $data['nomor_handphone'];
$alamat_rumah = $data['alamat_rumah'];
$umur = $data['umur'];
$program_studi = $data['program_studi'];

// SQL query to insert data into the tb_pendaftaran table
$sql = "INSERT INTO tb_pendaftaran (nama, email, nik, tanggal_lahir, jenis_kelamin, agama, nomor_handphone, alamat_rumah, umur, program_studi)
VALUES ('$nama', '$email', '$nik', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$nomor_handphone', '$alamat_rumah', '$umur', '$program_studi')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}

$conn->close();
?>