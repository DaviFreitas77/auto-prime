<?php
require '../../../vendor/autoload.php';
use utils\RedirectHelper;


class LogoutController
{
    public function logout()
    {
        session_start();
        session_destroy();
        RedirectHelper::redirectWithSuccess("Você saiu do sistema.","message",[],"../../../resources/view/login.php");
        header("Location: ../../../resources/view/login.php");
        exit();
    }
}

$controller = new LogoutController();
$controller->logout();
