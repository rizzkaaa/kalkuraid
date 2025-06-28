<?php
include '../../db.php';
if (!isset($_GET["id_detail_level"]) || empty($_GET["id_detail_level"])) {
    die("Error: ID tidak ditemukan.");
}

$id_detail_level = $_GET["id_detail_level"];
$dataLevel = mysqli_fetch_assoc(mysqli_query($connect, "SELECT a.id_room, b.* FROM detail_level a INNER JOIN level b ON a.id_level=b.id_level WHERE a.id_detail_level='$id_detail_level'"));

$id_room = $dataLevel['id_room'];
$dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM classroom WHERE id_room='$id_room'"));
// var_dump();

// $dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM detail_soal WHERE id_detail_level='$id_detail_level'"));
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
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <a href="../map/map-evaluasi/?id_room=<?= $id_room ?>" class="btn-undo"><img src="../../assets/button/btn-undo.png" alt=""></a>

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
                $dataSoal = mysqli_query($connect, "SELECT a.id_detail_soal, b.* FROM detail_soal a INNER JOIN soal b ON a.id_soal=b.id_soal WHERE id_detail_level='$id_detail_level'");
                $no = 0;
                while ($rowSoal = mysqli_fetch_assoc($dataSoal)) {
                    $no++;
                ?>
                    <div class="swipe-soal">
                        <div class="scroll-soal">
                            <div class="card-soal soal-<?= $no % 2 == 0 ? 'brown' : 'green' ?>">
                                <div class="wrap-soal">
                                    <div class="no-soal">
                                        <p>Soal <?= $no ?></p>
                                    </div>
                                    <div class="soal">
                                        <?php if (isset($rowSoal['soal_img'])) { ?>
                                            <img src="../../assets/soal/<?= $rowSoal['soal_img'] ?>" alt="">
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
                                                <p><span>&#10004;</span></p><input type="radio" value="<?= $opsi['label'] ?>" name="jawaban<?= $no ?>" class="opsi" id="soal<?= $no . '-' . $opsi['label'] ?>" <?= $rowSoal['jawaban'] == $opsi['label'] ? 'checked' : '' ?> disabled><span><?= $opsi['isi'] ?></span>
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
                                        $id_detail_soal = $rowSoal['id_detail_soal'];
                                        $dataJawaban = mysqli_query($connect, "SELECT a.*, c.nama_mhs  FROM jawaban_mhs a INNER JOIN detail_room b ON a.id_detail_room=b.id_detail_room INNER JOIN mahasiswa c ON b.id_mhs=c.id_mhs WHERE id_detail_soal='$id_detail_soal'");
                                        if (mysqli_num_rows($dataJawaban) > 0) {
                                            while ($rowJawaban = mysqli_fetch_assoc($dataJawaban)) { ?>
                                                <div class="rows">
                                                    <div class="data-rows"><span><?= $rowJawaban['nama_mhs'] ?></span></div>
                                                    <div class="garis"></div>
                                                    <div class="data-rows">
                                                        <?php
                                                        for ($i = 1; $i <= 4; $i++) { ?>
                                                            <span>
                                                                <?php if ($rowJawaban['jawaban'] == 'opsi_'.$i) {
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

                <!-- <div class="swipe-soal">
                    <div class="scroll-soal">
                        <div class="card-soal soal-brown">
                            <div class="wrap-soal">
                                <div class="no-soal">
                                    <p>Soal 1</p>
                                </div>
                                <div class="soal">
                                    <img src="../../assets/soal/contoh-soal.png" alt="">
                                    <p>Hitunglah nilai dari gambar di atas ...</p>
                                </div>
                            </div>
                            <ul class="wrap-opsi">
                                <li><label for="soal2-opsi1">
                                        <p><span>&#10004;</span></p><input type="radio" name="jawaban2" class="opsi" id="soal2-opsi1"><span>ln∣x+2∣−ln∣x+1∣+C</span>
                                    </label></li>
                                <li><label for="soal2-opsi2">
                                        <p><span>&#10004;</span></p><input type="radio" name="jawaban2" class="opsi" id="soal2-opsi2"><span>ln∣x+2∣−ln∣x+1∣+C</span>
                                    </label></li>
                                <li><label for="soal2-opsi3">
                                        <p><span>&#10004;</span></p><input type="radio" name="jawaban2" class="opsi" id="soal2-opsi3"><span>ln∣x+2∣−ln∣x+1∣+C</span>
                                    </label></li>
                                <li><label for="soal2-opsi4">
                                        <p><span>&#10004;</span></p><input type="radio" name="jawaban2" class="opsi" id="soal2-opsi4"><span>ln∣x+2∣−ln∣x+1∣+C</span>
                                    </label></li>
                            </ul>
                            <div class="wrap-jawaban">
                                <label for="soal2">Lihat Jawaban</label>
                            </div>
                        </div>

                        <input type="checkbox" class="toggle-nilai" id="soal2">
                        <div class="card-nilai nilai-brown">
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
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="data-rows"><span>Rizka Layla Ramadhani</span></div>
                                        <div class="garis"></div>
                                        <div class="data-rows">
                                            <span>x</span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                            <div class="garis"></div>

                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->
            </div>
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
    </script>

</body>

</html>