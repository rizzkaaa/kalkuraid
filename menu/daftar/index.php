<?php
include '../../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar</title>
  <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../../global-style.css" />
</head>

<body>

  <div class="container">
    <div class="coconut-tree">
      <img src="../../assets/image/pohon-kiri.png" alt="">
      <img src="../../assets/image/pohon-kanan.png" alt="">
    </div>
    <form action="proses-daftar.php" method="POST">
      <div class="container-wrap">
        <div class="wrap-peran">
          <input type="radio" id="peran-mhs" name="peran" value="mahasiswa">
          <label for="peran-mhs"><img src="../../assets/image/mhs-btn.png" alt=""></label>
          <input type="radio" id="peran-dosen" name="peran" value="dosen">
          <label for="peran-dosen"><img src="../../assets/image/dosen-btn.png" alt=""></label>
        </div>

        <a href="../" class="btn-undo">undo</a>
      </div>

      <div class="wrap-input-data" id="mahasiswa">
        <div class="btn-undo">undo</div>
        <div class="input-data">
          <input type="text" name="nama_mhs" id="nama_mhs">
          <input type="text" name="npm" id="npm">
          <input type="text" name="univ_mhs" id="univ_mhs">
          <div class="btn"><img src="../../assets/image/btn-lanjut.png" alt=""></div>
        </div>
      </div>

      <div class="wrap-input-data" id="dosen">
        <div class="btn-undo">undo</div>
        <div class="input-data">
          <input type="text" name="nama_dosen" id="nama_dosen">
          <input type="text" name="nip" id="nip">
          <input type="text" name="univ_dosen" id="univ_dosen">
          <div class="btn"><img src="../../assets/image/btn-lanjut.png" alt=""></div>
        </div>
      </div>

      <div class="wrap-input-data" id="pw">
        <div class="btn-undo">undo</div>
        <div class="input-data">
          <input type="text" name="username" id="username" readonly>
          <input type="text" name="password" id="password">
          <div class="btn"><img src="../../assets/image/btn-simpan.png" alt=""></div>
        </div>
      </div>
    </form>
  </div>


  <script>

    const labels = document.querySelectorAll(".wrap-peran label");
    const trees = document.querySelectorAll(".coconut-tree img");
    const form = document.querySelector('form');
    const mhs = document.getElementById("mahasiswa");
    const dosen = document.getElementById("dosen");
    const pw = document.getElementById("pw");
    const btnNext = document.querySelectorAll(".btn");

    trees.forEach((tree, i) => {
      tree.style.animation = `slide${i+1} 1s`;
    })
    labels.forEach((label, i) => {
      label.addEventListener("click", () => {
        label.style.animation = "onclick 0.5s";
        let val = 0;

        if (i == 0) {
          mhs.style.display = 'flex';
        } else {
          dosen.style.display = 'flex';
        }

        setTimeout(() => {
          trees.forEach((tree, j) => {
            if (j == 0) {
              val = -220;
            } else {
              val = 220;
            }
            tree.style.animation = "";
            tree.style.transform = `translateX(${val}px)`;
          })
          form.style.transform = 'translateY(-1150px)';
        }, 600);

      });

    })

    btnNext.forEach((btn, i) => {
      btn.addEventListener("click", () => {
        if (i == 0) {
          const namaMhs = document.getElementById("nama_mhs").value;
          const npm = document.getElementById("npm").value;
          const univMhs = document.getElementById("univ_mhs").value;

          if (namaMhs == "" || npm == '' || univMhs == "") {
            console.log("Mahasiswa fail");
            return;
          }

          console.log(namaMhs, npm, univMhs);

        }
        else if (i == 1) {
          const namaDosen = document.getElementById("nama_dosen").value;
          const nip = document.getElementById("nip").value;
          const univDosen = document.getElementById("univ_dosen").value;

          if (namaDosen == "" || nip == '' || univDosen == "") {
            console.log("Dosen fail");
            return;
          }
          console.log("Dosen done");

        }
        else {
          const username = document.getElementById("username").value;
          const password = document.getElementById("password").value;

          if (username == "" || password == '') {
            console.log("Password fail");
            return;
          }
          console.log("Password done");
          btn.style.animation = "onclick 0.5s";
          setTimeout(() => {
            form.submit();
          }, 700);

        }

        btn.style.animation = "onclick 0.5s";
        setTimeout(() => {
          pw.style.display = 'flex';
          form.style.transform = "translateY(-2200px)";
        }, 700);

      })
    })

    const btnUndo = document.querySelectorAll(".btn-undo");
    btnUndo.forEach((btn, i) => {
      btn.addEventListener('click', () => {
        if (i == 2) {
          document.getElementById("username").value = "";
          document.getElementById("password").value = "";

          btnNext.forEach((btnN, i) => {
            btnN.style.animation = "";
          })
          form.style.transform = 'translateY(-1150px)';
          setTimeout(() => {
            pw.style.display = 'none';
          }, 1000);
        } else {
          document.getElementById("nama_mhs").value = "";
          document.getElementById("npm").value = "";
          document.getElementById("univ_mhs").value = "";
          document.getElementById("nama_dosen").value = "";
          document.getElementById("nip").value = "";
          document.getElementById("univ_dosen").value = "";


          labels.forEach(label => {
            label.style.animation = "";
          })
          form.style.transform = 'translateY(-230px)';
          trees.forEach(tree => {
            tree.style.transform = `translate(0)`;
          })

          setTimeout(() => {
            mhs.style.display = 'none';
            dosen.style.display = 'none';
          }, 1000);

        }
      })
    })

    document.getElementById("npm").addEventListener("input", (e) => {
      document.getElementById("username").value = e.target.value
    })
    document.getElementById("nama_dosen").addEventListener("input", (e) => {
      generateUsn(e.target.value)
    })

    function generateUsn(target) {
      const nama = [...target].filter(char => char !== ' ');
      const namaAcak = shuffleArray(nama)

      const huruf = namaAcak.slice(0, 4);
      const angka = Math.floor(Math.random() * 90) + 10;

      const id = huruf.join("") + angka;
      document.getElementById("username").value = id;
      console.log(id);

    }

    function shuffleArray(array) {
      for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
      }
      return array;
    }

  </script>
</body>

</html>