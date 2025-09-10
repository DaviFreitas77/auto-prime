const textAdress = document.querySelector(".address");

if (textAdress) {
     let value = textAdress.textContent; 

    if (value.length > 10) {
        textAdress.textContent = value.slice(0, 20) + '...';
    }
}