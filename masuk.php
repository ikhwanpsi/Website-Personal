<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    if ($username == 'admin') { // Sesuaikan validasi sesuai kebutuhan
        $_SESSION['username'] = $username;
        $expiryTime = 5 * 60; // 5 menit
        setcookie('username', $username, time() + $expiryTime, '/');
        setcookie('username_created', time(), time() + $expiryTime, '/');
        header('Location: home.php');
        exit();
    } else {
        echo 'Login gagal!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('loginForm').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent default form submission

                // Validate form before submission
                if (validateForm()) {
                    // Send data to server using fetch API
                    fetch('masukakun.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(new FormData(this)).toString(),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil masuk',
                                text: 'Anda akan diarahkan ke beranda.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'home.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal masuk',
                                text: data.message || 'Terjadi kesalahan saat masuk.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });

            function validateForm() {
                // Get values from inputs
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;

                // Check if all inputs are filled
                if (username === '' || password === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal masuk',
                        text: 'Semua kolom harus diisi.',
                        confirmButtonText: 'OK'
                    });
                    return false; // Stop form submission
                }

                // If all validation passes, return true to allow form submission
                return true;
            }
        });
    </script>
</head>
<body>
    <div style="width: 100%; height: 100%; position: relative; background: white">
        <img style="width: 1728px; height: 1117px; left: 0px; top: 0px; position: absolute" src="images/bg.png" />
        <div style="width: 552px; height: 70px; left: 294px; top: 401px; position: absolute; background: #D9D9D9; border-radius: 20px"></div>

        <div style="width: 270px; height: 65px; left: 300px; top: 356px; position: absolute; color: #D9D9D9; font-size: 30px; font-family: Inter; font-weight: 300; word-wrap: break-word">Username</div>
        <form id="loginForm" action="masukakun.php" method="POST">
            <input type="text" id="username" name="username" style="width: 535px; height: 65px; left: 290px; top: 400px; position: absolute; background: #D9D9D9; border-radius: 20px; padding: 10px; font-size: 20px;" placeholder="Enter your username">
            <input type="hidden" name="action" value="login">
            
            <div style="width: 270px; height: 65px; left: 300px; top: 540px; position: absolute; color: #D9D9D9; font-size: 30px; font-family: Inter; font-weight: 300; word-wrap: break-word">Password</div>
            <input type="password" id="password" name="password" style="width: 535px; height: 65px; left: 290px; top: 580px; position: absolute; background: #D9D9D9; border-radius: 20px; padding: 10px; font-size: 20px;" placeholder="Enter your password">
            <input type="hidden" name="action" value="login">
            
            <button type="submit" style="width: 352px; height: 66px; left: 900px; top: 450px; position: absolute; background: #0D293E; border-radius: 20px; color: white; font-size: 30px; font-family: Inter; font-weight: 300;">Masuk</button>
        </form>
    </div>

    <button onclick="window.location.href='belumpunyaakun.html'" style="width: 352px; height: 66px; left: 910px; top: 580px; position: absolute; background: #0D293E; border-radius: 20px; color: white; font-size: 20px; font-family: Inter; font-weight: 300;">Belum punya akun? Klik disini!</button>
    </div>

    <div style="left: 700px; top: 300px; position: absolute; color: white; font-size: 30px; font-family: Almarai; font-weight: 700; word-wrap: break-word">
        LOGIN
    </div>

     <!-- New Admin Button -->
     <button onclick="window.location.href = 'admin.html';" style="width: 200px; height: 50px; left: 980px; top: 400px; position: absolute; background: #1E1E1E; border-radius: 30px; color: white; font-size: 20px; font-family: Almarai; font-weight: 700;">
            Admin Page
        </button>
</body>
</html>
