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
} else {
    echo "Koneksi berhasil";
}


$tabelRoom = "CREATE TABLE classroom(
id_room VARCHAR(20) PRIMARY KEY,
nama_room VARCHAR(50),
tgl_buat VARCHAR(30),
id_dosen VARCHAR(20) NULL,
FOREIGN KEY (id_dosen) REFERENCES dosen(id_dosen)
ON DELETE SET NULL ON UPDATE CASCADE 
)";

$tabelDetailRoom = "CREATE TABLE detail_room(
id_detail_room VARCHAR(20) PRIMARY KEY,
id_room VARCHAR(20) NULL,
id_mhs VARCHAR(20) NULL,
total_skor DECIMAL(3,2),
FOREIGN KEY (id_room) REFERENCES classroom(id_room)
ON DELETE SET NULL ON UPDATE CASCADE,
FOREIGN KEY (id_mhs) REFERENCES mahasiswa(id_mhs)
ON DELETE SET NULL ON UPDATE CASCADE 
)";

$tabelDetailLevel = "CREATE TABLE detail_level(
id_detail_level VARCHAR(20) PRIMARY KEY,
id_room VARCHAR(20) NULL,
id_level VARCHAR(20) NULL,
FOREIGN KEY (id_room) REFERENCES classroom(id_room)
ON DELETE SET NULL ON UPDATE CASCADE,
FOREIGN KEY (id_level) REFERENCES level(id_level)
ON DELETE SET NULL ON UPDATE CASCADE 
)";

$tabelLevel = "CREATE TABLE level(
id_level VARCHAR(20) PRIMARY KEY,
nama_level VARCHAR(50)
)";

$tabelSoal = "CREATE TABLE soal(
id_soal VARCHAR(20) PRIMARY KEY,
id_level VARCHAR(20) NULL,
soal_img VARCHAR(255) NULL,
soal TEXT NULL,
opsi_1 VARCHAR(255),
opsi_2 VARCHAR(255),
opsi_3 VARCHAR(255),
opsi_4 VARCHAR(255),
jawaban VARCHAR(20),
FOREIGN KEY (id_level) REFERENCES level(id_level)
ON DELETE SET NULL ON UPDATE CASCADE
)";

$tabelSkorLevel = "CREATE TABLE skor_level(
id_skor VARCHAR(20) PRIMARY KEY,
id_detail_level VARCHAR(20) NULL,
id_detail_room VARCHAR(20) NULL,
skor_mhs DECIMAL(3,2),
FOREIGN KEY (id_detail_level) REFERENCES detail_level(id_detail_level)
ON DELETE SET NULL ON UPDATE CASCADE,
FOREIGN KEY (id_detail_room) REFERENCES detail_room(id_detail_room)
ON DELETE SET NULL ON UPDATE CASCADE
)";


$tabelJawaban = "CREATE TABLE jawaban_mhs(
id_jawaban VARCHAR(20) PRIMARY KEY,
id_detail_room VARCHAR(20) NULL,
id_soal VARCHAR(20),
jawaban VARCHAR(20),
benar BOOLEAN,
FOREIGN KEY (id_detail_room) REFERENCES detail_room(id_detail_room)
ON DELETE SET NULL ON UPDATE CASCADE,
FOREIGN KEY (id_soal) REFERENCES soal(id_soal)
ON DELETE SET NULL ON UPDATE CASCADE
)";

mysqli_query($connect, $tabelSkorLevel);
mysqli_query($connect, $tabelJawaban);

// $test = mysqli_query($connect, "DROP TABLE test1");

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

$id_user = generateID();
$username = generateUsername('Rizka');
// $query = "INSERT INTO users (id_user, username, password, peran) VALUES ('$id_user', '$username', '1234', 'Mahasiswa')";

?>