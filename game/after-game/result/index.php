<?php
include '../../../db.php';
if (!isset($_GET["id_skor"]) && empty($_GET["id_skor"])) {
    die("Error: ID tidak ditemukan.");
}

$id_skor = $_GET["id_skor"];
$dataLevel = mysqli_fetch_assoc(mysqli_query($connect, "SELECT a.*, b.id_level,d.id_room, d.nama_room FROM skor_level a INNER JOIN detail_level b ON a.id_detail_level=b.id_detail_level INNER JOIN detail_room c ON a.id_detail_room=c.id_detail_room INNER JOIN classroom d ON c.id_room=d.id_room WHERE a.id_skor=$id_skor"));

$id_detail_room = $dataLevel['id_detail_room'];
$id_room = $dataLevel['id_room'];
$jumlahSkor = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS jumlah_skor FROM skor_level WHERE id_detail_room='$id_detail_room'"));
$jumlahLevel = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS jumlah_level FROM detail_level WHERE id_room='$id_room'"));

$full = $jumlahSkor['jumlah_skor'] == $jumlahLevel['jumlah_level'];

if ($full) {
    $dataSkor = mysqli_query($connect, "SELECT skor_mhs FROM skor_level WHERE id_detail_room='$id_detail_room'");
    $total_skor = 0;

    while ($skorMhs = mysqli_fetch_assoc($dataSkor)) {
        $total_skor += $skorMhs['skor_mhs'];
    }
    $total_skor = $total_skor / $jumlahLevel['jumlah_level'];

    $cekSkor = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM detail_room WHERE id_detail_room='$id_detail_room'"))['total_skor'];
    if ($cekSkor == 0) {
        mysqli_query($connect, "UPDATE detail_room SET total_skor=$total_skor WHERE id_detail_room='$id_detail_room'");
    }
}
$nextStep = $full ? "../../../class/report-game/?id_detail_room=$id_detail_room" : "../../map/map-game/?id_detail_room=$id_detail_room";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Mahasiswa</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="nama-user">
                <p><?= $dataLevel['nama_room'] ?></p>
            </div>
        </header>

        <div class="wrap-result">
            <a href="<?= $nextStep ?>"><img src="../../../assets/button/btn-x.png"></a>
            <p>LV <?= $dataLevel['id_level'] ?></p>
            <img src="../../../assets/component/level-<?= $dataLevel['id_level'] ?>.png">
            <div>
                <span><?= $dataLevel['total_benar'] ?></span>
                <span><?= $dataLevel['total_salah'] ?></span>
            </div>
        </div>
    </div>

    <button></button>
    <audio id="klikSound" src="../../../assets/sound/sound-klik.mp3" preload="auto"></audio>
    <audio id="yeaySound" src="../../../assets/sound/sound-yeay.mp3" preload="auto"></audio>

    <script>
        let yeayPlayed = false; 

        document.addEventListener('click', () => {
            if (!yeayPlayed) {
                const yeaySound = document.getElementById("yeaySound");
                yeaySound.play().catch(e => console.warn('Gagal play yeay:', e));
            }
        });

        document.querySelector('a').addEventListener('click', () => {
            const klikSound = document.getElementById("klikSound");
            klikSound.play().catch(e => console.warn('Gagal play klik:', e));
        });
    </script>
</body>

</html>