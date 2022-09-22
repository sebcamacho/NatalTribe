
const navbar = () => {
  const btnresponsive = document.querySelector(".burger");
  const nav = document.querySelector(".nav-links");
  const navLinks = document.querySelectorAll(".nav-links li");

  btnresponsive.addEventListener("click", () => {
    btnresponsive.classList.toggle("active");
    nav.classList.toggle("nav-active");
  });
};

navbar();
