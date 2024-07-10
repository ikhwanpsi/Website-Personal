<?php
// Ambil data yang dikirim dari frontend
$data = json_decode(file_get_contents("php://input"), true);

// Validasi data yang diterima
if (empty($data['nama']) || empty($data['email']) || empty($data['nik']) || empty($data['tanggal_lahir']) || empty($data['jenis_kelamin']) || empty($data['agama']) || empty($data['nomor_handphone']) || empty($data['alamat_rumah']) || empty($data['umur']) || empty($data['program_studi'])) {
    http_response_code(400);
    echo json_encode(array('message' => 'Gagal menambahkan data. Mohon lengkapi semua field.'));
    exit;
}

// Koneksi ke database menggunakan PDO
$host = 'localhost';
$dbname = 'data_akun';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk insert data ke tabel data_akun
    $sql = "INSERT INTO tb_pendaftaran (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
    $stmt = $pdo->prepare($sql);

    // Bind parameter
    $stmt->bindParam(':firstname', $data['firstname']);
    $stmt->bindParam(':lastname', $data['lastname']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':password', $data['password']);

    // Eksekusi statement
    $stmt->execute();

    // Kirim response ke frontend
    http_response_code(200);
    echo json_encode(array('message' => 'Data berhasil ditambahkan.'));
} catch (PDOException $e) {
    // Tangani kesalahan jika terjadi
    http_response_code(500);
    echo json_encode(array('message' => 'Gagal menambahkan data. Error: ' . $e->getMessage()));
}
?>