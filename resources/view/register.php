<?php
session_start();
$message = $_SESSION['message'] ?? '';
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['message'], $_SESSION['old']);

if(isset($_SESSION['name'])){
   header("Location: ./dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>

<body>
    <h1>Formulário de Cadastro</h1>

    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form action="../../app/controller/auth/registerController.php" method="POST">

    <input type="text" name="nome" placeholder="Nome" value="<?= htmlspecialchars($old['name'] ?? '') ?>"><br>
    <span style="color:red;"><?= $errors['name'] ?? '' ?></span><br>

    <input type="text" name="cpf" placeholder="CPF" value="<?= htmlspecialchars($old['cpf'] ?? '') ?>"><br>
    <span style="color:red;"><?= $errors['cpf'] ?? '' ?></span><br>

    <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"><br>
    <span style="color:red;"><?= $errors['email'] ?? '' ?></span><br>

    <input type="password" name="password" placeholder="Senha"><br>
    <span style="color:red;"><?= $errors['password'] ?? '' ?></span><br>

    <button type="submit">Cadastrar</button>
</form>
</body>

</html>