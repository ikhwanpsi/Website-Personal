<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'user' && $password === 'user') {
        $_SESSION['loggedin'] = true;
        header('Location: adminpage.html');
        exit();
    } else {
        echo "<script>alert('Invalid username or password'); window.location.href='admin.html';</script>";
    }
} else {
    header('Location: admin.html');
    exit();
}
?>
