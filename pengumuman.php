<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'database');

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Fetch the accepted students
$sql = "SELECT nama, email, nik, tanggal_lahir, jenis_kelamin, agama, nomor_handphone, alamat_rumah, umur, program_studi FROM accepted_students";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array_values($row);
    }
}

$conn->close();

echo json_encode($data);
?>
