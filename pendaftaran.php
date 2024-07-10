<?php
// pendaftaran.php
$servername = "localhost";
$username = "root"; // Ganti dengan 'root' atau nama pengguna yang sesuai
$password = ""; // Ganti dengan kata sandi yang sesuai, jika ada
$dbname = "data_akun"; // Ganti dengan nama database yang sesuai

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nik = $_POST['nik'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $nomor_handphone = $_POST['nomor_handphone'];
    $alamat_rumah = $_POST['alamat_rumah'];
    $umur = $_POST['umur'];
    $program_studi = $_POST['program_studi'];

    $sql = "INSERT INTO tb_pendaftaran (nama, email, nik, tanggal_lahir, jenis_kelamin, agama, nomor_handphone, alamat_rumah, umur, program_studi)
            VALUES ('$nama', '$email', '$nik', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$nomor_handphone', '$alamat_rumah', '$umur', '$program_studi')";

    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
