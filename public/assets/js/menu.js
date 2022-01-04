// declare une constante

const navtoto = () => {
  const btnresponsive = document.querySelector(".burger");
  // le premier element document selecteur css
  const nav = document.querySelector(".nav-links");

  const navLinks = document.querySelectorAll(".nav-links li");

  btnresponsive.addEventListener("click", () => {
    // lancer animation css

    btnresponsive.classList.toggle("active");
    nav.classList.toggle("nav-active");
  });
};

navtoto();
