<?php
include '../../db.php';

session_start();
$id_user = $_SESSION['id_user'];
$dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM mahasiswa WHERE id_user = '$id_user'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
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
            <a href="../../logout.php" class="btn-undo"><img src="../../assets/button/btn-logout.png"></a>

            <div class="nama-user">
                <p><?= $dataUser['nama_mhs'] ?></p>
            </div>
        </header>

        <div class="list-btn">
            <a href="../../class/input-kode/?id_mhs=<?= $dataUser['id_mhs'] ?>">INPUT KODE</a>
            <a href="../../materi/">MATERI</a>
            <a href="../../class/class-list/?id_mhs=<?= $dataUser['id_mhs'] ?>">KELAS</a>
        </div>
    </div>

</body>

</html>