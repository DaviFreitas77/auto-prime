const cpfInput = document.getElementById("cpf");

cpfInput.addEventListener("input", () => {
  let cpf = cpfInput.value;

  // Remove tudo que não for número
  cpf = cpf.replace(/\D/g, "");

//   formata 000.000.000-00
  cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
  cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
  cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');


  cpfInput.value = cpf;
});
