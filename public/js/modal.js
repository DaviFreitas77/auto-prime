const modal = document.getElementById("modal");
const isOpenModalButton = document.getElementById("openModal");
const closeModalButton = document.getElementById("closeModal")

if (modal) {
    modal.style.display = "none";
}

isOpenModalButton.addEventListener("click",()=>{
     modal.style.display = "block";
})

closeModalButton.addEventListener("click",()=>{
       if(modal.style.display = "block"){
        modal.style.display = "none";
       }  
})