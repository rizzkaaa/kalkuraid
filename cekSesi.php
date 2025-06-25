<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db.php';
session_start();

if (isset($_SESSION['id_user']) || isset($_COOKIE['remember_token'])) {
    $token = mysqli_real_escape_string($connect, $_COOKIE['remember_token']);

    $result = mysqli_query($connect, "SELECT * FROM user_tokens WHERE token='$token' AND expired_at > NOW()");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $data_user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE id_user='$user_id'"));

        $_SESSION['id_user'] = $user_id;

        if ($data_user['peran'] == "Mahasiswa") {
            header("location: ./dashboard/mahasiswa/");
            exit();
        } elseif ($data_user['peran'] == "Dosen") {
            header("location: ./dashboard/dosen/");
            exit();
        } else {
            echo "Peran tidak dikenali!";
            exit();
        }
        // echo "yes";
    } else {
        // echo "no";

        setcookie('remember_token', '', time() - 3600, '/');
        header("location: ./menu/");
        exit();
    }
} else {
    // echo "ngape ni anjir";
    header("location: ./menu/");
    exit();
}
