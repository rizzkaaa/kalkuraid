
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

    <script>
      const button = document.querySelector(".container");
      setTimeout(() => {
        button.innerHTML = `<a href="./menu/" class=""><div class="button button-play"></div></a>`;
        const link = document.querySelector(".container a");
        link.addEventListener("click", (event) => {
            event.preventDefault();
          link.style.animation = "fadeOut 1.5s";
          setTimeout(() => {
            window.location.href = "./menu/";
          }, 1300);
        });
      }, 4500);
    </script>
  </body>
</html>
