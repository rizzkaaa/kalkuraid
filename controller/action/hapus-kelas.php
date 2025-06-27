<?php
include '../../db.php';

if(!isset($_GET["id_room"]) || empty($_GET["id_room"])){
    die("Error: ID tidak ditemukan.");
}

$id_room = $_GET["id_room"];
$delete= "DELETE FROM classroom WHERE id_room='$id_room'";

if(mysqli_query($connect, $delete)){
    header('Location:  ../../dashboard/dosen/');
} else {
    echo "Error: " . $delete . "<br>" . mysqli_error($connect);
}
?>