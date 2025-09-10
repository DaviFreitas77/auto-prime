<?php
require '../../app/middleware/auth.php';
require '../../app/controller/EmployeeController.php';
require '../components/toast.php';

use app\controller\EmployeeController;

$employeeController = new EmployeeController($conn);
$employees = $employeeController->allEmployees();

if (isset($_GET['search'])) {
    $employees = $employeeController->SearchEmployee();
}

$searchParam = isset($_GET['search']) ? "&search=" . urlencode($_GET['search']) : "";

$orderArray = [
    ["id" => "relevance", "label" => "Relevância"],
    ["id" => "alphabetical", "label" => "Ordem alfabética"],
    ["id" => "high_salary", "label" => "Maior salário"],
    ["id" => "low_salary", "label" => "Menor salário"],
];

$currentOrder = isset($_GET['order']) ? $_GET['order'] : 'relevance';

switch ($currentOrder) {
    case 'relevance':
        $employees = $employees;
        break;

    case 'alphabetical':
        usort($employees, fn($a, $b) => strcmp($a['name'], $b['name']));
        break;
    case 'high_salary':
        usort($employees, fn($a, $b) => $b['wage'] - $a['wage']);
        break;
    case 'low_salary':
        usort($employees, fn($a, $b) => $a['wage'] - $b['wage']);
        break;
}


$registros_por_pagina = 6;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$total_registros = count($employees);
$total_paginas = ceil($total_registros / $registros_por_pagina);
$pagina_atual = array_slice($employees, ($pagina - 1) * $registros_por_pagina, $registros_por_pagina);

$error = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? [];


if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
}
unset($_SESSION['success'], $_SESSION['errors']);

?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include '../../src/layout/layout.php'; ?>

<body style="font-family: 'Poppins', sans-serif;">
    <main class="flex  min-h-screen">
        <nav class="bg-teal-900 min-h-screen w-[15%] flex  flex-col items-center gap-10 justify-between">
            <section class="flex flex-col gap-4 ">
                <img src="../../public/images/dashboard/motors.png" alt="prime">
                <p class="box-border size 80  p-2 w-40 text-2xl"></p>
                <div class="flex flex-col gap-8 text-white text-lg items-center">
                    <button class="flex items-center gap-4">
                        <i class="fa-solid fa-chart-line"></i>
                        <a>Dashboard</a>
                    </button>
                    <button class="flex items-center gap-4">
                        <i class="fa-solid fa-chart-line"></i>
                        <a>Estatisticas</a>
                    </button>
                </div>
            </section>
        </nav>

        <section class="flex-col flex gap-10 p-10 w-full  items-center relative">
            <div class="flex flex-col gap-6 items-center w-full max-w-[1500px]">
                <div class="flex justify-between w-full border-b border-[#F3F4F6] p-2 items-center">
                    <h1 class="text-lg">Olá, Organize e gerencie sua equipe</h1>
                    <section class="flex gap-6 items-center">
                        <div class="flex gap-2 items-center">
                            <a href="../../app/controller/auth/LogoutController.php" class="flex items-center gap-2 text-gray-600 hover:text-teal-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                                Sair
                            </a>
                        </div>
                        <div class="flex gap-2 items-center">
                            <button type="button" id="openModal" class="flex items-center gap-2 text-gray-600 hover:text-teal-900   ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                                registrar
                            </button>
                        </div>
                    </section>
                </div>
                <form
                    method="GET"
                    class="relative w-full ">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        name="search"
                        class="outline-none border border-[#F3F4F6] rounded-sm w-full h-12 pl-10 pr-12"
                        type="text" placeholder="Pesquisar">

                    <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                        <i class="fa-solid fa-arrow-right text-gray-400"></i>
                    </button>
                </form>
                <div class="flex gap-4 w-full mt-10">

                    <?php foreach ($orderArray as $order): ?>
                        <a
                            href="?order=<?= $order['id'] ?>"
                            class="cursor-pointer hover:underline underline-offset-4 <?= $currentOrder === $order['id'] ? 'text-teal-900' : 'text-gray-300 ' ?> "><?= $order['label'] ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="grid grid-cols-8 text-base py-3 w-full border border-[#F3F4F6] rounded-sm text-center ">
                    <p class="font-medium text-teal-900">Id</p>
                    <p class="font-medium">Nome</p>
                    <p class="font-medium">Cargo</p>
                    <p class="font-medium">Salário</p>
                    <p class="font-medium">Endereço</p>
                    <p class="font-medium">Setor</p>
                    <p class="font-medium">atualizar</p>
                    <p class="font-medium">excluir</p>
                </div>

                <?php foreach ($pagina_atual as $emp): ?>
                    <div class="grid grid-cols-8 text-sm py-3 w-full border border-[#F3F4F6] rounded-sm text-center items-center">
                        <p class="text-teal-900"><?= $emp['id'] ?></p>
                        <p><?= $emp['name'] ?></p>
                        <p><?= $emp['position'] ?></p>
                        <p><?= $emp['wage'] ?></p>
                        <p class=" address"><?= $emp['address'] ?></p>
                        <p><?= $emp['sector'] ?></p>
                        <div class="text-center flex items-center justify-center">
                            <button class="bg-[#F3F4F6] w-10 h-10 flex items-center justify-center rounded-full">
                                <p class="font-medium"><i class="fa-solid fa-pencil"></i></p>
                            </button>
                        </div>
                        <div class="text-center flex items-center justify-center">
                            <a href="?action=delete&id=<?= $emp['id'] ?>" class="bg-[#F3F4F6] w-10 h-10 flex items-center justify-center rounded-full cursor-pointer">
                                <p class="font-medium"><i class="fa-solid fa-trash text-teal-900"></i></p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="flex gap-2 w-full justify-end">
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <a href="?pagina=<?= $i ?><?= $searchParam ?>"
                            class="px-3 py-1 rounded <?php echo ($i == $pagina) ? 'bg-teal-900 text-white' : 'bg-[#F3F4F6]'; ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>

                <?php if (!empty($success['message']) || !empty($error['message'])): ?>
                    <div id="divToast">
                        <?php if (!empty($success['message'])): ?>
                            <?php renderToast($success['message']); ?>
                        <?php endif; ?>

                        <?php if (!empty($error['message'])): ?>
                            <?php renderToast($error['message']); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>

            </div>

            <div class="w-full h-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-lg shadow-lg absolute bg-black  bg-black/50" id="modal">
                <div class="w-[500px] h-[450px] rounded-lg shadow-lg  bg-white top-1/2 left-1/2 transform  translate-x-2/2 translate-y-1/2 opacity-100" >
                    <div class="flex justify-end p-1">
                        <button id="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
                    </div>
                    <form class="modal-content" method="POST" action="../../app/controller/EmployeeController.php">
                        <div class="grid grid-cols-2 gap-4 p-6 ">
                            <input type="text" class="hidden" name="action" value="register">
                            <input name="name" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="name">
                            <input name="cpf" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="cpf">
                            <input name="sector" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="sector">
                            <input name="position" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="position">
                            <input name="admission_date" type="date" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="data de admissão">
                            <input name="wage" type="" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="wage">
                            <input name="address" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="endereço">
                            <input name="telephone" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="telefone">
                            <input name="email" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="e-mail">
                            <input name="photo" type="text" class="px-2 py-3 border-b border-gray-200 outline-none w-[200px]" placeholder="foto">
                            <button type="submit" class="bg-teal-900 text-white px-4 py-2 rounded cursor-pointer hover:opacity-85">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        <script src="../../public/js/modal.js"></script>
        <script src="../../public/js/dashboard.js"></script>
        <script src="../../public/js/toast.js"></script>

</body>

</html>