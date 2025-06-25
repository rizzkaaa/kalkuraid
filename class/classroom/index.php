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
                <p>Rizka Layla Ramadhani</p>
            </div>
        </header>

        <div class="wrap-kelas">
            <div class="overlay"></div>
            <div class="papan-nama-kelas">
                <p class="nama-kelas">1 TRPL B Pertemuan 1 Kalkulus</p>
                <div>
                    <span>30 Peserta</span>
                    <span>JAJDADGY</span>
                </div>
            </div>
            <div class="list-peserta">
                <div class="table-peserta">
                    <div class="baris-peserta">
                        <span>Rizka Layla Ramadhani</span>
                        <span>100</span>
                    </div>
                    <div class="baris-peserta">
                        <span>Alya Zilyanti</span>
                        <span>100</span>
                    </div>
                    <div class="baris-peserta">
                        <span>Yopa Pitra Ramadhani</span>
                        <span>100</span>
                    </div>
                    <div class="baris-peserta">
                        <span>Nella Aprilia</span>
                        <span>100</span>
                    </div>
                    <div class="baris-peserta">
                        <span>Sella Allisya Salsabia</span>
                        <span>100</span>
                    </div>
                    <div class="baris-peserta">
                        <span>Sella Allisya Salsabia</span>
                        <span>100</span>
                    </div>
                    <div class="baris-peserta">
                        <span>Sella Allisya Salsabia</span>
                        <span>100</span>
                    </div>
                </div>
                <div class="btn-peta">
                    <img src="../../assets/button/btn-peta.png">
                </div>

            </div>
        </div>
    </div>

    <script>
        const btn = document.querySelector('.btn-peta');
        btn.addEventListener('click', () => {
            btn.style.transform = 'translate(10px,20px) scale(1.3)';
            document.querySelector('.overlay').style.display = 'block';
            
            setTimeout(() => {
                window.location.href = '../../game/map/';
            }, 500);
        })
    </script>
</body>

</html>