<?php
include '../../db.php';
if (!isset($_GET["id_room"]) || empty($_GET["id_room"])) {
    die("Error: ID tidak ditemukan.");
}

$id_room = $_GET["id_room"];
$dataClass = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM classroom WHERE id_room='$id_room'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
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
            <a href="../../dashboard/dosen/" class="btn-undo"><img src="../../assets/button/btn-undo.png" alt=""></a>

            <div class="nama-user">
                <p><?= $dataClass['nama_room'] ?></p>
            </div>
        </header>

        <div class="wrap-kelas">
            <div class="overlay"></div>
            <div class="papan-nama-kelas">
                <p class="nama-kelas"><?= $dataClass['nama_room'] ?></p>
                <div>
                    <span><?= $dataClass['jumlah_peserta'] ?> Peserta</span>
                    <span><?= $dataClass['id_room'] ?></span>
                </div>
            </div>
            <div class="list-peserta">
                <div class="table-peserta">
                    <?php
                    $dataMhs = mysqli_query($connect, "SELECT a.*, b.nama_mhs FROM detail_room a LEFT JOIN mahasiswa b ON a.id_mhs=b.id_mhs WHERE id_room='$id_room'");
                    if (mysqli_num_rows($dataMhs) > 0) {
                        while ($rowMhs = mysqli_fetch_assoc($dataMhs)) {
                    ?>
                            <div class="baris-peserta">
                                <span><?= $rowMhs['nama_mhs'] ?></span>
                                <span><?= $rowMhs['total_skor'] ?></span>
                            </div>
                    <?php
                        }
                    } else {?>
                        <div class="baris-peserta">
                            <span class="single-span">Tidak ada data</span>
                        </div>
                    <?php }
                    ?>

                </div>
                
                <div class="btn-peta">
                    <img data-id="<?=$id_room?>"  src="../../assets/button/btn-peta.png">
                </div>

            </div>
        </div>
    </div>

    <script>
        const btn = document.querySelector('.btn-peta img');
        btn.addEventListener('click', () => {
            btn.style.transform = 'scale(1.3)';
            document.querySelector('.overlay').style.display = 'block';
            const id = btn.getAttribute('data-id');
            
            setTimeout(() => {
                console.log(id);
                
                window.location.href = `../../game/map/map-evaluasi/?id_room=${id}`
            }, 500);
        }) 
    </script>
</body>

</html>