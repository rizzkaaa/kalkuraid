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

if($cek > 0){
    $data = mysqli_fetch_assoc($result);
    $_SESSION['id_user'] = $data['id_user'];

    if($data['peran'] == "Mahasiswa"){
        header("location: ../../dashboard/mahasiswa");
    } elseif($data['peran'] == "Dosen"){
        header("location: ../../dashboard/dosen");
    } else{
        echo "Peran tidak dikenali.";
    }
} else {
    header('./?pesan=gagal');
}
?>