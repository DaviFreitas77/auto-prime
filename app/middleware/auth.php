<?php

session_start();

if (!isset($_SESSION['name'])) {
    $_SESSION['errors']['message'] = "Você precisa estar logado para acessar esta página.";
    header("Location: login.php");
    exit;
}
