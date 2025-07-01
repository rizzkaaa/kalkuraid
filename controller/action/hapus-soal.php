<?php
include '../../db.php';

if(!isset($_GET["id_detail_soal"]) || empty($_GET["id_detail_soal"])){
    die("Error: ID tidak ditemukan.");
}

$id_detail_soal = $_GET["id_detail_soal"];
$delete= "DELETE FROM detail_soal WHERE id_detail_soal='$id_detail_soal'";

if(mysqli_query($connect, $delete)){
    header('Location:  ../../game/evaluasi/?id_detail_level='.$_GET['id_detail_level']);
} else {
    echo "Error: " . $delete . "<br>" . mysqli_error($connect);
}
?>