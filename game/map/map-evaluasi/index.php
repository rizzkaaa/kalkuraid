<?php
include '../../../db.php';
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
    <title>Peta Evaluasi</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <a href="../../../class/classroom/?id_room=<?= $id_room ?>" class="btn-undo"><img src="../../../assets/button/btn-undo.png"></a>

            <div class="nama-user">
                <p><?= $dataClass['nama_room'] ?></p>
            </div>
        </header>

        <div class="level-container">
            <div class="wrap-level">
                <?php
                $dataLevel = mysqli_query($connect, "SELECT * FROM detail_level WHERE id_room='$id_room' ORDER BY id_level ASC");
                $no = 1;
                while ($rowLevel = mysqli_fetch_assoc($dataLevel)) { ?>
                    <img class="road" src="../../../assets/component/to-<?= $no ?>.png">
                    <img class="level" data-id="<?= $rowLevel['id_detail_level'] ?>" src="../../../assets/component/level-<?= $rowLevel['id_level'] ?>.png">
                <?php $no++;
                }
                ?>
            </div>
        </div>
        <audio id="bgSound" src="../../../assets/sound/bg-sound.mp3" preload="auto"></audio>
        <audio id="klikSound" src="../../../assets/sound/sound-klik.mp3" preload="auto"></audio>
        <audio id="pop" src="../../../assets/sound/sound-pop.mp3" preload="auto"></audio>
        
    </div>

    <script>
        document.addEventListener('click', () => {
            const bgSound = document.getElementById("bgSound");
            bgSound.play();
        })

        const klikSound = document.getElementById("klikSound");
        const pop = document.getElementById("pop");

        document.querySelector('a').addEventListener('click', () => {
            klikSound.currentTime = 0;
            klikSound.play();
        })

        const levels = document.querySelectorAll('.level');
        levels.forEach(level => {
            level.addEventListener('click', () => {
                pop.currentTime = 0.5;
                pop.play();
                const id = level.getAttribute('data-id');
                const currentTransform = getComputedStyle(level).transform;
                level.style.transform = currentTransform + 'scale(1.3)';
                setTimeout(() => {
                    window.location.href = `../../evaluasi/?id_detail_level=${id}`;
                }, 500)
            })
        })
    </script>
</body>

</html>