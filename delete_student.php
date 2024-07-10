<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$index = $data['index'];

$sql = "DELETE FROM tb_pendaftaran WHERE id=$index";

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
