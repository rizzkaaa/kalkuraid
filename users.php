<?php
include "db.php";

$query = mysqli_query($connect, "SELECT * FROM users");
?>

    <!DOCTYPE html>
    <html lang="en">

        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Peran</th>
            </tr>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no?></td>
                <td><?= $row['id_user']?></td>
                <td><?= $row['username']?></td>
                <td><?= $row['password']?></td>
                <td><?= $row['peran']?></td>
            </tr>
            <?php
            $no++;
    }
        ?>
        </table>
    </body>

    </html>