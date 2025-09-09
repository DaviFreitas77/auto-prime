<?php
namespace utils;
class RedirectHelper
{

    public static function redirectWithError(string $message, string $errorKey = 'message', array $extra = [], string $destination = '../../../resources/view/ForgotPassword.php')
    {
        $_SESSION['errors'][$errorKey] = $message;
        foreach ($extra as $key => $value) {
            $_SESSION[$key] = $value;
        }
        header("Location: $destination");
        exit;
    }

    public static function redirectWithSuccess(string $message, string $successKey = 'message', array $extra = [],string $destination = '../../../resources/view/ForgotPassword.php')
    {
        $_SESSION['success'][$successKey] = $message;

        foreach($extra as $key =>$value){
            $_SESSION[$key] = $value;
        }
        header("Location: $destination");
        exit;
    }
}
