<?php
session_start();

// Mengatur waktu kedaluwarsa dalam detik (5 menit)
$expiryTime = 5 * 60;

// Periksa apakah session atau cookie ada dan belum kedaluwarsa
if (isset($_SESSION['username']) || (isset($_COOKIE['username']) && (time() - $_COOKIE['username_created']) < $expiryTime)) {
    // Perbarui cookie
    if (isset($_COOKIE['username'])) {
        setcookie('username', $_COOKIE['username'], time() + $expiryTime, '/');
        setcookie('username_created', time(), time() + $expiryTime, '/');
    }
} else {
    // Hapus session dan cookie
    session_unset();
    session_destroy();
    setcookie('username', '', time() - 3600, '/');
    setcookie('username_created', '', time() - 3600, '/');
    header('Location: masuk.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
    </style>
    <script>
        // Fungsi untuk mendapatkan nilai cookie berdasarkan nama
        function getCookie(name) {
            let cookieArr = document.cookie.split(";");
            for (let i = 0; i < cookieArr.length; i++) {
                let cookiePair = cookieArr[i].split("=");
                if (name == cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }

        // Fungsi untuk memeriksa waktu kedaluwarsa cookie
        function checkCookieExpiry() {
            let username = getCookie('username');
            let created = getCookie('username_created');
            let expiryTime = 5 * 60 * 1000; // 5 menit dalam milidetik

            if (username && created) {
                let currentTime = new Date().getTime();
                let cookieCreatedTime = parseInt(created);

                if ((currentTime - cookieCreatedTime) >= expiryTime) {
                    alert('Sesi Anda telah kedaluwarsa. Anda akan diarahkan ke halaman login.');
                    window.location.href = 'masuk.php';
                }
            } else {
                window.location.href = 'masuk.php';
            }
        }

        // Periksa waktu kedaluwarsa cookie setiap 1 menit
        setInterval(checkCookieExpiry, 60 * 1000);
    </script>
</head>
<body>
    <h1>Kontak Page</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? $_COOKIE['username']); ?>!</p>
    <a href="home.php">Home</a> | <a href="logout.php">Logout</a>
</body>
</html>
