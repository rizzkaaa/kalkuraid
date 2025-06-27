<?php
include 'db.php';

// mysqli_query($connect, "ALTER TABLE jawaban_mhs
// ADD COLUMN id_detail_soal VARCHAR(20),
// ADD CONSTRAINT fk_detail_soal
// FOREIGN KEY (id_detail_soal)
// REFERENCES detail_soal(id_detail_soal)
// ON DELETE CASCADE
// ON UPDATE CASCADE;");

// $test = mysqli_query($connect, "DESC detail_soal");

// while ($row = mysqli_fetch_assoc($test)) {
//     echo '<pre>';
//     print_r($row);
//     echo '</pre>';
// }

mysqli_query($connect, "INSERT INTO soal (id_level, soal, opsi_1, opsi_2, opsi_3, opsi_4, jawaban) VALUES
(3, 'Daerah yang dibatasi oleh kurva y = x2 dan garis y = 4, akan dihitung luasnya menggunakan aturan rieman. Jika diambil 4 subinterval yang sama, maka luas daerah tersebut adalah', 10, 10.5, 11, 11.5, 'opsi_3'),
(3, 'Luas daerah yang dibatasi oleh kurva y = x3 dan sumbu x antara x = 0 dan x = 2 adalah', 5, 3, 10, 4, 'opsi_4'),
(3, 'Luas daerah yang dibatasi oleh kurva y = sin(x) antara x = 0 dan x = π adalah', 8, 9, 3, 2, 'opsi_4'),
(3, 'Diketahui fungsi f(x) = x2 pada interval [0,2]. Gunakan aturan rieman kanan dengan 2 partisi untuk mendekati luas di bawah kurva.', 5, 7, 9, 11, 'opsi_1'),
(3, 'Gunakan aturan rieman kanan dengan 4 partisi untuk menghitung luas di bawah kurva f(x) = x pada interval [0,4].', 15, 10, 12, 8, 'opsi_3'),
(3, 'Diberikan fungsi f(x) =  pada interval [0,4] dengan 2 partisi. Gunakan aturan rieman kiri.', 3, 30, 25, 4, 'opsi_1'),
(3, 'Diketahui f(x) = x3, interval [0,1] menggunakan aturan rieman kiri dengan 2 partisi.', 0.025, 0.0125, 0.0625, 0.0373, 'opsi_3'),
(3, 'Hitung pendekatan luas untuk f(x) = 4 - x di interval [0,4] dengan menggunakan aturan rieman tengah dan dengan 2 partisi.', 12, 8,10, 4, 'opsi_2'),
(3, 'Pendekatan luas untuk f(x) = In(x + 1) dari 0 ke 2 menggunakan rieman kiri dengan 2 partisi.', 0.68, 0.69, 1.68, 1.69, 'opsi_2'),
(3, 'Gunakan rieman kiri untuk f(x) =  dari 1 ke 4, dengan menggunakan 3 partisi.', 3.0, 3.5, 4.0, 4.5, 'opsi_3')");