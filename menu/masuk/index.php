<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../../global-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="wrap-alert">
        </div>
        <a href="../" class="btn-undo"><img src="../../assets/button/btn-undo.png"></a>

        <form method="POST" action="./proses-masuk.php">
            <input type="text" autocomplete="off" name="username" id="username" required>
            <input type="text" autocomplete="off" name="password" id="password" required>
            <button class="btn"><img src="../../assets/button/btn-masuk.png"></button>
        </form>
        <audio id="klikSoundUnik" src="../../assets/sound/sound-klik-btn.mp3" preload="auto"></audio>
        <audio id="klikSound" src="../../assets/sound/sound-klik.mp3" preload="auto"></audio>

    </div>

    <script src="../../script.js"></script>

    <?php if (isset($_GET['pesan'])) { ?>

        <script>
            showAlert('Username atau password salah', '../../')
        </script>
    <?php } ?>

    <script>
        const button = document.querySelector(".btn");
        const form = document.querySelector("form");
        const username = document.getElementById("username");
        const password = document.getElementById("password");
        const audioUnik = document.getElementById("klikSoundUnik");
        const audio = document.getElementById("klikSound");


        button.addEventListener("click", (event) => {
            event.preventDefault();

            if (username.value == "" || password.value == "") {
                showAlert('Silakan isi username dan password anda', '../../');
                return
            }

            audioUnik.currentTime = 0;
            audioUnik.play();
            button.style.animation = "onclick 1s";
            setTimeout(() => {
                form.submit();
            }, 900);
        });

        document.querySelector('.btn-undo').addEventListener('click', () => {
            audio.currentTime = 0;
            audio.play();
        })
    </script>
</body>

</html>