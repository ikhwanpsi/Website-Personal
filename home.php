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
    <title>Login Page</title>
    <style>
        /* Set html and body to take up full height and width */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
            background: white;
        }

        /* Set the main container to take up the full viewport */
        .main-container {
            width: 100%;
            height: 100%;
            position: relative;
        }

        /* Centered content */
        .centered-content {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: white;
            font-size: 40px;
            font-family: DM Sans;
            font-weight: 400;
            word-wrap: break-word;
        }

        /* Navbar styles */
        .navbar {
            width: 100%;
            height: 130px;
            position: absolute;
            top: 0;
            background: #0D293E;
            opacity: 0.60;
        }

        .navbar img {
            position: absolute;
            width: 162px;
            height: 130px;
            left: 0;
        }

        .navbar div, .navbar button {
            position: absolute;
            color: white;
            font-family: Almarai;
            font-weight: 700;
        }

        .navbar div {
            font-size: 40px;
        }

        .navbar button {
            background: #1E1E1E;
            border-radius: 30px;
        }

        /* Dropdown styles */
        .dropdown-container {
            position: absolute;
            top: 100px;
        }

        .dropdown-container select {
            font-family: Almarai;
            font-size: 20px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <img src="images/bg.png" style="width: 100%; height: 100%; position: absolute; object-fit: cover;" />
        
        <div class="navbar">
            <img src="images/logo.png" />
            <div style="left: 397px; top: 24px;">UNIVERSITAS</div>
            <div style="left: 686px; top: 24px;">LARI</div>
            <div style="left: 397px; top: 68px;">INDONESIA</div>
            <button onclick="window.location.href = 'pdtr.html';" style="width: 200px; height: 60px; left: 1267px; top: 20px;"></button>
            <div style="left: 1289px; top: 33px; font-size: 30px;">Pendaftaran</div>
            <div style="left: 1480px; top: 33px; font-size: 30px;">
                <?php
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo 'Guest';
                }
                ?>
            </div>
        </div>

        <div class="centered-content" style="top: 571px; width: 705px; height: 52px;">
            di Portal Penerimaan Mahasiswa Baru <br />Universitas Lari Indonesia
        </div>

        <div class="centered-content" style="top: 476px; width: 683px; height: 71px; font-size: 64px;">
            SELAMAT DATANG
        </div>

        <img src="images/logo.png" style="width: 324px; height: 286px; left: 50%; top: 207px; transform: translateX(-50%); position: absolute;" />

        <div style="width: 266px; height: 112px; left: 145px; top: 18px; color: #D9D9D9; font-size: 96px; font-family: Almarai; font-weight: 700; word-wrap: break-word; position: absolute;">
            UNLI
        </div>

        <div style="width: 108px; height: 0px; left: 378px; top: 11px; transform: rotate(90deg); transform-origin: 0 0; border: 1px white solid; position: absolute;"></div>

        <div class="dropdown-container" style="left: 1400px; top: 90px;">
            <select class="custom-dropdown" onchange="handleDropdownChange(this)">
                <option value="informasi">INFORMASI</option>
                <option value="bukti_pendaftaran">Bukti Pendaftaran</option>
                <option value="pengumuman_penerimaan">Pengumuman Penerimaan</option>
                <option value="kegiatan">Kegiatan</option>
            </select>
        </div>

        <div class="dropdown-container" style="left: 1200px; top: 90px;">
            <select class="custom-dropdown" onchange="handleDropdownChange(this)">
                <option value="profil">PROFIL</option>
                <option value="visi_misi">Visi dan Misi</option>
                <option value="logout">Logout</option>
            </select>
        </div>
    </div>

    <!-- Tautan JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function handleDropdownChange(select) {
            var selectedValue = select.value;
            if (selectedValue === "bukti_pendaftaran") {
                window.location.href = "pendaftar.html";
            } else if (selectedValue === "kegiatan") {
                window.location.href = "kegiatan.html";
            } else if (selectedValue === "visi_misi") {
                window.location.href = "vdm.html";
            } else if (selectedValue === "logout") {
                window.location.href = "logout.php";
            } else if (selectedValue === "pengumuman_penerimaan") {
                window.location.href = "pengumuman.html";
            }
        }
    </script>
</body>
</html>
