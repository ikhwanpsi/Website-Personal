<?php
require 'config.php';

$index = $_GET['index'];

$sql = "SELECT * FROM tb_pendaftaran WHERE id=$index";
$result = $conn->query($sql);

$row = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

echo json_encode($row);

$conn->close();
?>
