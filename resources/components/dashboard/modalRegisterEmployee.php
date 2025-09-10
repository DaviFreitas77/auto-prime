<?php

function renderModal()
{
?>
    <div class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50" id="modal">
        <div class="w-full max-w-2xl rounded-lg shadow-2xl bg-white relative p-8 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
            <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-3xl font-bold transition-colors">&times;</button>
            <div class="flex flex-col items-center mb-6">
                <img class="w-20 h-20 rounded-full object-cover border-4 border-teal-900 shadow" src="https://via.placeholder.com/150" alt="Foto do funcionário">
                <h2 class="mt-4 text-xl font-semibold text-teal-900">Cadastrar Funcionário</h2>
            </div>
            <form class="modal-content" method="POST" action="../../app/controller/EmployeeController.php">
                <input type="hidden" name="action" value="register">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <input name="name" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Nome" required>
                    <input name="cpf" maxlength="14" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="CPF" required>
                    <input name="sector" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Setor" required>
                    <input name="position" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Cargo" required>
                    <input name="admission_date" type="date" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Data de admissão" required>
                    <input name="wage" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Salário" required>
                    <input name="address" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Endereço" required>
                    <input name="telephone" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Telefone" required>
                    <input name="email" type="email" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="E-mail" required>
                    <input name="photo" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none md:col-span-2" placeholder="URL da foto">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-teal-900 hover:bg-teal-800 transition-colors text-white px-6 py-2 rounded font-semibold shadow">Registrar</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>