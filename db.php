<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$host = 'caboose.proxy.rlwy.net';
$port = 54383;
$user = 'root';
$password = 'lMfBLtmabZTbZlagmVTgQqLQWKtJoYho';
$database = 'railway';

$connect = mysqli_connect($host, $user, $user, $password, $port);

if (!$connect){
    die('Koneksi Error:'. mysqli_connect_error());
} else {
    echo "Koneksi berhasil";
}
?>