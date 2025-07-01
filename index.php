<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KALKURAID</title>
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="./global-style.css" />
</head>

<body>
  <div class="container">
    <div class="button loading"></div>

  </div>
  <audio id="klikSound" src="./assets/sound/sound-klik-play.mp3" preload="auto"></audio>

  <script>
    const button = document.querySelector(".container");
    setTimeout(() => {
      button.innerHTML = `<a href="cekSesi.php" class=""><div class="button button-play"></div></a>`;
      const link = document.querySelector(".container a");
      link.addEventListener("click", (event) => {
        event.preventDefault();

        link.style.animation = "fadeOut 1.5s";
        const audio = document.getElementById("klikSound");
        audio.currentTime = 0; 
        audio.play();

        setTimeout(() => {
          window.location.href = "cekSesi.php";
        }, 600);
      });
    }, 4500);
  </script>
</body>

</html>