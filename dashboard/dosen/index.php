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

</head>

<body>
    <div class="container">
        <div class="nama-user">
            <p>Rizka Layla Ramadhani</p>
        </div>

        <a href="../../class/create-class/" class="btn-create">
            <img src="../../assets/button/btn-create.png" alt="">
            <span>BUAT KELAS</span>
        </a>

        <div class="list-kelas">
            <a href="../../class/classroom/" class="btn-class">
                <img src="../../assets/button/btn-uplist-class.png" alt="">
                <span>1 TRPL B: Pertemuan 1</span>
            </a>
            <div class="aksi">
                <div class="papan-aksi">
                    <a href=""><i class="fa-regular fa-copy"></i></a>
                    <a href=""><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            <a href="../../class/classroom/" class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <span>Materi Teorema Dasar Kalkulus dan Luas Kurva dengan Teori Rienmann</span>
            </a>
            <div class="aksi">
                <div class="papan-aksi">
                    <a href=""><i class="fa-regular fa-copy"></i></a>
                    <a href=""><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            <a href="../../class/classroom/" class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <span>Tidak ada kelas</span>
            </a>
            <div class="aksi">
                <div class="papan-aksi">
                    <a href=""><i class="fa-regular fa-copy"></i></a>
                    <a href=""><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            <a href="../../class/classroom/" class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <span>Tidak ada kelas</span>
            </a>
            <div class="aksi">
                <div class="papan-aksi">
                    <a href=""><i class="fa-regular fa-copy"></i></a>
                    <a href=""><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            <a href="../../class/classroom/" class="btn-class">
                <img src="../../assets/button/btn-list-class.png" alt="">
                <span>Tidak ada kelas</span>
            </a>
            <div class="aksi">
                <div class="papan-aksi">
                    <a href=""><i class="fa-regular fa-copy"></i></a>
                    <a href=""><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
        
        </div>
    </div>

    <script>
        const btnClass = document.querySelectorAll(".btn-class");
        let value = -10;

        btnClass.forEach((btn, i) => {
            if(i != 0){
                btn.style.transform = `translateY(${value}px)`;
                value -= 20;
            }
        })
    </script>
</body>

</html>