<?php
// konfirmasi.php
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

$id = $_GET['id'];
$sql = "SELECT * FROM tb_pendaftaran WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
</head>
<body>
    <h2>Konfirmasi Data Pendaftaran</h2>
    <div id="confirmation_details">
        <p><strong>Nama Lengkap:</strong> <?php echo $row['nama']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>NIK:</strong> <?php echo $row['nik']; ?></p>
        <p><strong>Tanggal Lahir:</strong> <?php echo $row['tanggal_lahir']; ?></p>
        <p><strong>Jenis Kelamin:</strong> <?php echo $row['jenis_kelamin']; ?></p>
        <p><strong>Agama:</strong> <?php echo $row['agama']; ?></p>
        <p><strong>Nomor Handphone:</strong> <?php echo $row['nomor_handphone']; ?></p>
        <p><strong>Alamat Rumah:</strong> <?php echo $row['alamat_rumah']; ?></p>
        <p><strong>Umur:</strong> <?php echo $row['umur']; ?></p>
        <p><strong>Program Studi:</strong> <?php echo $row['program_studi']; ?></p>
    </div>
    <button id="download_pdf_button">Download PDF</button>
    
    <script>
        document.getElementById("download_pdf_button").onclick = function() {
            var confirmationDetails = document.getElementById("confirmation_details");
            html2canvas(confirmationDetails).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var pdf = new jsPDF();
                pdf.addImage(imgData, 'PNG', 10, 10);
                pdf.save('registration_confirmation.pdf');
            });
        };
    </script>
</body>
</html>
