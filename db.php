<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// $host = 'caboose.proxy.rlwy.net';
// $port = 54383;
// $user = 'root';
// $password = 'lMfBLtmabZTbZlagmVTgQqLQWKtJoYho';
// $database = 'railway';

// $host = '13.210.158.221';
// $port = 3306;
// $user = 'admin';
// $password = 'passwordku';
// $database = 'kalkuraid';

$host = 'localhost';
// $port = 3306;
$user = 'root';
$password = '';
$database = 'db_kalkuraid';

$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
    die('Koneksi Error:' . mysqli_connect_error());
}

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


?>