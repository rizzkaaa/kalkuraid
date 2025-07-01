<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../../global-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <a href="../" class="btn-undo"><img src="../../assets/button/btn-undo.png"></a>

        <form method="POST" action="./proses-masuk.php">
            <input type="text" name="username" id="username" required>
            <input type="text" name="password" id="password" required>
            <button class="btn"><img src="../../assets/button/btn-masuk.png"></button>
        </form>
    </div>

    <script>
        const button = document.querySelector(".btn");
        const form = document.querySelector("form");
        const username = document.getElementById("username");
        const password = document.getElementById("password");

        button.addEventListener("click", (event) => {
            event.preventDefault();

            if (username.value == "" || password.value == "") {
                return
            }

            button.style.animation = "onclick 1s";
            setTimeout(() => {
                form.submit();
            }, 900);
        });
    </script>
</body>

</html>