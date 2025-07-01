<?php
session_start();
include '../../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_detail_level = mysqli_real_escape_string($connect, $_POST['id_detail_level']);
    $id_level = mysqli_fetch_assoc(mysqli_query($connect, "SELECT id_level FROM detail_level  WHERE id_detail_level='$id_detail_level'"))['id_level'];

    $soal = isset($_POST['soal']) && !empty($_POST['soal']) ? $_POST['soal'] : NULL;
    $jawaban = mysqli_real_escape_string($connect, $_POST['jawaban']);

    $insertSoal = mysqli_query($connect, "INSERT INTO soal (id_level, soal, jawaban) VALUES ($id_level, '$soal', '$jawaban')");
    $id_soal = mysqli_insert_id($connect);

    for ($i = 1; $i < 5; $i++) {
        $opsi;
        if (isset($_POST['opsi_' . $i]) && !empty($_POST['opsi_' . $i])) {
            $opsi = $_POST['opsi_' . $i];
        } else {
            if (isset($_FILES['opsi_' . $i . '-img']) && !empty($_FILES['opsi_' . $i . '-img']) && $_FILES['opsi_' . $i . '-img']['error'] === UPLOAD_ERR_OK) {
                $savedopsi = $_FILES['opsi_' . $i . '-img'];
                $angka = rand(10, 99);
                $extention = array('png', 'jpg', 'jpeg', 'svg');
                $filename = $_FILES['opsi_' . $i . '-img']['name'];
                $ukuran = $_FILES['opsi_' . $i . '-img']['size'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (!in_array($ext, $extention)) {
                    header("Location: ../../class/input-soal/?id_detail_level=$id_detail_level&&pesan=ekstensi-salah");
                    exit();
                } else {
                    if ($ukuran < 1044070) {
                        $opsi =  $angka . "_" . $filename;
                        move_uploaded_file($_FILES['opsi_' . $i . '-img']['tmp_name'], '../../assets/soal/' . $opsi);
                    } else {
                        header("Location: ../../class/input-soal/?id_detail_level=$id_detail_level&&pesan=ukuran-salah");
                        exit();
                    }
                }
            }
        }

        $updateOpsi = mysqli_query($connect, "UPDATE soal SET opsi_$i = '$opsi' WHERE id_soal = $id_soal");
    }

    if (isset($_FILES['soal_img']) && !empty($_FILES['soal_img']) && $_FILES['soal_img']['error'] === UPLOAD_ERR_OK) {
        $soal_img = $_FILES['soal_img'];
        $angka = rand(10, 99);
        $extention = array('png', 'jpg', 'jpeg', 'svg');
        $filename = $_FILES['soal_img']['name'];
        $ukuran = $_FILES['soal_img']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($ext, $extention)) {
            header("Location: ../../class/input-soal/?id_detail_level=$id_detail_level&&pesan=ekstensi-salah");
            exit();
        } else {
            if ($ukuran < 1044070) {
                $savesoal_img =  $angka . "_" . $filename;
                move_uploaded_file($_FILES['soal_img']['tmp_name'], '../../assets/soal/' . $savesoal_img);
                $updateSoal = mysqli_query($connect, "UPDATE soal SET soal_img = '$savesoal_img' WHERE id_soal = $id_soal");
            } else {
                header("Location: ../../class/input-soal/?id_detail_level=$id_detail_level&&pesan=ukuran-salah");
                exit();
            }
        }
    }

    if ($insertSoal) {
        $id_detail_soal = generateID();
        $insertDetailSoal = mysqli_query($connect, "INSERT INTO detail_soal (id_detail_soal, id_detail_level, id_soal) VALUES ('$id_detail_soal', '$id_detail_level', $id_soal)");

        header("Location: ../../game/evaluasi/?id_detail_level=$id_detail_level");
        exit();
    }
}
