<?php
include '../../db.php';
if (!isset($_GET["id_detail_room"]) || empty($_GET["id_detail_room"])) {
    die("Error: ID tidak ditemukan.");
}

$id_detail_room = $_GET["id_detail_room"];
$dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT a.*, b.nama_room FROM detail_room a INNER JOIN classroom b ON a.id_room=b.id_room WHERE id_detail_room='$id_detail_room'"));
$id_room = $dataClass['id_room'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Game</title>
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
            <a href="../class-list/?id_mhs=<?=$dataClass['id_mhs']?>" class="btn-undo"><img src="../../assets/button/btn-undo.png" alt=""></a>

            <div class="nama-user">
                <p><?= $dataClass['nama_room'] ?></p>
            </div>
        </header>

        <ul class="list-nilai">
            <?php 
            $dataSkor = mysqli_query($connect, "SELECT a.*, b.id_level FROM skor_level a INNER JOIN detail_level b ON a.id_detail_level=b.id_detail_level WHERE id_detail_room='$id_detail_room'");
            while($rowSkor = mysqli_fetch_assoc($dataSkor)){
            ?>
            <li>
                <span><?=$rowSkor['id_level']?></span>
                <img src="../../assets/component/level-<?=$rowSkor['id_level']?>.png" alt="">
                <div>
                    <p><?=$rowSkor['total_benar']?></p>
                    <p><?=$rowSkor['total_salah']?></p>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>