<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar</title>
  <link rel="stylesheet" href="./style.css" />
</head>

<body>

  <div action="POST" class="container">
    <form action="">
      <div class="wrap-peran">
        <input type="radio" name="peran" id="mhs" value="mahasiswa">
        <label for="mhs"><img src="../../assets/image/mhs-btn.png" alt=""></label>
        <input type="radio" name="peran" id="dosen" value="dosen">
        <label for="dosen"><img src="../../assets/image/dosen-btn.png" alt=""></label>
      </div>
  
      <div class="wrap-input-data" id="mahasiswa">
          <input type="text" name="nama_mhs" id="nama_mhs">
          <input type="text" name="nim" id="nim">
          <input type="text" name="univ" id="univ">
          <div class="btn"><img src="../../assets/image/btn-lanjut.png" alt=""></div>
        </div>
      </div>

    </form>
  </d>

  <!--<script>
      const link = document.querySelectorAll(".container a");

      link.forEach(l => {
          l.addEventListener("click", (event) => {
            event.preventDefault();
            const ref = l.getAttribute('href');
            l.style.animation = "onclick 0.5s";
            setTimeout(() => {
              window.location.href = ref;
            }, 500);
          });

      })
    </script> -->
</body>

</html>