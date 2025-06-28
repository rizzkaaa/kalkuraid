<?php
session_start();
include '../../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_room'], $_POST['id_mhs'])) {
        $id_room = mysqli_real_escape_string($connect, $_POST['id_room']);
        $id_mhs = mysqli_real_escape_string($connect, $_POST['id_mhs']);

        $cekRoom = mysqli_query($connect, "SELECT * FROM classroom WHERE id_room='$id_room'");
        if (mysqli_num_rows($cekRoom) <= 0) {
            header('Location: ../../class/input-kode/?id_mhs='.$id_mhs.'&&pesan=kode-salah');
            exit();
        }

        $cekMhs = mysqli_query($connect, "SELECT * FROM detail_room WHERE id_room='$id_room' AND id_mhs='$id_mhs'");
        if (mysqli_num_rows($cekMhs) > 0) {
            header('Location: ../../class/input-kode/?id_mhs='.$id_mhs.'&&pesan=Anda-telah-berada-di-room');
            exit();
        }

        $id_detail_room = generateID();

        $insertDetailRoom = mysqli_query($connect, "INSERT INTO detail_room (id_detail_room, id_room, id_mhs) VALUES ('$id_detail_room', '$id_room', '$id_mhs')");

        if ($insertDetailRoom) {

            header("location: ../../game/map/map-game/?id_detail_room=".$id_detail_room);
            exit();
        }
    }
}
