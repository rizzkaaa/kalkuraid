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
    <title>Integral Fungsi Rasional</title>
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
            <a href="../" class="btn-undo"><img src="../../assets/button/btn-undo.png" alt=""></a>

            <div class="nama-user">
                <p><?= $dataUser['nama_mhs'] ?></p>
            </div>
        </header>

        <div class="wrap-materi">
            <div class="pengertian">
                <h3>Pengertian</h3>
                <div class="wrap-pengertian">
                    <p>Fungsi rasional adalah fungsi yang merupakan hasil bagi dua fungsi polinomial.</p>
                    <img src="../../assets/materi/level-1/1.png" alt="">
                    <p>Apabila pangkat dari pembilang lebih besar atau
                        sama dengan pangkat dari penyebut, maka diperoleh fungsi
                        rasional tak sejati, dan jika pangkat dari penyebut lebih besar dari
                        pembilang fungsi rasional dikatakan sebagai fungsi rasional sejati</p>
                </div>
            </div>

            <div class="pengertian">
                <h3>Fungsi Rasional Tak Sejati</h3>
                <div class="wrap-pengertian">
                    <p>Jika pangkat pembilang >= penyebut, lakukan pembagian polinomial menjadi bentuk polinomial dan rasional sejati.</p>
                    <img src="../../assets/materi/level-1/2.png" alt="">
                    <ul>
                        <li>
                            <p>S(x): hasil bagi (polinomial biasa)</p>
                        </li>
                        <li>
                            <p>R(x)​: sisa pembagian dengan derajat R(x) < Q(x)</p>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="pengertian">
                <h3>Fungsi Rasional Sejati</h3>
                <div class="wrap-pengertian">
                    <p>Ada beberapa kemungkinan yang muncul dalam fungsi rasional sejati, yaitu:</p>
                    <ul>
                        <li>
                            <p>g(x) = (ax + b)(cx + d) => Bentuk Linier Tak Berulang</p>
                            <img src="../../assets/materi/level-1/3.png" alt="">
                        </li>
                        <li>
                            <p>g(x) = (ax + b) => Bentuk Linier Berulang</p>
                            <img src="../../assets/materi/level-1/4.png" alt="">
                        </li>
                        <li>
                            <p>g(x) = (ax + b)(px + qx + r) => Perkalian Bentuk Linier dan Bentuk Kuadrat</p>
                            <img src="../../assets/materi/level-1/5.png" alt="">
                        </li>
                    </ul>

                </div>
            </div>

            <div class="pengertian">
                <iframe
                    src="https://www.youtube.com/embed/ID_VIDEO"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>

                <p>Masih belum paham degan materi ini ?
                    Ayo klilk video di atas dan simak baik-baik</p>
            </div>
        </div>

</body>

</html>