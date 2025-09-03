<?php
include "../components/carousel.php";
    
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$errorInput = $_SESSION['errorInput'] ?? [];
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['errorInput']);

if (isset($_SESSION['name'])) {
    header("Location: ./dashboard.php");
    exit;
}
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
                <div class="w-full max-w-lg flex flex-col gap-2">
                    <h1 class="font-bold text-4xl">Ei, Olá!</h1>
                    <p class="text-gray-500 font-medium">Faça suas transações com segurança.</p>
                </div>

                <form class="text-sm w-full max-w-lg flex flex-col justify-center items-center gap-6"
                    action="../../app/controller/auth/LoginController.php" method="POST">

                    <a href="#" class="w-full h-14 flex items-center justify-center gap-3 border border-gray-300 rounded-sm text-gray-700 font-medium hover:bg-gray-50">
                        <svg class="w-5 h-5" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                            <path fill="none" d="M0 0h48v48H0z"></path>
                        </svg>
                        <span>Entrar com Google</span>
                    </a>

                    <div class="flex items-center w-full">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="flex-shrink mx-4 text-gray-400 text-sm">OU</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>
                    <input
                        class="border border-gray-200 outline-none px-4 w-full h-14 rounded-sm <?php echo $errorInput ? 'border-red-500' : 'border-gray-200' ?>"
                        placeholder="CPF"
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
                            <p class="text-right text-sm text-gray-600 cursor-pointer hover:underline">Esqueceu a senha?</p>
                        </div>
                    </div>


                    <button
                        class="w-full h-14 bg-black text-white font-bold rounded-sm hover:cursor-pointer hover:opacity-85"
                        type="submit">
                        Entrar</button>
                </form>


            </div>
        </section>
    </main>


    <script src="../src/js/carouselLogin.js"></script>
</body>

</html>