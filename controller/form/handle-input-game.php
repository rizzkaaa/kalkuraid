<?php
session_start();
include '../../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_detail_room = mysqli_real_escape_string($connect, $_POST['id_detail_room']);
    $id_detail_level = mysqli_real_escape_string($connect, $_POST['id_detail_level']);
    $jumlah_soal = mysqli_real_escape_string($connect, $_POST['jumlah_soal']);

    $skorPerSoal = 100 / $jumlah_soal;
    $skor = 0;
    $totalBenar = 0;
    $totalSalah =  0;
    for ($i = 1; $i <= $jumlah_soal; $i++) {
        $id_detail_soal = mysqli_real_escape_string($connect, $_POST['id_detail_soal' . $i]);
        $jawaban = mysqli_real_escape_string($connect, $_POST['jawaban' . $i]);
        $benar = 0;

        $dataSoal = mysqli_fetch_assoc(mysqli_query($connect, "SELECT b.jawaban, b.id_soal FROM detail_soal a INNER JOIN soal b ON a.id_soal=b.id_soal WHERE id_detail_soal='$id_detail_soal'"));
        $jawaban == $dataSoal['jawaban'] ? $benar = 1 : $benar = 0;

        if ($benar == 1) {
            $skor += $skorPerSoal;
            $totalBenar++;
        } else{
            $totalSalah++;
        }

        mysqli_query($connect, "INSERT INTO jawaban_mhs (id_detail_soal, id_detail_room, jawaban, benar) VALUES ('$id_detail_soal', '$id_detail_room', '$jawaban', '$benar')");

        // echo $benar . '<br>' . $jawaban . '<br>' . $dataSoal['jawaban'] . '<br>' . $dataSoal['id_soal'] . '<br>';
    }

    mysqli_query($connect, "INSERT INTO skor_level (id_detail_level, id_detail_room, skor_mhs, total_benar, total_salah) VALUES ('$id_detail_level', '$id_detail_room', $skor, $totalBenar, $totalSalah)");
    $id_skor = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM skor_level WHERE id_detail_level='$id_detail_level' AND id_detail_room='$id_detail_room'"))['id_skor'];

    header("Location: ../../game/after-game/result/?id_skor=$id_skor");
    exit();
}
