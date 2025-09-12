<?php
include "../components/carousel.php";
include "../components/toast.php";
session_start();
$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? [];
$old = $_SESSION['old'] ?? [];
$errorInput = $_SESSION['errorInput'] ?? [];
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['errorInput'], $_SESSION['success']);

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
        <section class="flex  h-screen ">
            <div class="w-1/2 p-1 hidden md:block">
                <?php renderCarrosel($carousel); ?>
            </div>

            <div class="w-full p-2 md:w-1/2 flex flex-col justify-center items-center gap-6  ">
                <div class="w-full max-w-lg flex flex-col gap-2 animation transform trasnition-all duration-300 opacity-0 -translate-y-8">
                    <h1 class="font-bold text-4xl">Ei, Olá!</h1>
                    <p class="text-gray-500 font-medium">Gerencie seus funcionários de forma prática e segura.</p>

                </div>

                <form class="text-sm w-full max-w-lg flex flex-col justify-center items-center gap-6 animation transform trasnition-all duration-700 opacity-0 -translate-y-8"
                    action="../../app/controller/auth/LoginController.php" method="POST">
                    <input
                        class="border border-gray-200 outline-none px-4 w-full h-14 rounded-sm <?php echo $errorInput ? 'border-red-500' : 'border-gray-200' ?>"
                        placeholder="CPF"
                        maxlength="14"
                        type="text" name="cpf" id="cpf" value="<?= htmlspecialchars($old['cpf'] ?? '') ?>">

                    <div class="w-full">

                        <input
                            class="border  outline-none px-4 w-full h-14 rounded-sm <?php echo $errorInput ? 'border-red-500' : 'border-gray-200' ?>"
                            placeholder="Senha"
                            type="password" name="password" id="password">
                        <div class="w-full mt-1 h-5 flex justify-end items-center">
                            <?php
                            if (!empty($errors['message'])) {
                                echo '<p class="text-red-500 text-sm mr-auto font-medium">' . htmlspecialchars($errors['message']) . '</p>';
                            }
                            ?>
                            <a
                                href="./ForgotPassword.php"
                                class="text-right text-sm text-gray-600 cursor-pointer hover:underline">Esqueceu a senha?</a>
                        </div>
                    </div>

                  


                    <button
                        id="buttonForm"
                        class="w-full h-14 bg-teal-900 text-white font-bold rounded-sm hover:cursor-pointer hover:opacity-85"
                        type="submit">
                        Entrar</button>
                </form>


            </div>
              <?php if (!empty($success['message'])): ?>
                        <div id="divToast">
                            <?php renderToast($success['message']); ?>
                        </div>
                    <?php endif; ?>
        </section>
    </main>


    <script src="../../public/js/animation.js"></script>
    <script src="../../public/js/toast.js"></script>
    <script src="../../public/js/carouselLogin.js"></script>
    <script src="../../public/js/buttons.js"></script>
    <script src="../../public/js/regex.js"></script>
</body>

</html>