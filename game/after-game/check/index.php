<?php
include '../../../db.php';
if (!isset($_GET["id_detail_level"]) && empty($_GET["id_detail_level"]) && !isset($_GET["id_detail_room"]) && empty($_GET["id_detail_room"])) {
    die("Error: ID tidak ditemukan.");
}

$id_detail_room = $_GET["id_detail_room"];
$id_detail_level = $_GET["id_detail_level"];
$dataLevel = mysqli_fetch_assoc(mysqli_query($connect, "SELECT a.id_room, a.jumlah_soal, b.* FROM detail_level a INNER JOIN level b ON a.id_level=b.id_level WHERE a.id_detail_level='$id_detail_level'"));

// var_dump($id_detail_room, $id_detail_level);
$id_room = $dataLevel['id_room'];
$dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM classroom WHERE id_room='$id_room'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Play</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <a href="../../map/map-game/?id_detail_room=<?= $id_detail_room ?>" class="btn-undo"><img src="../../../assets/button/btn-undo.png" alt=""></a>

            <div class="nama-user">
                <p><?= $dataClass['nama_room'] ?></p>
            </div>
        </header>

        <div class="soal-container">
            <div class="papan-judul">
                <h2>LV <?= $dataLevel['id_level'] ?></h2>
                <p><?= $dataLevel['nama_level'] ?></p>
            </div>
            <div class="daftar-soal">
                <?php
                $dataSoal = mysqli_query($connect, "SELECT a.id_detail_soal, b.* FROM detail_soal a INNER JOIN soal b ON a.id_soal=b.id_soal WHERE id_detail_level='$id_detail_level' ORDER BY RAND()");
                $no = 0;
                while ($rowSoal = mysqli_fetch_assoc($dataSoal)) {
                    ++$no ?>
                    <div class="swipe-soal">
                        <div class="scroll-soal">
                            <div class="card-soal soal-<?= $no % 2 == 0 ? 'brown' : 'green' ?>">
                                <div class="wrap-soal">
                                    <div class="no-soal">
                                        <p>Soal <?= $no ?></p>
                                    </div>
                                    <div class="soal">
                                        <?php if (isset($rowSoal['soal_img'])) { ?>
                                            <img src="../../../assets/soal/<?= $rowSoal['soal_img'] ?>" alt="">
                                        <?php } ?>
                                        <?php if (isset($rowSoal['soal'])) { ?>
                                            <p><?= $rowSoal['soal'] ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <ul class="wrap-opsi">
                                    <?php
                                    $id_detail_soal = $rowSoal['id_detail_soal'];
                                    $dataJawaban = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM jawaban_mhs WHERE id_detail_soal='$id_detail_soal' AND id_detail_room='$id_detail_room'"));
                                    $arrayLi = [
                                        ['label' => 'opsi_1', 'isi' => $rowSoal['opsi_1']],
                                        ['label' => 'opsi_2', 'isi' => $rowSoal['opsi_2']],
                                        ['label' => 'opsi_3', 'isi' => $rowSoal['opsi_3']],
                                        ['label' => 'opsi_4', 'isi' => $rowSoal['opsi_4']],
                                    ];
                                    shuffle($arrayLi);

                                    foreach ($arrayLi as $i => $opsi):
                                        $answer = $rowSoal['jawaban'] == $opsi['label'];
                                        $selected = $dataJawaban['jawaban'] == $opsi['label'];
                                    ?>
                                        <li class="<?= $selected || $answer ? 'selected-answer' : '' ?>"><label for="soal<?= $no . '-' . $opsi['label'] ?>">
                                                <p>
                                                    <?php if ($opsi['label'] == $rowSoal['jawaban']) { ?>
                                                        <span class="correct">&#10004;</span>

                                                    <?php
                                                    } else { ?>
                                                         <span class="incorrect">&#10006;</span>

                                                    <?php } ?>
                                                </p>
                                                <span></span>
                                                <span><?= $opsi['isi'] ?></span>
                                            </label></li>
                                    <?php endforeach; ?>

                                </ul>
                                <div class="wrap-jawaban">
                                    <label><?= $dataJawaban['jawaban'] == $rowSoal['jawaban'] ? 'Bagus Sekali!' : 'Sayang Sekali!' ?></label>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</body>

</html>