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
      <img src="../assets/component/pohon-kiri.png">
      <img src="../assets/component/pohon-kanan.png">
    </div>
    <div class="wrap">
      <a href="./daftar/"><img src="../assets/button/btn-daftar.png" /></a>
      <a href="./masuk/"><img src="../assets/button/btn-login.png" /></a>
    </div>
    <audio id="klikSound" src="../assets/sound/sound-klik-btn.mp3" preload="auto"></audio>
  </div>

  <script>
    const links = document.querySelectorAll(".wrap a");

    links.forEach(link => {
      link.addEventListener("click", (event) => {
        event.preventDefault();
        const ref = link.getAttribute('href');
        link.style.animation = "onclick 0.5s";

        const audio = document.getElementById("klikSound");
        audio.currentTime = 0;
        audio.play();

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