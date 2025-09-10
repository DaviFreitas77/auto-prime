const divToast = document.getElementById("divToast");
if (divToast) {
  setTimeout(() => {
    divToast.style.transition = "opacity 0.5s ease";
    divToast.style.opacity = "0";
  }, 3000);

  setTimeout(() => {
    divToast.remove();
  }, 3500);
}
