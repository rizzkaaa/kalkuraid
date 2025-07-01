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
    <title>Input Kode</title>
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
            <a href="../../dashboard/mahasiswa/" class="btn-undo"><img src="../../assets/button/btn-undo.png"></a>

            <div class="nama-user">
                <p><?= $dataMhs['nama_mhs'] ?></p>
            </div>
        </header>

        <form class="wrap-input-code" method="POST" action="../../controller/form/handle-input-code.php">
            <input type="text" name="id_room" required>
            <input type="hidden" name="id_mhs" value="<?= $id_mhs ?>">
            <button type="submit"><img src="../../assets/button/btn-masuk-room.png"></button>
        </form>
    </div>

</body>

</html>