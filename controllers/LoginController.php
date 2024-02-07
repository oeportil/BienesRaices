<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin(0, $_POST['email'], $_POST['password']);

            $errores = $auth->validar();

            if (empty($errores)) {
                //verificar si el usuario existe
                $resultado = $auth->existeUsuario();
                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    //verificar password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        //autenticar Usuario
                        $auth->autenticar();
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}
