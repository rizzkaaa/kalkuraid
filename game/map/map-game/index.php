<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Permainan</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <a href="../../../class/classroom/" class="btn-undo"><img src="../../../assets/button/btn-undo.png" alt=""></a>

            <div class="nama-user">
                <p>Rizka Layla Ramadhani</p>
            </div>
        </header>

        <div class="level-container">
            <div class="wrap-level">
                <img class="road" src="../../../assets/component/to-1.png">
                <img class="level" src="../../../assets/component/level-1.png">
                <img class="road" src="../../../assets/component/to-2.png">
                <img class="level" src="../../../assets/component/level-2.png">
                <img class="road" src="../../../assets/component/to-3.png">
                <img class="level" src="../../../assets/component/level-3.png">
                <img class="road" src="../../../assets/component/to-4.png">
                <img class="level" src="../../../assets/component/level-4.png">
                <img class="road" src="../../../assets/component/to-5.png">
                <img class="level" src="../../../assets/component/level-5.png">
                <img class="road" src="../../../assets/component/to-6.png">
                <img class="level" src="../../../assets/component/level-6.png">

            </div>
        </div>
    </div>

    <script>
        const levels = document.querySelectorAll('.level');
        levels.forEach(level => {
            level.addEventListener('click', () => {
                const currentTransform = getComputedStyle(level).transform;
                level.style.transform = currentTransform + 'scale(1.3)';
                setTimeout(() => {
                    window.location.href = '../evaluasi/';
                }, 500)
            })
        })
    </script>
</body>

</html>