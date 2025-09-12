<?php
include "../components/carousel.php";
session_start();
$cpf =   $_SESSION['cpf'] ?? [];
$errors = $_SESSION['errors'] ?? [];
$errorInput = $_SESSION['errorInput'] ?? [];
$emailSent = $_SESSION['emailSent'] ?? false;
$emailClient = $_SESSION['emailClient'] ?? false;
$codConfirmed = $_SESSION['codConfirmed'] ?? false;
$errorCod = $_SESSION['errorCod'] ?? false;
$errorNewPassword = $_SESSION['errorPassword'] ?? false;
unset($_SESSION['errors'], $_SESSION['errorInput'], $_SESSION['emailSent'], $_SESSION['codConfirmed'], $_SESSION['errorCod'], $_SESSION['errorPassword']);

if (isset($_SESSION['name'])) {
    header("Location: ./dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include '../../src/layout/layout.php'; ?>
<body style="font-family: 'Poppins', sans-serif;">
    <main class=" h-screen">
        <section class="flex  h-screen">
            <div class="w-1/2 p-1 hidden md:block">
                <?php renderCarrosel($carousel); ?>
            </div>

            <div class="w-full p-2 md:w-1/2 flex flex-col justify-center items-center gap-6  ">
                <?php if ($emailSent  || $errorCod): ?>
                    <div class="w-full max-w-lg flex flex-col gap-4">
                        <h1 class="font-medium text-2xl">Agora, digite o código que você recebeu</h1>
                        <p class="text-gray-400 font-medium max-w-[300px]">
                            O código de 4 dígitos foi enviado para
                            <span class="text-blue-500 font-bold"><?= htmlspecialchars($emailClient) ?></span>.
                        </p>
                    </div>
                    <form class="text-sm w-full max-w-lg flex flex-col justify-center items-center gap-6 animation transform trasnition-all duration-700 opacity-0 -translate-y-8"
                        action="../../routes/forgotPasswordRoutes.php" method="POST">
                        <div class="w-full max-w-lg mx-auto">
                            <input type="hidden" name="action" value="confirmCode">
                            <input
                                type="text"
                                maxlength="4"
                                class="border border-gray-200 outline-none px-4 w-full h-14 rounded-sm"
                                placeholder="Digite o código"
                                name="cod"
                                id="codigo" />
                            <?php if (!empty($errors['message'])): ?>
                                <p class="text-red-500 text-sm mr-auto font-medium">
                                    <?= htmlspecialchars($errors['message']) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <button
                        id="buttonForm"
                            class="w-full h-14 bg-teal-900 text-white font-bold rounded-sm hover:cursor-pointer hover:opacity-85"
                            type="submit">
                            Confirmar código</button>
                    </form>

                <?php elseif ($codConfirmed || $errorNewPassword): ?>
                    <div class="w-full max-w-lg flex flex-col gap-4">
                        <h1 class="font-medium text-3xl">Redefina sua senha</h1>
                        <p class="text-gray-500 font-medium">Digite uma nova senha para acessar sua conta com segurança.</p>
                    </div>

                    <form class="text-sm w-full max-w-lg flex flex-col justify-center items-center gap-6 animation transform trasnition-all duration-700 opacity-0 -translate-y-8"
                        action="../../routes/forgotPasswordRoutes.php" method="POST">
                        <div class="w-full">
                            <input type="hidden" name="cpf" value="<?= $cpf ?>">
                            <input type="hidden" name="action" value="sendNewPassword">
                            <input
                                class="border border-gray-200 outline-none px-4 w-full h-14 rounded-sm <?php echo $errorInput ? 'border-red-500' : 'border-gray-200' ?>"
                                placeholder="Nova senha"
                                type="text" name="newPassword" id="newPassword">
                            <?php if (!empty($errors['message'])): ?>
                                <p class="text-red-500 text-sm mr-auto font-medium">
                                    <?= htmlspecialchars($errors['message']) ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <button
                        id="buttonForm"
                            class="w-full h-14 bg-teal-900 text-white font-bold rounded-sm hover:cursor-pointer hover:opacity-85"
                            type="submit">
                            Redefinir</button>
                    </form>



                <?php else: ?>
                    <div class="w-full max-w-lg flex flex-col gap-4">
                        <h1 class="font-medium text-3xl">Recuperar Senha</h1>
                        <p class="text-gray-500 font-medium">Insira seu CPF para redefinir sua senha com segurança.</p>
                    </div>

                    <form class="text-sm w-full max-w-lg flex flex-col justify-center items-center gap-6 animation transform trasnition-all duration-700 opacity-0 -translate-y-8"
                        action="../../routes/forgotPasswordRoutes.php" method="POST">
                        <div class="w-full">
                            <input type="hidden" name="action" value="sendCode">
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
                            id="buttonForm"
                            class="w-full h-14 bg-teal-900 text-white font-bold rounded-sm hover:cursor-pointer hover:opacity-85"
                            type="submit">
                            Confirmar</button>
                    </form>
                <?php endif; ?>



            </div>
        </section>
    </main>


    <script src="../../public/js/animation.js"></script>
    <script src="../../public/js/buttons.js"></script>
    <script src="../../public/js/carouselLogin.js"></script>
    <script src="../../public/js/regex.js"></script>
</body>

</html>