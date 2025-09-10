<?php

function renderModalUpdate($arrayEmployee)
{
?>
    <div class="modalUpdate hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="w-full max-w-2xl rounded-lg shadow-2xl bg-white relative p-8 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
            <button class="closeModalUpdate absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-3xl font-bold transition-colors">&times;</button>
            <div class="flex flex-col items-center mb-6">
                <img class="w-20 h-20 rounded-full object-cover border-4 border-teal-900 shadow" src="<?= htmlspecialchars($arrayEmployee['photo'] ?? 'https://via.placeholder.com/150') ?>" alt="Foto do funcionário">
                <h2 class="mt-4 text-xl font-semibold text-teal-900">Atualizar Funcionário</h2>
            </div>
            <form class="modal-content" method="POST" action="../../app/controller/EmployeeController.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= htmlspecialchars($arrayEmployee['id']) ?>">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <input name="name" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Nome" value="<?= htmlspecialchars($arrayEmployee['name'] ?? '') ?>" required>
                    <input name="cpf" maxlength="14" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="CPF" value="<?= htmlspecialchars($arrayEmployee['cpf'] ?? '') ?>" required>
                    <input name="sector" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Setor" value="<?= htmlspecialchars($arrayEmployee['sector'] ?? '') ?>" required>
                    <input name="position" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Cargo" value="<?= htmlspecialchars($arrayEmployee['position'] ?? '') ?>" required>
                    <input name="admission_date" type="date" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Data de admissão" value="<?= htmlspecialchars($arrayEmployee['admission_date'] ?? '') ?>" required>
                    <input name="wage" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Salário" value="<?= htmlspecialchars($arrayEmployee['wage'] ?? '') ?>" required>
                    <input name="address" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Endereço" value="<?= htmlspecialchars($arrayEmployee['address'] ?? '') ?>" required>
                    <input name="telephone" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="Telefone" value="<?= htmlspecialchars($arrayEmployee['telephone'] ?? '') ?>" required>
                    <input name="email" type="email" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none" placeholder="E-mail" value="<?= htmlspecialchars($arrayEmployee['email'] ?? '') ?>" required>
                    <input name="photo" type="text" class="px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-teal-900 outline-none col-span-1 md:col-span-3" placeholder="URL da foto" value="<?= htmlspecialchars($arrayEmployee['photo'] ?? '') ?>">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-teal-900 hover:bg-teal-800 transition-colors text-white px-6 py-2 rounded font-semibold shadow">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>