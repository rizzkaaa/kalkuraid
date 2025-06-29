<?php
session_start();
include '../../db.php';

if (!isset($_GET["id_mhs"]) || empty($_GET["id_mhs"])) {
    die("Error: ID tidak ditemukan.");
}

$id_mhs = $_GET["id_mhs"];
$dataMhs = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM mahasiswa WHERE id_mhs = '$id_mhs'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
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
            <a href="../../dashboard/mahasiswa/" class="btn-undo"><img src="../../assets/button/btn-undo.png" alt=""></a>

            <div class="nama-user">
                <p><?=$dataMhs['nama_mhs']?></p>
            </div>
        </header>

        <div class="btn-create">
            <img src="../../assets/button/btn-create.png" alt="">
            <a href="../../class/create-class/">
                <span>KUSTOM ROOM</span>
            </a>
        </div>

        <div class="list-kelas">
            <?php
            $dataClass = mysqli_query($connect, "SELECT a.*, b.nama_room FROM detail_room a INNER JOIN classroom b ON a.id_room=b.id_room WHERE id_mhs = '$id_mhs' ORDER BY tgl_join DESC");
            if (mysqli_num_rows($dataClass) > 0) {
                $index = 1;
                while ($rowClass = mysqli_fetch_assoc($dataClass)) {
                    $src = ($index == 1)
                        ? "../../assets/button/btn-uplist-class.png"
                        : "../../assets/button/btn-list-class.png";
            ?>
                    <div class="btn-class">
                        <img src="<?= $src ?>" alt="">
                        <a href="../report-game/?id_detail_room=<?= $rowClass['id_detail_room'] ?>">
                            <span><?= $rowClass['nama_room'] ?></span>
                        </a>
                    </div>
                <?php $index++;
                }
            } else { ?>
                <div class="btn-class">
                    <img src="../../assets/button/btn-uplist-class.png" alt="">
                    <a href="../../class/classroom/">
                        <span>Tidak ada kelas</span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        const btnClass = document.querySelectorAll(".btn-class");
        let value = -10;

        btnClass.forEach((btn, i) => {
            if (i != 0) {
                btn.style.transform = `translateY(${value}px)`;
                value -= 20;
            }
        })

       
    </script>
</body>

</html>