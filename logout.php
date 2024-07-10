<?php
session_start();
session_unset();
session_destroy();
setcookie('username', '', time() - 3600, '/');
setcookie('username_created', '', time() - 3600, '/');
header('Location: masuk.php');
exit();
?>
