<?php
session_start()
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
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

</head>

<body>
    <div class="container">
        <div class="nama-user">
            <p>Rizka Layla Ramadhani</p>
        </div>

        <div class="btn-create">
            <img src="../../assets/button/btn-create.png" alt="">
            <a href="../../class/create-class/">
                <span>BUAT KELAS</span>
            </a>
        </div>

        <div class="list-kelas">
            <div class="btn-class">
                <img src="../../assets/button/btn-uplist-class.png" alt="">
                <a href="../../class/classroom/">
                    <span>1 TRPL B: Pertemuan 1</span>
                </a>
                <div class="aksi">
                    <div class="papan-aksi">
                        <a href="#"><i class="fa-regular fa-copy"></i></a>
                        <a href="#"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <a href="../../class/classroom/">
                    <span>Materi Teorema Dasar Kalkulus dan Luas Kurva dengan Teori Rienmann</span>
                </a>
                <div class="aksi">
                    <div class="papan-aksi">
                        <a href=""><i class="fa-regular fa-copy"></i></a>
                        <a href=""><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <a href="../../class/classroom/">
                    <span>Tidak ada kelas</span>
                </a>
                <div class="aksi">
                    <div class="papan-aksi">
                        <a href=""><i class="fa-regular fa-copy"></i></a>
                        <a href=""><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <a href="../../class/classroom/">
                    <span>Tidak ada kelas</span>
                </a>
                <div class="aksi">
                    <div class="papan-aksi">
                        <a href=""><i class="fa-regular fa-copy"></i></a>
                        <a href=""><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <a href="../../class/classroom/">
                    <span>Tidak ada kelas</span>
                </a>
                <div class="aksi">
                    <div class="papan-aksi">
                        <a href=""><i class="fa-regular fa-copy"></i></a>
                        <a href=""><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <a href="../../class/classroom/">
                    <span>Tidak ada kelas</span>
                </a>
                <div class="aksi">
                    <div class="papan-aksi">
                        <a href="#"><i class="fa-regular fa-copy"></i></a>
                        <a href="#"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
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

        const items = document.querySelectorAll(".btn-class");

        items.forEach((item) => {
            const aksi = item.querySelector(".aksi .papan-aksi");
            let timer;
            const showAksi = (e) => {
                // e.preventDefault();
                console.log("mousedown");

                timer = setTimeout(() => {
                    console.log("jalan");

                    document.querySelectorAll(".aksi .papan-aksi").forEach(a => a.style.transform = "translateX(550px)");
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
                document.querySelectorAll(".aksi .papan-aksi").forEach(div => div.style.transform = "translateX(550px)");
            }
        });
    </script>
</body>

</html>