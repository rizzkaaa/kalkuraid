<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menu</title>
  <link rel="stylesheet" href="./style.css" />
</head>

<body>
  <div class="container">
    <div class="wrap">
      <a href="./daftar/"><img src="../assets/image/daftar-btn.png" alt="" /></a>
      <a href="./masuk/"><img src="../assets/image/login-btn.png" alt="" /></a>
    </div>
  </div>

    <script>
      const link = document.querySelectorAll(".wrap a");

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
    </script>
</body>

</html>