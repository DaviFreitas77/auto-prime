const cpfInput = document.getElementById("cpf");
const wageInput = document.getElementById("wage");
const telephoneInput = document.getElementById("telephone");

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



// Formatar salário
wageInput.addEventListener("input", () => {
  let wage = wageInput.value;

  // Remove tudo que não for número
  wage = wage.replace(/\D/g, "");

  // Formata para o padrão 1.234,56
  wage = (parseFloat(wage) / 100).toFixed(2) + '';
  wage = wage.replace('.', ',');
  wage = wage.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

  wageInput.value = wage;
});


telephoneInput.addEventListener("input", () => {
  let tel = telephoneInput.value;

  tel = tel.replace(/\D/g, "");

  if (tel.length > 10) {
    tel = tel.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (tel.length > 6) {
    tel = tel.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (tel.length > 2) {
    tel = tel.replace(/^(\d{2})(\d{0,5})/, "($1) $2");
  } else {
    tel = tel.replace(/^(\d*)/, "($1");
  }

  telephoneInput.value = tel;
});