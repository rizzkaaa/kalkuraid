<?php
// $id_user = $_SESSION['id_user'];

// if (isset($id_user)) {
//   echo 'oke';
//   $dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE id_user = '$id_user'"));
//   $role = $dataUser['peran'];
//   if ($role == "Mahasiswa") {
//     header("location: ../../dashboard/mahasiswa/");
//   } elseif ($role == "Dosen") {
//     header("location: ../../dashboard/dosen/");
//   } else {
//     echo "Peran tidak dikenali.";
//   }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menu</title>
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="../global-style.css" />
</head>

<body>
  <div class="container">
    <div class="coconut-tree">
      <img src="../assets/component/pohon-kiri.png" alt="">
      <img src="../assets/component/pohon-kanan.png" alt="">
    </div>
    <div class="wrap">
      <a href="./daftar/"><img src="../assets/button/btn-daftar.png" alt="" /></a>
      <a href="./masuk/"><img src="../assets/button/btn-login.png" alt="" /></a>
    </div>
  </div>

  <script>
    const links = document.querySelectorAll(".wrap a");

    links.forEach(link => {
      link.addEventListener("click", (event) => {
        event.preventDefault();
        const ref = link.getAttribute('href');
        link.style.animation = "onclick 0.5s";

        const trees = document.querySelectorAll(".coconut-tree img");
        trees.forEach((tree, i) => {
          tree.style.animation = `back${i+1} 1s`;
        })
        setTimeout(() => {
          window.location.href = ref;
        }, 500);
      });

    })
  </script>
</body>

</html>