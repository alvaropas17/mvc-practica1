// ===== Menú: cambiar vistas =====
const tabs = document.querySelectorAll(".tab");
/* const sections = {
  adopcion: document.getElementById("view-adopcion"),
  login: document.getElementById("view-login"),
  contacto: document.getElementById("view-contacto"),
};

tabs.forEach((tab) => {
  tab.addEventListener("click", (e) => {
    e.preventDefault();
    tabs.forEach((t) => t.classList.remove("active"));
    tab.classList.add("active");
    const vista = tab.dataset.view;
    Object.keys(sections).forEach((k) => {
      if (sections[k]) {
        sections[k].style.display = k === vista ? "block" : "none";
      }
    });
    if (vista === "adopcion") startAuto();
    else stopAuto();
  });
});
*/
// ===== Carrusel: JS SOLO PARA EL MOVIMIENTO =====
const slidesContainer = document.querySelector(".slides");
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");
const totalSlides = slides.length;

let index = 0;
let autoTimer = null;

function updateCarousel() {
  slidesContainer.style.transform = `translateX(-${index * 100}%)`;
  dots.forEach((d, i) => d.classList.toggle("active", i === index));
}

function nextSlide() {
  index = (index + 1) % totalSlides;
  updateCarousel();
}

function prevSlide() {
  index = (index - 1 + totalSlides) % totalSlides;
  updateCarousel();
}

// Botones
document.getElementById("next").addEventListener("click", nextSlide);
document.getElementById("prev").addEventListener("click", prevSlide);

// Dots
dots.forEach((dot, i) => {
  dot.addEventListener("click", () => {
    index = i;
    updateCarousel();
  });
});

// Autoplay
function startAuto() {
  if (autoTimer) return;
  autoTimer = setInterval(nextSlide, 4000);
}

function stopAuto() {
  clearInterval(autoTimer);
  autoTimer = null;
}

// Pausa al pasar el ratón
document.querySelector(".carousel").addEventListener("mouseenter", stopAuto);
document.querySelector(".carousel").addEventListener("mouseleave", startAuto);

// Iniciar
updateCarousel();
startAuto();

document.addEventListener("DOMContentLoaded", function (e) {
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      const loginMsg = document.getElementById("loginMsg");

      fetch("index.php?action=login", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            window.location.href = "index.php?action=usuarios";
          } else {
            loginMsg.textContent =
              data.message || "Usuario o contraseña incorrecta";
          }
        })
        .catch((error) => {
          loginMsg.textContent = "Error al iniciar sesión";
        });
    });
  }
});
