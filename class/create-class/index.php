<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Classroom</title>
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
                <p>Rizka Layla Ramadhani</p>
            </div>
        </header>
        <form class="wrap-create">
            <div class="wrap-input-create">
                <div class="input-create">
                    <p>Nama Kelas</p>
                    <textarea maxlength="50"></textarea>
                </div>
                <div class="input-create">
                    <p>Jumlah Mahasiswa</p>
                    <input type="text" maxlength="2">
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
                <li data-value="1">
                    <img src="../../assets/component/level-1.png"> <span>LV: 1 Integral Fungsi Rasional</span>
                </li>
                <li data-value="2">
                    <img src="../../assets/component/level-1.png"> <span>LV: 1 Teorema Dasar Kalkulus</span>
                </li>
                <li data-value="3">
                    <img src="../../assets/component/level-1.png"> <span>LV: 1 Teorema Dasar Kalkulus</span>
                </li>
                <li data-value="4">
                    <img src="../../assets/component/level-1.png"> <span>LV: 1 Teorema Dasar Kalkulus</span>
                </li>
                <li data-value="5">
                    <img src="../../assets/component/level-1.png"> <span>LV: 1 Teorema Dasar Kalkulus</span>
                </li>
                <li data-value="6">
                    <img src="../../assets/component/level-1.png"> <span>LV: 1 Teorema Dasar Kalkulus</span>
                </li>
            </ul>

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
                        if(!levels.includes('+')){
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
            levels.forEach(level => {
                box.innerHTML += `<input type="text" value="${level}" readonly>`;
            });
            updateSoalLevel();
            inputs = document.querySelectorAll('.box-level input');
            handleClick();
            console.log(levels);
        }
        
        function updateSoalLevel() {
            const box = document.querySelector('.box-soal');
            box.innerHTML = '';
            levels.forEach(level => {
                if(level !== '+'){
                    box.innerHTML += `<div class="wrap-soal">
                    <p>LV: ${level}</p>
                                <input type="text" maxlength="1">
                            </div>`;
                }
            });
            
        }
    </script>
</body>

</html>