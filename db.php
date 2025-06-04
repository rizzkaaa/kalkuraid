<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$host = 'caboose.proxy.rlwy.net';
$port = 54383;
$user = 'root';
$password = 'lMfBLtmabZTbZlagmVTgQqLQWKtJoYho';
$database = 'railway';

$connect = mysqli_connect($host, $user, $password, $database, $port);

if (!$connect) {
    die('Koneksi Error:' . mysqli_connect_error());
}
 mysqli_query($connect, "DELETE FROM users");

function generateID()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $idGenerate = '';

    for ($i = 0; $i < 8; $i++) {
        $index = random_int(0, strlen($characters) - 1);
        $idGenerate .= $characters[$index];
    }

    return $idGenerate;
}

function generateUsername($nama)
{
    $huruf = strtolower(substr($nama, 0, 4));
    $angka = rand(10, 99);
    $username = $huruf . $angka;

    return $username;
}


$username = generateUsername('Rizka');
// $query = "INSERT INTO users (id_user, username, password, peran) VALUES ('$id_user', '$username', '1234', 'Mahasiswa')";

?>