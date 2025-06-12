<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Long Press Demo</title>
  <style>
    .btn-class {
      display: block;
      padding: 12px;
      background-color: #f0f0f0;
      margin-bottom: 6px;
      border-radius: 6px;
      text-decoration: none;
      color: black;
    }

    .aksi {
      display: none;
      padding: 10px;
      background-color: #e0e0e0;
      margin-bottom: 10px;
      border-left: 4px solid #007bff;
    }

    .papan-aksi a {
      margin-right: 10px;
      color: #333;
    }

    .papan-aksi i {
      font-size: 18px;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <a href="#" class="btn-class">
    <img src="https://via.placeholder.com/24" alt="">
    <span>1 TRPL B: Pertemuan 1</span>
  </a>
  <div class="aksi">
    <div class="papan-aksi">
      <a href="#"><i class="fa-regular fa-copy"></i></a>
      <a href="#"><i class="fa-solid fa-trash"></i></a>
    </div>
  </div>

  <a href="#" class="btn-class">
    <img src="https://via.placeholder.com/24" alt="">
    <span>Materi Teorema Dasar Kalkulus</span>
  </a>
  <div class="aksi">
    <div class="papan-aksi">
      <a href="#"><i class="fa-regular fa-copy"></i></a>
      <a href="#"><i class="fa-solid fa-trash"></i></a>
    </div>
  </div>

  <a href="#" class="btn-class">
    <img src="https://via.placeholder.com/24" alt="">
    <span>Tidak ada kelas</span>
  </a>
  <div class="aksi">
    <div class="papan-aksi">
      <a href="#"><i class="fa-regular fa-copy"></i></a>
      <a href="#"><i class="fa-solid fa-trash"></i></a>
    </div>
  </div>

  <script>
    const links = document.querySelectorAll(".btn-class");

    links.forEach((link) => {
      const aksi = link.nextElementSibling;
      let timer;

      const showAksi = (e) => {
        e.preventDefault();
        timer = setTimeout(() => {
          document.querySelectorAll(".aksi").forEach(div => div.style.display = "none");
          aksi.style.display = "block";
        }, 600); // long press: 600ms
      };

      const cancelTimer = () => clearTimeout(timer);

      // Desktop
      link.addEventListener("mousedown", showAksi);
      link.addEventListener("mouseup", cancelTimer);
      link.addEventListener("mouseleave", cancelTimer);

      // Mobile
      link.addEventListener("touchstart", showAksi);
      link.addEventListener("touchend", cancelTimer);
      link.addEventListener("touchcancel", cancelTimer);
    });

    document.addEventListener("click", function (e) {
      if (!e.target.closest(".btn-class") && !e.target.closest(".aksi")) {
        document.querySelectorAll(".aksi").forEach(div => div.style.display = "none");
      }
    });
  </script>

</body>
</html>
