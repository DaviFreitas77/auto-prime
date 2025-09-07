<?php
include "../components/carousel.php";
session_start();
$errors = $_SESSION['errors'] ?? [];
$errorInput = $_SESSION['errorInput'] ?? [];
$emailSent = $_SESSION['emailSent'] ?? false;
$emailClient = $_SESSION['emailClient'] ?? false;
unset($_SESSION['errors'], $_SESSION['errorInput'], $_SESSION['emailSent']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../src//css/pagination.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <title>Login</title>
</head>

<body>
    <main class=" h-screen">
        <section class="flex  h-screen">
            <div class="w-1/2 p-1 hidden md:block">
                <?php renderCarrosel($carousel); ?>
            </div>

            <div class="w-full p-2 md:w-1/2 flex flex-col justify-center items-center gap-6  ">
                <?php if ($emailSent): ?>
                    <div class="w-full max-w-lg flex flex-col gap-4">
                        <h1 class="font-medium text-2xl">Agora, digite o código que você recebeu</h1>
                        <p class="text-gray-400 font-medium max-w-[300px]">
                            O código de 4 dígitos foi enviado para
                            <span class="text-blue-500 font-bold"><?= htmlspecialchars($emailClient) ?></span>.
                        </p>
                    </div>
                    <form class="text-sm w-full max-w-lg flex flex-col justify-center items-center gap-6"
                        action="../../app/controller/auth/ForgotPasswordController.php" method="POST">
                        <div class="w-full max-w-lg mx-auto">
                            <input
                                type="text"
                                maxlength="4"
                                class="border border-gray-200 outline-none px-4 w-full h-14 rounded-sm"
                                placeholder="Digite o código"
                                name="codigo"
                                id="codigo" />
                        </div>
                        <button
                            class="w-full h-14 bg-black text-white font-bold rounded-sm hover:cursor-pointer hover:opacity-85"
                            type="submit">
                            Confirmar código</button>
                    </form>

                <?php else: ?>
                    <div class="w-full max-w-lg flex flex-col gap-4">
                        <h1 class="font-medium text-3xl">Recuperar Senha</h1>
                        <p class="text-gray-500 font-medium">Insira seu CPF para redefinir sua senha com segurança.</p>
                    </div>

                    <form class="text-sm w-full max-w-lg flex flex-col justify-center items-center gap-6"
                        action="../../app/controller/auth/ForgotPasswordController.php" method="POST">
                        <div class="w-full">
                            <input
                                class="border border-gray-200 outline-none px-4 w-full h-14 rounded-sm <?php echo $errorInput ? 'border-red-500' : 'border-gray-200' ?>"
                                placeholder="CPF"
                                maxlength="14"
                                type="text" name="cpf" id="cpf">
                            <?php if (!empty($errors['message'])): ?>
                                <p class="text-red-500 text-sm mr-auto font-medium">
                                    <?= htmlspecialchars($errors['message']) ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <button
                            class="w-full h-14 bg-black text-white font-bold rounded-sm hover:cursor-pointer hover:opacity-85"
                            type="submit">
                            Entrar</button>
                    </form>
                <?php endif; ?>



            </div>
        </section>
    </main>


    <script src="../../public/js/carouselLogin.js"></script>
    <script src="../../public/js/regex.js"></script>
</body>

</html>