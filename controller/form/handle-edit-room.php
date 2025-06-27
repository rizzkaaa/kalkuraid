<?php
session_start();
include '../../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nama_room'], $_POST['jumlah_peserta'], $_POST['id_room'])) {
        $id_room = mysqli_real_escape_string($connect, $_POST['id_room']);
        $nama_room = mysqli_real_escape_string($connect, $_POST['nama_room']);
        $jumlah_peserta = mysqli_real_escape_string($connect, $_POST['jumlah_peserta']);
    
        $updateClassroom = mysqli_query($connect, "UPDATE  classroom SET nama_room='$nama_room', jumlah_peserta='$jumlah_peserta' WHERE id_room='$id_room'");

        if ($updateClassroom) {
            $peran = $_SESSION['peran'];

            if ($peran == "Mahasiswa") {
                header("location: ../../dashboard/mahasiswa/");
            } elseif ($peran == "Dosen") {
                header("location: ../../dashboard/dosen/");
            }
            exit();
        } else {
            header('Location: ../../class/edit-class/?pesan=terjadi-kesalahan');
            exit();
        }
    }
}
