<?php
include '../../db.php';
if (!isset($_GET["id_room"]) || empty($_GET["id_room"])) {
    die("Error: ID tidak ditemukan.");
}

$id_room = $_GET["id_room"];
$dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM classroom WHERE id_room='$id_room'"));
$dataDetailLevel = mysqli_query($connect, "SELECT * FROM detail_level WHERE id_room='$id_room'");

$detailLevels = [];
while ($row = mysqli_fetch_assoc($dataDetailLevel)) {
    $detailLevels[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
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
            <a href="../../dashboard/dosen/" class="btn-undo"><img src="../../assets/button/btn-undo.png"></a>

            <div class="nama-user">
                <p><?= $dataClass['nama_room'] ?></p>
            </div>
        </header>
        <form method="POST" action="../../controller/form/handle-edit-room.php" class="wrap-create">
            <div class="wrap-input-create">
                <div class="input-create">
                    <p>Nama Kelas</p>
                    <textarea maxlength="50" name="nama_room" required><?= $dataClass['nama_room'] ?></textarea>
                </div>
                <div class="input-create">
                    <p>Jumlah Mahasiswa</p>
                    <input type="text" oninput="handleInput(this)" value="<?= $dataClass['jumlah_peserta'] ?>" name="jumlah_peserta" maxlength="2" required>
                </div>
                <div class="input-create">
                    <p>Level</p>
                    <div class="box-level">
                        <?php foreach ($detailLevels as $rowDetail) { ?>
                            <input type="text" value="<?= $rowDetail['id_level'] ?>" readonly>
                        <?php } ?>
                    </div>
                </div>
                <div class="input-create">
                    <p>Soal Per Level</p>
                    <div class="box-soal">
                        <?php foreach ($detailLevels as $rowDetail1) { ?>
                            <div class="wrap-soal">
                                <p>LV: <?= $rowDetail1['id_level'] ?></p>
                                <input type="text" value="<?= $rowDetail1['jumlah_soal'] ?>" readonly>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id_room" value="<?= $id_room ?>">
            <button><img src="../../assets/button/btn-create-room.png"></button>
        </form>
        <audio id="klikSound" src="../../assets/sound/sound-klik.mp3" preload="auto"></audio>
        <audio id="bgSound" src="../../assets/sound/bg-sound.mp3" preload="auto"></audio>

    </div>

    <script>
        document.addEventListener('click', () => {
            const bgSound = document.getElementById("bgSound");
            bgSound.play();
        })
        const audio = document.getElementById("klikSound");
        document.querySelector('a').addEventListener('click', () => {
            audio.currentTime = 0;
            audio.play();
        })

        document.querySelector('button').addEventListener('click', () => {
            audio.currentTime = 0;
            audio.play();
        })

        function handleInput(el) {
            el.value = el.value.replace(/[^0-9]/g, '');

            if (parseInt(el.value) <= 0) {
                el.value = 1;
            }
        }
    </script>
</body>

</html>