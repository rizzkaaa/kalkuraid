<?php
include '../../db.php';
session_start();
if (!isset($_GET["id_detail_level"]) || empty($_GET["id_detail_level"])) {
    die("Error: ID tidak ditemukan.");
}

$id_user = $_SESSION['id_user'];
$dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM dosen WHERE id_user = '$id_user'"));

$id_detail_level = $_GET["id_detail_level"];
$dataLevel = mysqli_fetch_assoc(mysqli_query($connect, "SELECT a.*, b.nama_level FROM detail_level a INNER JOIN level b ON a.id_level=b.id_level WHERE id_detail_level='$id_detail_level'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Soal</title>
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
            <div class="nama-user">
                <p><?= $dataUser['nama_dosen'] ?></p>
            </div>
        </header>

        <div class="papan-judul">
            <h2>LV <?= $dataLevel['id_level'] . " - " . $dataLevel['nama_level'] ?></h2>
        </div>
        <form method="POST" enctype="multipart/form-data" action="../../controller/form/handle-input-soal.php" class="card-soal soal-green">
            <input type="hidden" name="id_detail_level" value="<?= $id_detail_level ?>">
            <div class="wrap-soal">
                <div class="no-soal">
                    <p>Soal</p>
                </div>
                <div class="soal">
                    <img src="" id="preview-soal">
                    <label for="soal_img"><img src="../../assets/component/icon-input.svg"></label>
                    <input type="file" id="soal_img" name="soal_img">
                    <div class="garis-soal"></div>
                    <input type="text" name="soal" required>
                </div>
            </div>
            <ul class="wrap-opsi">
                <?php
                for ($i = 1; $i < 5; $i++) {

                ?>
                    <li><label for="opsi_<?= $i ?>-jawaban">
                            <p>
                                <span>&#10004;</span>
                            </p>
                            <input type="radio" value="opsi_<?= $i ?>" name="jawaban" class="opsi" id="opsi_<?= $i ?>-jawaban">
                            <span>
                                <input type="text" name="opsi_<?= $i ?>" id="opsi_<?= $i ?>" required>
                                <img src="" id="preview-opsi<?= $i ?>">
                            </span>
                            <label for="opsi_<?= $i ?>-img" id="label-opsi_<?= $i ?>-img"><img src="../../assets/component/icon-input.svg"></label>
                            <input type="file" name="opsi_<?= $i ?>-img" id="opsi_<?= $i ?>-img">
                        </label></li>
                <?php } ?>

            </ul>

            <button>Simpan</button>
        </form>
    </div>

    <script>
        const inputFoto = document.getElementById('soal_img');
        const preview = document.getElementById('preview-soal');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });

        for (let i = 1; i < 5; i++) {
            const inputText = document.getElementById(`opsi_${i}`);
            const inputFile = document.getElementById(`opsi_${i}-img`);
            const preview = document.getElementById(`preview-opsi${i}`);
            const label = document.getElementById(`label-opsi_${i}-img`);

            inputText.addEventListener('input', () => {
                if (inputText.value.trim() !== '') {
                    inputFile.disabled;
                    label.style.display = 'none';
                } else {
                    !inputFile.disabled;
                    label.style.display = 'flex';
                }
            });

            inputFile.addEventListener('change', function() {
                inputText.style.display = 'none';
                inputText.disabled = this.files.length > 0;

                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });
        }

        const options = document.querySelectorAll(".opsi");

        options.forEach(option => {
            option.addEventListener("change", () => {
                if (option.checked) {
                    const btn = document.querySelector('button').style.display = 'block';
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