<?php
namespace routes;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../database.php';

use app\controller\auth\ForgotPasswordController;

$controller = new ForgotPasswordController($conn);

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'sendCode') {
        $controller->forgotPassword();
    }
    if ($_POST['action'] === 'sendNewPassword') {
        $controller->changePassword();
    }

    if ($_POST['action'] === 'confirmCode') {
        $controller->ConfirmedCod();
    }
}
