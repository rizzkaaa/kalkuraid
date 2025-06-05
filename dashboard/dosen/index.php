<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Dashboard Dosen</h1>
    <h3>Selamat Datang? <?= $_SESSION['id_user']?></h3>
</body>
</html>