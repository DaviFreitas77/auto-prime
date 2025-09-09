const form = document.querySelector("form");
const button = document.getElementById("buttonForm");

form.addEventListener("submit", () => {
    button.textContent = "Carregando...";
    button.disabled = true;

});