const wrap = document.querySelector(".wrap-alert");

function showAlert(pesan, path) {
  wrap.innerHTML = `
    <div class="alert">
        <p>${pesan}</p>
        <button class="btn-alert"><img src="${path}assets/button/btn-alert.png" alt=""></button>
      </div`;

  wrap.style.transform = "scale(1)";
  wrap.style.opacity = "1";
  const btn = document.querySelector(".btn-alert");
  btn.addEventListener("click", () => {
    const src = `${path}assets/button/btn-alert-onclick.png`;
    btn.querySelector("img").src = src;
    wrap.querySelector(".alert").style.animation = "slideOut 1s forwards";
    setTimeout(() => {
      wrap.style.opacity = "0";
      btn.querySelector("img").src = `${path}assets/button/btn-alert.png`;
      wrap.querySelector(".alert").style.animation = "";
      wrap.innerHTML = ``;
      wrap.style.transform = "scale(0)";
    }, 500);
  });
}
