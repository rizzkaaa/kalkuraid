<?php
include '../../db.php';
if (!isset($_GET["id_detail_level"]) || empty($_GET["id_detail_level"])) {
    die("Error: ID tidak ditemukan.");
}

$id_detail_level = $_GET["id_detail_level"];
$dataLevel = mysqli_fetch_assoc(mysqli_query($connect, "SELECT a.id_room, a.jumlah_soal, b.* FROM detail_level a INNER JOIN level b ON a.id_level=b.id_level WHERE a.id_detail_level='$id_detail_level'"));

$id_room = $dataLevel['id_room'];
$dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM classroom WHERE id_room='$id_room'"));

$jumlah_soal = $dataLevel['jumlah_soal'];
$dataSoal = mysqli_query($connect, "SELECT a.id_detail_soal, b.* FROM detail_soal a INNER JOIN soal b ON a.id_soal=b.id_soal WHERE id_detail_level='$id_detail_level'");
$fullSoal = true;

if (mysqli_num_rows($dataSoal) != $jumlah_soal) {
    $fullSoal = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Mahasiswa</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <a href="<?= $fullSoal ? '../map/map-evaluasi/?id_room=' . $id_room : '' ?>" class="btn-undo"><img src="../../assets/button/btn-undo.png"></a>

            <div class="nama-user">
                <p><?= $dataClass['nama_room'] ?></p>
            </div>
        </header>

        <div class="soal-container">
            <div class="papan-judul">
                <h2>LV <?= $dataLevel['id_level'] ?></h2>
                <p><?= $dataLevel['nama_level'] ?></p>
                <p><?= var_dump($fullSoal) ?></p>
            </div>
            <div class="daftar-soal">
                <?php
                $no = 0;
                while ($rowSoal = mysqli_fetch_assoc($dataSoal)) {
                    $no++;
                ?>
                    <div class="swipe-soal">
                        <div class="scroll-soal">
                            <?php
                            $id_detail_soal = $rowSoal['id_detail_soal'];
                            $dataJawaban = mysqli_query($connect, "SELECT a.*, c.nama_mhs  FROM jawaban_mhs a INNER JOIN detail_room b ON a.id_detail_room=b.id_detail_room INNER JOIN mahasiswa c ON b.id_mhs=c.id_mhs WHERE id_detail_soal='$id_detail_soal'");
                            if (mysqli_num_rows($dataJawaban) > 0) {
                            } else {
                            ?>
                                <div class="aksi">
                                    <div class="papan-aksi">
                                        <a href="../../controller/action/hapus-soal.php?id_detail_soal=<?= $rowSoal['id_detail_soal'] ?>&&id_detail_level=<?= $id_detail_level ?>"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>
                            <?php } ?>
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
                                                <input type="radio" value="<?= $opsi['label'] ?>" name="jawaban<?= $no ?>" class="opsi" id="soal<?= $no . '-' . $opsi['label'] ?>" <?= $rowSoal['jawaban'] == $opsi['label'] ? 'checked' : '' ?> disabled>
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
                                    <label for="soal<?= $no ?>">Lihat Jawaban</label>
                                </div>
                            </div>

                            <input type="checkbox" class="toggle-nilai" id="soal<?= $no ?>">
                            <div class="card-nilai nilai-<?= $no % 2 == 0 ? 'brown' : 'green' ?>">
                                <div class="tabel-nilai">
                                    <div class="rows head">
                                        Daftar Nilai
                                    </div>
                                    <div class="rows head">
                                        <div class="head-rows">
                                            Nama
                                        </div>
                                        <div class="garis"></div>
                                        <div class="head-rows">
                                            <p>Opsi</p>
                                            <div>
                                                <span>1</span>
                                                <span>2</span>
                                                <span>3</span>
                                                <span>4</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="daftar-nilai">
                                        <?php
                                        if (mysqli_num_rows($dataJawaban) > 0) {
                                            while ($rowJawaban = mysqli_fetch_assoc($dataJawaban)) { ?>
                                                <div class="rows">
                                                    <div class="data-rows"><span><?= $rowJawaban['nama_mhs'] ?></span></div>
                                                    <div class="garis"></div>
                                                    <div class="data-rows">
                                                        <?php
                                                        for ($i = 1; $i <= 4; $i++) { ?>
                                                            <span>
                                                                <?php if ($rowJawaban['jawaban'] == 'opsi_' . $i) {
                                                                    echo $rowJawaban['benar'] ? '&#9989;' : '&#10060;';
                                                                } ?>

                                                            </span>
                                                            <?php
                                                            if ($i != 4) { ?>
                                                                <div class="garis"></div>

                                                        <?php }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                            <?php }
                                        } else { ?>
                                            <div class="rows">Tidak ada data</div>
                                        <?php }
                                        ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php }
                ?>
            </div>

            <?php if (!$fullSoal) { ?>
                <a href="../../class/input-soal/?id_detail_level=<?= $id_detail_level ?>" class="btn-input-soal">
                    <img src="../../assets/button/btn-input-soal.png">
                </a>
            <?php } ?>
        </div>
    </div>

    <script>
        const options = document.querySelectorAll(".opsi");

        options.forEach(option => {
            if (option.checked) {

                const wrapOpsi = option.closest(".wrap-opsi");

                wrapOpsi.querySelectorAll("li").forEach(li => {
                    li.classList.remove("selected-answer");
                });

                const li = option.closest("li");
                li.classList.add("selected-answer");
            }
        });

        const items = document.querySelectorAll(".scroll-soal");

        items.forEach((item) => {
            const aksi = item.querySelector(".aksi");
            let timer;
            const showAksi = (e) => {
                console.log("mousedown");
                timer = setTimeout(() => {
                    document.querySelectorAll(".aksi").forEach(a => a.style.transform = "translateX(550px)");
                    aksi.style.transform = "translateX(0)";
                    aksi.style.display = "block";
                }, 600)
            };

            const cancel = () => clearTimeout(timer);

            // Desktop
            item.addEventListener("mousedown", showAksi);
            item.addEventListener("mouseup", cancel);
            item.addEventListener("mouseleave", cancel);

            // Mobile
            item.addEventListener("touchstart", showAksi);
            item.addEventListener("touchend", cancel);
            item.addEventListener("touchcancel", cancel);
        });

        document.addEventListener("click", function(e) {
            if (!e.target.closest(".scroll-soal")) {
                document.querySelectorAll(".aksi").forEach(div => {
                    div.style.transform = "translateX(550px)"
                    div.style.display = "none";
                });
            }
        });
    </script>

</body>

</html>