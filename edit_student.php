<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

$index = $data['index'];
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

$sql = "UPDATE tb_pendaftaran SET 
    nama='$nama', email='$email', nik='$nik', tanggalLahir='$tanggalLahir', 
    jenisKelamin='$jenisKelamin', agama='$agama', nomorHandphone='$nomorHandphone', 
    alamatRumah='$alamatRumah', umur='$umur', programStudi='$programStudi' 
    WHERE id=$index";

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
