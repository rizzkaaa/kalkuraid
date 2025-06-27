<?php
session_start();
include '../../db.php';

if (!isset($_GET["id_room"]) || empty($_GET["id_room"])) {
    die("Error: ID tidak ditemukan.");
}

$id_room = $_GET["id_room"];
$dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM classroom WHERE id_room='$id_room'"));

$nama_room = $dataClass['nama_room'] . ' copy';
$id_dosen = $dataClass['id_dosen'];
$jumlah_peserta = $dataClass['jumlah_peserta'];
$id_roomNew = generateID();
$now = date('Y-m-d H:i:s');

$insertClassroom = mysqli_query($connect, "INSERT INTO classroom (id_room, id_dosen, nama_room, tgl_buat, jumlah_peserta) VALUES ('$id_roomNew','$id_dosen', '$nama_room', '$now', '$jumlah_peserta')");
$dataDetailLevel = mysqli_query($connect, "SELECT * FROM detail_level WHERE id_room='$id_room'");

while ($rowDetail = mysqli_fetch_assoc($dataDetailLevel)) {
    $id_detail_level = generateID();
    $id_level = $rowDetail['id_level'];
    $jumlah_soal = $rowDetail['jumlah_soal'];
    
    $insertDetailLevel = mysqli_query($connect, "INSERT INTO detail_level (id_detail_level, id_room, id_level, jumlah_soal) VALUES ( '$id_detail_level', '$id_roomNew', '$id_level', '$jumlah_soal')");
}


$peran = $_SESSION['peran'];
if ($insertClassroom && $insertDetailLevel) {

    if ($peran == "Mahasiswa") {
        header("location: ../../dashboard/mahasiswa/");
    } elseif ($peran == "Dosen") {
        header("location: ../../dashboard/dosen/");
    }
} else {
    if ($peran == "Mahasiswa") {
        header("location: ../../dashboard/mahasiswa/?pesan=aksi-gagal");
    } elseif ($peran == "Dosen") {
        header("location: ../../dashboard/dosen/?pesan=aksi-gagal");
    }
}
exit();
