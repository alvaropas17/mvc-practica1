// ===== Menú: cambiar vistas =====
const tabs = document.querySelectorAll(".tab");

let formModificar = document.getElementById("formModificar");

const btnModificar = document.getElementsByClassName("btn-modificar");
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
// // ===== Carrusel: JS SOLO PARA EL MOVIMIENTO =====
const slidesContainer = document.querySelector(".slides");
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");
const totalSlides = slides.length;

// Solo ejecutar si el carrusel existe
if (slidesContainer && totalSlides > 0) {
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
  const nextBtn = document.getElementById("next");
  const prevBtn = document.getElementById("prev");
  if (nextBtn) nextBtn.addEventListener("click", nextSlide);
  if (prevBtn) prevBtn.addEventListener("click", prevSlide);

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
  const carousel = document.querySelector(".carousel");
  if (carousel) {
    carousel.addEventListener("mouseenter", stopAuto);
    carousel.addEventListener("mouseleave", startAuto);
  }

  // Iniciar
  updateCarousel();
  startAuto();
}

// ===== Mostrar/ocultar formulario de crear usuario =====
const btnCrearForm = document.getElementById("btnCrearForm");
const formCrearUsuario = document.getElementById("formCrearUsuario");

if (btnCrearForm && formCrearUsuario) {
  btnCrearForm.addEventListener("click", function () {
    console.log("Pulsado el botón de crear formulario");
    if (formCrearUsuario.style.display === "none" || formCrearUsuario.style.display === "") {
      formCrearUsuario.style.display = "block";
      btnCrearForm.textContent = "Ocultar formulario";
    } else {
      formCrearUsuario.style.display = "none";
      btnCrearForm.textContent = "Crear usuario";
    }
  });
}



// Función para cerrar el formulario de modificación
function cerrarFormulario() {
  formModificar = document.getElementById('formModificar');
  if (formModificar.style.display == "block") {
    formModificar.style.display = 'none';
    // formModificar.innerHTML = '';
  } else if (formModificar.style.display == "none") {
    formModificar.style.display = 'block';
  }
}

// Función para activar el selector de archivos
function activarSelectorImagen(inputId) {
  const fileInput = document.getElementById(inputId);
  if (fileInput) {
    fileInput.click();
  }
}



