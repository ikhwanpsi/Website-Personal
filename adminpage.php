<?php
// adminpage.php
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

// SQL query to select all columns from the tb_pendaftaran table
$sql = "SELECT nama, email, nik, tanggal_lahir, jenis_kelamin, agama, nomor_handphone, alamat_rumah, umur, program_studi FROM tb_pendaftaran";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nama"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["nik"] . "</td>
                <td>" . $row["tanggal_lahir"] . "</td>
                <td>" . $row["jenis_kelamin"] . "</td>
                <td>" . $row["agama"] . "</td>
                <td>" . $row["nomor_handphone"] . "</td>
                <td>" . $row["alamat_rumah"] . "</td>
                <td>" . $row["umur"] . "</td>
                <td>" . $row["program_studi"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='10'>No results found</td></tr>";
}

$conn->close();
?>
