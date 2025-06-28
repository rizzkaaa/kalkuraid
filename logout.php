<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db.php';
session_start();
session_destroy();

// Hapus cookie
setcookie('remember_token', '', time() - 3600, '/');

// Hapus token dari database
$token = mysqli_real_escape_string($connect, $_COOKIE['remember_token'] ?? '');
mysqli_query($connect, "DELETE FROM user_tokens WHERE token='$token'");

header("Location: ./menu/");
exit();