<?php
session_start();
include '../../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nama_room'], $_POST['jumlah_peserta'], $_POST['jumlah-level'])) {
        $nama_room = mysqli_real_escape_string($connect, $_POST['nama_room']);
        $jumlah_peserta = mysqli_real_escape_string($connect, $_POST['jumlah_peserta']);
        $id_room = generateID();
        $now = date('Y-m-d H:i:s');

        $insertClassroom = mysqli_query($connect, "INSERT INTO classroom (id_room, nama_room, tgl_buat, jumlah_peserta) VALUES ('$id_room', '$nama_room', '$now', '$jumlah_peserta')");

        if (isset($_POST['id_dosen'])) {
            $id_dosen = mysqli_real_escape_string($connect, $_POST['id_dosen']);
            $updateClassroom = mysqli_query($connect, "UPDATE classroom SET id_dosen='$id_dosen'");
        }

        $jumlah_level = $_POST['jumlah-level'];
        for ($i = 1; $i <= $jumlah_level; $i++) {
            $id_detail_level = generateID();
            $level = mysqli_real_escape_string($connect, $_POST['level' . $i]);
            $soalLevel = mysqli_real_escape_string($connect, $_POST['soal-level' . $i]);

            $insertDetailLevel = mysqli_query($connect, "INSERT INTO detail_level (id_detail_level, id_room, id_level, jumlah_soal) VALUES ( '$id_detail_level', '$id_room', '$level', '$soalLevel')");
        }

        if ($insertClassroom && $updateClassroom && $insertDetailLevel) {
            $peran = $_SESSION['peran'];

            if ($peran == "Mahasiswa") {
                header("location: ../../dashboard/mahasiswa/");
            } elseif ($peran == "Dosen") {
                header("location: ../../dashboard/dosen/");
            }
            exit();
        } else {
            header('Location: ../../class/create-class/?pesan=terjadi-kesalahan');
            exit();
        }
    } else {
        // var_dump($_POST);
        header('Location: ../../class/create-class/?pesan=data-tidak-lengkap');
        exit();
    }
}
