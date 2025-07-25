<?php
include '../../db.php';

session_start();
$id_user = $_SESSION['id_user'];
$dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM dosen WHERE id_user = '$id_user'"));
$id_dosen = $dataUser['id_dosen'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

</head>

<body>
    <div class="container">
        <div class="wrap-alert">
        </div>
        <header>
            <a href="" class="btn-undo"><img src="../../assets/button/btn-logout.png"></a>

            <div class="nama-user">
                <p><?= $dataUser['nama_dosen'] ?></p>
            </div>
        </header>

        <div class="btn-create">
            <img src="../../assets/button/btn-create.png">
            <a href="../../class/create-class/">
                <span>BUAT KELAS</span>
            </a>
        </div>

        <div class="list-kelas">
            <?php
            $dataClass = mysqli_query($connect, "SELECT * FROM classroom WHERE id_dosen = '$id_dosen' ORDER BY tgl_buat DESC");
            if (mysqli_num_rows($dataClass) > 0) {
                $index = 1;
                while ($rowClass = mysqli_fetch_assoc($dataClass)) {
                    $src = ($index == 1)
                        ? "../../assets/button/btn-uplist-class.png"
                        : "../../assets/button/btn-list-class.png";
            ?>
                    <div class="btn-class">
                        <img src="<?= $src ?>">
                        <a href="../../class/classroom/?id_room=<?= $rowClass['id_room'] ?>">
                            <span><?= $rowClass['nama_room'] ?></span>
                        </a>
                        <div class="aksi">
                            <div class="papan-aksi">
                                <a href="../../controller/action/copy-kelas.php?id_room=<?= $rowClass['id_room'] ?>"><i class="fa-regular fa-copy"></i></a>
                                <a href="../../class/edit-class?id_room=<?= $rowClass['id_room'] ?>"><i class="fa-solid fa-pencil"></i></a>
                                <a href="../../controller/action/hapus-kelas.php?id_room=<?= $rowClass['id_room'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                <?php $index++;
                }
            } else { ?>
                <div class="btn-class">
                    <img src="../../assets/button/btn-uplist-class.png">
                    <a href="#">
                        <span>Tidak ada kelas</span>
                    </a>
                </div>
            <?php } ?>

            <audio id="klikSound" src="../../assets/sound/sound-klik.mp3" preload="auto"></audio>
            <audio id="popSound" src="../../assets/sound/sound-pop.mp3" preload="auto"></audio>
            <audio id="bgSound" src="../../assets/sound/bg-sound.mp3" preload="auto"></audio>
        </div>

        <script src="../../script.js"></script>

        <script>
            document.addEventListener('click', () => {
                const bgSound = document.getElementById("bgSound");
                bgSound.play();
            })

            const btn = document.querySelectorAll('a');
            btn.forEach((b, i) => {
                b.addEventListener('click', (e) => {
                    if (b.parentElement.classList.contains('papan-aksi')) {
                        const pop = document.getElementById("popSound");
                        pop.currentTime = 0.5;
                        pop.play();
                        return
                    }
                    const audio = document.getElementById("klikSound");
                    audio.currentTime = 0;
                    audio.play();
                    if (i == 0) {
                        e.preventDefault();
                        const yakin = confirm('Anda yakin ingin keluar?');
                        if (yakin) {
                            window.location.href = '../../logout.php';
                        }
                    }
                })
            })

            const btnClass = document.querySelectorAll(".btn-class");
            let value = -10;

            btnClass.forEach((btn, i) => {
                if (i != 0) {
                    btn.style.transform = `translateY(${value}px)`;
                    value -= 20;
                }
            })

            const items = document.querySelectorAll(".btn-class");

            items.forEach((item) => {
                const aksi = item.querySelector(".aksi");
                let timer;
                const showAksi = (e) => {
                    timer = setTimeout(() => {
                        document.querySelectorAll(".aksi").forEach(a => a.style.transform = "translateX(550px)");
                        aksi.style.transform = "translateX(0)";
                    }, 600)
                };

                const cancel = () => clearTimeout(timer);

                // Desktop
                item.addEventListener("mousedown", showAksi);
                item.addEventListener("mouseup", cancel);
                item.addEventListener("mouseleave", cancel);

                // Mobile
                item.addEventListener("touchstart", showAksi);
                item.addEventListener("touchend", cancel);
                item.addEventListener("touchcancel", cancel);
            });

            document.addEventListener("click", function(e) {
                if (!e.target.closest(".btn-class")) {
                    document.querySelectorAll(".aksi").forEach(div => div.style.transform = "translateX(550px)");
                }
            });
        </script>
</body>

</html>