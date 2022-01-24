

let cours = document.querySelector("#reservation_cours");

cours.addEventListener("change", function () {
  let form = this.closest("form");
  let data = this.name + "=" + this.value;

  fetch(form.action, {
    method: form.getAttribute("method"),
    body: data,
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset:utf-8",
    },
  })
    .then((response) => response.text()).then((html) => {
      let content = document.createElement("html");
      content.innerHTML = html;
      let nouveauSelect = content.querySelector("#reservation_creneau");
      document.querySelector("#reservation_creneau").replaceWith(nouveauSelect);
    })
    .catch((error) => {
      console.log(error);
    });
});
