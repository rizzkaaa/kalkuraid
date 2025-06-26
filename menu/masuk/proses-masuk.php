<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include '../../db.php';

$username = $_POST["username"];
$password = md5($_POST["password"]);

$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($connect, $query);
$cek = mysqli_num_rows($result);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($result);
    $id_user = $data['id_user'];
    $_SESSION['id_user'] = $id_user;

    $token = bin2hex(random_bytes(32)); // token acak

    $expired_at = date('Y-m-d H:i:s', strtotime('+360 days'));
    // mysqli_query($connect, "DELETE FROM user_tokens WHERE user_id='$id_user'");
    mysqli_query($connect, "INSERT INTO user_tokens (user_id, token, expired_at) VALUES ('$id_user', '$token', '$expired_at')");

    setcookie('remember_token', $token, time() + (86400 * 360), '/', '', true, true);


    if ($data['peran'] == "Mahasiswa") {
        header("location: ../../dashboard/mahasiswa/");
        exit();
    } elseif ($data['peran'] == "Dosen") {
        header("location: ../../dashboard/dosen/");
        exit();
    } else {
        echo "Peran tidak dikenali.";
        exit();
    }
} else {
    header('location: ./?pesan=gagal');
}
