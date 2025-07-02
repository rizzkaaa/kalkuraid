<?php
include '../../db.php';
if (!isset($_GET["id_detail_level"]) && empty($_GET["id_detail_level"]) && !isset($_GET["id_detail_room"]) && empty($_GET["id_detail_room"])) {
    die("Error: ID tidak ditemukan.");
}

$id_detail_room = $_GET["id_detail_room"];
$id_detail_level = $_GET["id_detail_level"];
$dataLevel = mysqli_fetch_assoc(mysqli_query($connect, "SELECT a.id_room, a.jumlah_soal, b.* FROM detail_level a INNER JOIN level b ON a.id_level=b.id_level WHERE a.id_detail_level='$id_detail_level'"));

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
    <link rel="stylesheet" href="../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <form method="POST" action="../../controller/form/handle-input-game.php" class="container">
        <input type="hidden" value="<?= $id_detail_room ?>" name="id_detail_room">
        <input type="hidden" value="<?= $id_detail_level ?>" name="id_detail_level">
        <input type="hidden" value="<?= $dataLevel['jumlah_soal'] ?>" name="jumlah_soal">

        <header>
            <button class="btn-undo" type="submit"><img src="../../assets/button/btn-submit.png"></button>

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
                                            <img src="../../assets/soal/<?= $rowSoal['soal_img'] ?>">
                                        <?php } ?>
                                        <?php if (isset($rowSoal['soal'])) { ?>
                                            <p><?= $rowSoal['soal'] ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <ul class="wrap-opsi">
                                    <?php $arrayLi = [
                                        ['label' => 'opsi_1', 'isi' => $rowSoal['opsi_1']],
                                        ['label' => 'opsi_2', 'isi' => $rowSoal['opsi_2']],
                                        ['label' => 'opsi_3', 'isi' => $rowSoal['opsi_3']],
                                        ['label' => 'opsi_4', 'isi' => $rowSoal['opsi_4']],
                                    ];
                                    shuffle($arrayLi);

                                    foreach ($arrayLi as $i => $opsi):
                                    ?>
                                        <li><label for="soal<?= $no . '-' . $opsi['label'] ?>">
                                                <p><span>&#10004;</span></p>
                                                <input type="radio" value="<?= $opsi['label'] ?>" name="jawaban<?= $no ?>" class="opsi" id="soal<?= $no . '-' . $opsi['label'] ?>" required>
                                                <?php
                                                $ekstensi = ['png', 'jpg', 'jpeg', 'svg'];
                                                $img = false;
                                                foreach ($ekstensi as $ext) {
                                                    if (str_contains($opsi['isi'], ".$ext")) {
                                                        $img = true;
                                                        break;
                                                    }
                                                }
                                                if (!$img) { ?>
                                                    <span><?= $opsi['isi'] ?></span>
                                                <?php } else { ?>
                                                    <span><img src="../../assets/soal/<?= $opsi['isi'] ?>"></span>
                                                <?php } ?>
                                            </label></li>
                                    <?php endforeach; ?>

                                </ul>
                                <div class="wrap-jawaban">
                                    <label>Selamat Mengerjakan</label>
                                </div>

                                <input type="hidden" value="<?= $rowSoal['id_detail_soal'] ?>" name="id_detail_soal<?= $no ?>">
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </form>
    <audio id="klikSound" src="../../assets/sound/sound-klik.mp3" preload="auto"></audio>
    <audio id="klikSoundPlay" src="../../assets/sound/sound-klik-play.mp3" preload="auto"></audio>
    <audio id="bgSound" src="../../assets/sound/play-sound.mp3" loop preload="auto"></audio>

    <script>
        document.addEventListener('click', () => {
            const bgSound = document.getElementById("bgSound");
            bgSound.play();
        })

        document.querySelector('.btn-undo').addEventListener('click', (e) => {
            const form = document.querySelector('form');
            const klikSound = document.getElementById("klikSound");
            klikSound.play();

            e.preventDefault();
            const yakin = confirm('Anda yakin ingin menghentikan permainan? Anda tidak dapat kembali.');
            if (yakin) {
                form.submit();
            }
        })

        const options = document.querySelectorAll(".opsi");

        options.forEach(option => {
            option.addEventListener("change", () => {
                if (option.checked) {
                    const klikSoundPlay = document.getElementById("klikSoundPlay");
                    klikSoundPlay.play();
                    const wrapOpsi = option.closest(".wrap-opsi");

                    wrapOpsi.querySelectorAll("li").forEach(li => {
                        li.classList.remove("selected-answer");
                    });

                    const li = option.closest("li");
                    li.classList.add("selected-answer");
                }
            });
        });
    </script>

</body>

</html>