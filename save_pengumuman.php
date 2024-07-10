<?php
// Mendapatkan data JSON yang dikirim dari fetch request
$data = json_decode(file_get_contents("php://input"), true);

// Simpan data tersebut ke dalam file atau database
// Misalnya, simpan ke dalam file JSON untuk sementara
file_put_contents('pengumuman_data.json', json_encode($data));

// Kirim respons kembali ke klien
echo json_encode(['status' => 'success', 'message' => 'Pengumuman berhasil disimpan']);
?>
