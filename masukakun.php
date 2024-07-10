<?php
session_start();
header('Content-Type: application/json');

// Gantilah nilai-nilai di bawah ini sesuai dengan pengaturan Anda
$servername = "localhost";
$username = "root";
$password = "";
$database = "data_akun";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi gagal: ' . $conn->connect_error]);
    exit();
}

// Periksa apakah ada data yang dikirim dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Debugging: Periksa apakah nilai dari formulir diterima dengan benar
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Username dan password harus diisi.']);
        exit(); 
    }

    // Periksa apakah username terdaftar dan cocok dengan password yang diberikan
    $checkUsernameQuery = "SELECT username, password FROM tb_akun WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($checkUsernameQuery);
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Prepare statement error: ' . $conn->error]);
        exit();
    }
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    // Debugging: Periksa apakah username ditemukan di database
    if ($stmt->num_rows > 0) {
        $_SESSION['username'] = $username;
        setcookie("username", $username, time() + 300, "/"); // cookie expires in 5 minutes

        // Kirim respons JSON yang berisi success = true
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Username atau password salah.']);
    }

    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
