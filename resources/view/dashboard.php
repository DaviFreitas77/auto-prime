<?php
require '../../app/middleware/auth.php';
require '../../app/controller/EmployeeController.php';
require '../components/toast.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use app\controller\EmployeeController;
$employeeController = new EmployeeController($conn);
$employees = $employeeController->allEmployees();

$registros_por_pagina = 6;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$total_registros = count($employees);
$total_paginas = ceil($total_registros / $registros_por_pagina);
$pagina_atual = array_slice($employees, ($pagina - 1) * $registros_por_pagina, $registros_por_pagina);

$success = $_SESSION['success'] ?? [];

if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
} 
unset($_SESSION['success']);

?>
<!DOCTYPE html>
<html lang="en">
<?php include '../../src/layout/layout.php'; ?>

<body style="font-family: 'Poppins', sans-serif;">
    <main class="flex  min-h-screen">
        <nav class="bg-teal-900 min-h-screen w-[15%] flex  flex-col items-center gap-10 justify-between">
            <div class="flex flex-col gap-4 ">
                <img src="../../public/images/dashboard/motors.png" alt="prime">
                <p class="box-border size 80  p-2 w-40 text-2xl"></p>
                <div class="flex flex-col gap-8 text-white text-xl items-center">
                    <button class="flex items-center gap-4">
                        <i class="fa-solid fa-chart-line"></i>
                        <a>Dashboard</a>
                    </button>
                    <button class="flex items-center gap-4">
                        <i class="fa-solid fa-chart-line"></i>
                        <a>Estatisticas</a>
                    </button>
                </div>
            </div>
            <div class="flex text-xs gap-6 ">

            </div>
        </nav>

        <section class="flex-col flex gap-10 p-10 w-full  items-center">
            <div class="flex flex-col gap-6 items-center w-full max-w-[1500px]">
                <div class="flex justify-between w-full bg-white">
                    <div>
                        <h1 class="text-4xl font-medium">Funcionários</h1>
                        <p>5 funcionários encontrados</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <button class="bg-[#F3F4F6] w-10 h-10 flex items-center justify-center rounded-full">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <button class="bg-[#F3F4F6] w-10 h-10 flex items-center justify-center rounded-full">
                            <i class="fa-regular fa-bell"></i>
                        </button>

                    </div>
                </div>
                <div class="grid grid-cols-8 text-lg py-3 w-full bg-[#F3F4F6] rounded-sm text-center mt-10">
                    <p class="font-bold text-teal-900">Id</p>
                    <p class="font-medium">Nome</p>
                    <p class="font-medium">Cargo</p>
                    <p class="font-medium">Salário</p>
                    <p class="font-medium">Endereço</p>
                    <p class="font-medium">Data/admissão</p>
                    <p class="font-medium">atualizar</p>
                    <p class="font-medium">excluir</p>
                </div>

                <?php foreach ($pagina_atual as $emp): ?>
                    <div class="grid grid-cols-8 text-lg py-3 w-full border border-[#F3F4F6] rounded-sm text-center items-center">
                        <p class="font-bold text-teal-900"><?= $emp['id'] ?></p>
                        <p ><?= $emp['name'] ?></p>
                        <p ><?= $emp['position'] ?></p>
                        <p ><?= $emp['wage'] ?></p>
                        <p class=" address"><?= $emp['address'] ?></p>
                        <p ><?= $emp['admission_date'] ?></p>
                        <div class="text-center flex items-center justify-center">
                            <button class="bg-[#F3F4F6] w-10 h-10 flex items-center justify-center rounded-full">
                                <p class="font-medium"><i class="fa-solid fa-pencil"></i></p>
                            </button>
                        </div>
                        <div class="text-center flex items-center justify-center">
                            <a href="?action=delete&id=<?= $emp['id'] ?>" class="bg-[#F3F4F6] w-10 h-10 flex items-center justify-center rounded-full cursor-pointer">
                                <p class="font-medium"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="w-full flex justify-between items-center">
                    <p class="underline text-gray-400">
                        <?= count($pagina_atual) ?> resultados de <?= $total_registros ?>
                    </p>
                    <div class="flex gap-2">
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <a href="?pagina=<?= $i ?>"
                                class="px-3 py-1 rounded <?php echo ($i == $pagina) ? 'bg-teal-900 text-white' : 'bg-[#F3F4F6]'; ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                </div>

                <?php if (!empty($success['message'])): ?>
                    <div id="divToast">
                        <?php renderToast($success['message']); ?>
                    </div>
                <?php endif; ?>

            </div>
        </section>


        <script src="../../public/js/dashboard.js"></script>
        <script src="../../public/js/toast.js"></script>
        
</body>

</html>