<?php
include '../../db.php';

session_start();
$id_user = $_SESSION['id_user'];
$peran = $_SESSION['peran'];

if ($peran == "Mahasiswa") {
    $dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT id_mhs, nama_mhs AS nama FROM mahasiswa WHERE id_user = '$id_user'"));
} elseif ($peran == "Dosen") {
    $dataUser = mysqli_fetch_assoc(mysqli_query($connect, "SELECT id_dosen, nama_dosen AS nama FROM dosen WHERE id_user = '$id_user'"));
    $id_dosen = $dataUser['id_dosen'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kelas</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../global-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <a href="../../dashboard/dosen/" class="btn-undo"><img src="../../assets/button/btn-undo.png" alt=""></a>

            <div class="nama-user">
                <p><?= $dataUser['nama'] ?></p>
            </div>
        </header>
        <form method="POST" action="../../controller/form/handle-create-room.php" class="wrap-create">
            <div class="wrap-input-create">
                <div class="input-create">
                    <p>Nama Kelas</p>
                    <textarea maxlength="50" name="nama_room" required></textarea>
                </div>
                <div class="input-create">
                    <p>Jumlah Mahasiswa</p>
                    <input type="text" oninput="handleInput(this)" name="jumlah_peserta" maxlength="2" required>
                </div>
                <div class="input-create">
                    <p>Level</p>
                    <div class="box-level"></div>
                </div>
                <div class="input-create">
                    <p>Soal Per Level</p>
                    <div class="box-soal"></div>
                </div>
            </div>

            <ul class="select-bar hidden">
                <?php 
                $dataLevel = mysqli_query($connect, "SELECT * FROM level");
                while($rowLevel = mysqli_fetch_assoc($dataLevel)){?>
                <li data-value="<?=$rowLevel['id_level']?>">
                    <img src="../../assets/component/level-<?=$rowLevel['id_level']?>.png"> <span>LV: <?=$rowLevel['id_level']?> <?=$rowLevel['nama_level']?></span>
                </li>
                <?php }
                ?>
            </ul>

            <input type="hidden" id="jumlah-level" name="jumlah-level">
            <input type="hidden" id="id_dosen" name="<?=$peran == "Dosen" ? 'id_dosen' : ''?>" value="<?=$id_dosen?>">
            <button><img src="../../assets/button/btn-create-room.png" alt=""></button>
        </form>
    </div>

    <script>
        const levels = ['+'];
        let inputs = [];
        const selectBar = document.querySelector('.select-bar');

        updateLevel();

        function handleClick() {
            inputs.forEach((input, i) => {
                input.addEventListener("click", () => {
                    const value = input.value;
                    if (value == '+' && levels.length == 6) {
                        levels.pop();
                        selectBar.classList.toggle('hidden');
                    } else if (value == '+') {
                        selectBar.classList.toggle('hidden');
                    } else {
                        if (!levels.includes('+')) {
                            levels.push('+')
                        }
                        input.remove();
                        const removedValue = levels[i];
                        levels.splice(i, 1);
                        updateLevel();

                        const level = [...selectLevels].find(li => li.getAttribute('data-value') == removedValue);
                        level.classList.remove('hidden');
                    }
                });
            });
        }

        const selectLevels = selectBar.querySelectorAll('li');
        selectLevels.forEach(selectLevel => {
            selectLevel.addEventListener('click', () => {
                const dataValue = selectLevel.getAttribute('data-value');
                levels.unshift(dataValue);
                updateLevel();
                selectLevel.classList.add('hidden');
                selectBar.classList.add('hidden');
            });
        });

        function updateLevel() {
            const box = document.querySelector('.box-level');
            box.innerHTML = '';
            levels.forEach((level, i) => {
                box.innerHTML += `<input type="text" name="${level != '+' ? `level`+(i+1) : ''}" value="${level}" readonly>`;
            });
            updateSoalLevel();
            inputs = document.querySelectorAll('.box-level input');
            handleClick();

            if(!levels.includes('+')){
                document.getElementById('jumlah-level').value = levels.length;
            } else {
                document.getElementById('jumlah-level').value = levels.length-1;
            }
        }

        function updateSoalLevel() {
            const box = document.querySelector('.box-soal');
            box.innerHTML = '';
            levels.forEach((level, i) => {
                if (level !== '+') {
                    box.innerHTML += `<div class="wrap-soal">
                    <p>LV: ${level}</p>
                                <input type="text" name="soal-level${i+1}" oninput="handleInput(this)" maxlength="1" required>
                            </div>`;
                }
            });

        }

        function handleInput(el) {
            el.value = el.value.replace(/[^0-9]/g, '');

            if (parseInt(el.value) <= 0) {
                el.value = 1;
            }
        }
    
        const btnSubmit = document.querySelector('button');
        btnSubmit.addEventListener('click', (event) => {
            if (levels.length == 1) {
                event.preventDefault();
                return
            }
        })

    </script>
</body>

</html>