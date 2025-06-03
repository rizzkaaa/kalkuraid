<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../../db.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!isset($_POST['peran'])) {
        header("Location: ./?pesan=status-gagal");
    }

    if ($_POST['peran'] == 'mahasiswa') {
        $id_mhs = generateID();
        $id_user = generateID();
        $nama = mysqli_real_escape_string($connect, $_POST['nama_mhs']);
        $npm = mysqli_real_escape_string($connect, $_POST['npm']);
        $univ = mysqli_real_escape_string($connect, $_POST['univ_mhs']);
        $usn = mysqli_real_escape_string($connect, $_POST['username']);
        $pw = md5($_POST['password']);
        $peran = mysqli_real_escape_string($connect, $_POST['peran']);

        $insertUser = mysqli_query($connect, "INSERT INTO users (id_user, username, password, peran) VALUES ('$id_user', '$usn', '$pw', '$peran')");
        $insertData = mysqli_query($connect, "INSERT INTO mahasiswa (id_mhs, nama_mhs, npm, univ, id_user) VALUES ('$id_mhs',' $nama', '$npm', '$univ', '$id_user')");


    } else {
        $id_dosen = generateID();
        $id_user = generateID();
        $nama = mysqli_real_escape_string($connect, $_POST['nama_dosen']);
        $nip = mysqli_real_escape_string($connect, $_POST['nip']);
        $univ = mysqli_real_escape_string($connect, $_POST['univ_dosen']);
        $usn = mysqli_real_escape_string($connect, $_POST['username']);
        $pw = md5($_POST['password']);
        $peran = mysqli_real_escape_string($connect, $_POST['peran']);

        $insertUser = mysqli_query($connect, "INSERT INTO users (id_user, username, password, peran) VALUES ('$id_user', '$usn', '$pw', '$peran')");
        $insertData = mysqli_query($connect, "INSERT INTO dosen (id_dosen, nama_dosen, nip, univ, id_user) VALUES ('$id_dosen',' $nama', '$nip', '$univ', '$id_user')");
    }

    if ($insertUser && $insertData) {
        header("Location: ../");
        exit;
    }
}
?>