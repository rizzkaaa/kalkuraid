<?php
include '../../../db.php';
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
    <title>Peta Game</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="nama-user">
                <p><?= $dataClass['nama_room'] ?></p>
            </div>
        </header>

        <div class="level-container">
            <input type="hidden" id="id_detail_room" value="<?= $id_detail_room ?>">
            <div class="wrap-level">
                <?php
                $dataLevel = mysqli_query($connect, "SELECT * FROM detail_level WHERE id_room='$id_room' ORDER BY id_level ASC");
                $no = 1;
                $prev_skor_ada = true;

                while ($rowLevel = mysqli_fetch_assoc($dataLevel)) {
                    $id_detail_level = $rowLevel['id_detail_level'];
                    $dataSkor = mysqli_query($connect, "SELECT * FROM skor_level WHERE id_detail_level='$id_detail_level' AND id_detail_room='$id_detail_room'");
                    $rowSkor = mysqli_fetch_assoc($dataSkor);
                    $skor_ada = mysqli_num_rows($dataSkor) > 0;

                    $level_sudah_dikerjakan = isset($rowSkor['skor_mhs']) && $rowSkor['skor_mhs'] != NULL;
                    $is_disabled = !$prev_skor_ada;

                ?>
                    <img class="road" src="../../../assets/component/to-<?= $no ?>.png">

                    <img
                        class="level <?= $is_disabled ? 'disabled' : '' ?>"
                        data-id="<?=$rowLevel['id_detail_level']?>"
                        next-step="<?=$level_sudah_dikerjakan?>"
                        src="../../../assets/component/level-<?= $rowLevel['id_level'] ?>.png">

                    <div class="lock <?= $is_disabled ? '' : 'hidden' ?>">
                        <img class="lock-animation" src="../../../assets/component/gembok.png" alt="">
                    </div>

                <?php
                    $prev_skor_ada = $skor_ada;
                    $no++;
                }
                ?>
            </div>

        </div>
    </div>

    <script>
        const levels = document.querySelectorAll('.level');
        levels.forEach(level => {
            level.addEventListener('click', () => {
                const nextStep = level.getAttribute('next-step');
                console.log(nextStep);
                const id_detail_level = level.getAttribute('data-id');
                const id_detail_room = document.getElementById('id_detail_room').value;

                const currentTransform = getComputedStyle(level).transform;
                level.style.transform = currentTransform + 'scale(1.3)';
                setTimeout(() => {
                    if (nextStep == 1) {
                        window.location.href = `../../after-game/check/?id_detail_level=${id_detail_level}&&id_detail_room=${id_detail_room}`;
                    } else {
                        window.location.href = `../../play/?id_detail_level=${id_detail_level}&&id_detail_room=${id_detail_room}`;
                    }
                }, 500)
            })
        })

        const locks = document.querySelectorAll('.lock');
        locks.forEach(lock => {
            lock.addEventListener('click', () => {
                const img = lock.querySelector('img');
                img.classList.remove('lock-animation');
                void img.offsetWidth;
                img.classList.add('lock-animation');
            })
        })
    </script>
</body>

</html>