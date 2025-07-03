<?php
include '../../db.php';

session_start();
$id_user = $_SESSION['id_user'];
$dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM mahasiswa WHERE id_user = '$id_user'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teorema Penggantian </title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

</head>

<body>
    <div class="container">
        <header>
            <a href="../" class="btn-undo"><img src="../../assets/button/btn-undo.png"></a>

            <div class="nama-user">
                <p><?= $dataUser['nama_mhs'] ?></p>
            </div>
        </header>

        <div class="wrap-materi">
            <div class="pengertian">
                <h3>Pengertian</h3>
                <div class="wrap-pengertian">
                    <p>Teorema Pengganti Integral (juga dikenal sebagai teorema substitusi) adalah metode yang digunakan untuk menyederhanakan proses penghitungan integral, khususnya ketika bentuk fungsi yang diintegralkan cukup kompleks. </p>
                </div>
            </div>
            
            <div class="pengertian">
                <iframe
                    src="https://www.youtube.com/embed/ID_VIDEO"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>

                <p>Ayo klilk video di atas dan simak baik-baik</p>
            </div>
        </div>
        <audio id="klikSound" src="../../assets/sound/sound-klik.mp3" preload="auto"></audio>
        <script>
            document.querySelector('a').addEventListener('click', () => {
                const klikSound = document.getElementById("klikSound");
                klikSound.play();
            })
        </script>
</body>

</html>