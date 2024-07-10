<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

$nama = $data['nama'];
$email = $data['email'];
$nik = $data['nik'];
$tanggalLahir = $data['tanggalLahir'];
$jenisKelamin = $data['jenisKelamin'];
$agama = $data['agama'];
$nomorHandphone = $data['nomorHandphone'];
$alamatRumah = $data['alamatRumah'];
$umur = $data['umur'];
$programStudi = $data['programStudi'];

$sql = "INSERT INTO tb_pendaftaran (nama, email, nik, tanggalLahir, jenisKelamin, agama, nomorHandphone, alamatRumah, umur, programStudi)
VALUES ('$nama', '$email', '$nik', '$tanggalLahir', '$jenisKelamin', '$agama', '$nomorHandphone', '$alamatRumah', '$umur', '$programStudi')";

$response = [];
if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

echo json_encode($response);

$conn->close();
?>
