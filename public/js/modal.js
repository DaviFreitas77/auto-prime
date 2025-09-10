const modalUpdate = document.querySelectorAll(".modalUpdate");
const isOpenModalUpdateButton = document.querySelectorAll(".openModalUpdate");

const modal = document.getElementById("modal");
const isOpenModalButton = document.getElementById("openModal");
const closeModalButton = document.getElementById("closeModal");


isOpenModalButton.addEventListener("click", () => {
  modal.style.display = "block";
});

closeModalButton.addEventListener("click", () => {
  if ((modal.style.display = "block")) {
    modal.style.display = "none";
  }
});



isOpenModalUpdateButton.forEach((btn, index) => {
  btn.addEventListener("click", () => {
    modalUpdate[index].style.display = "block";
  });
});


modalUpdate.forEach((modal) => {
  const closeModalUpdateButton = modal.querySelector(".closeModalUpdate");
  closeModalUpdateButton.addEventListener("click", () => {
    modal.style.display = "none";
  });
});