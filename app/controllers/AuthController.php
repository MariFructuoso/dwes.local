<?php
namespace dwes\app\controllers;

use dwes\core\App;
use dwes\core\Response;
use dwes\core\helpers\FlashMessage;
use dwes\app\repository\UsuarioRepository;
use dwes\app\exceptions\ValidationException;

class AuthController
{
    public function login()
    {
        $errores = FlashMessage::get('login-error', []);
        $username = FlashMessage::get('username');
        Response::renderView('login', 'layout', compact('errores', 'username'));
    }

    public function checkLogin()
    {
        try {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }
            
            FlashMessage::set('username', $_POST['username']);

            // Buscamos el usuario en la BBDD
            $usuario = App::getRepository(UsuarioRepository::class)->findOneBy([
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ]);

            if (!is_null($usuario)) {
                // LOGIN CORRECTO: Guardamos ID en sesión y redirigimos
                $_SESSION['loguedUser'] = $usuario->getId();
                FlashMessage::unset('username');
                App::get('router')->redirect(''); // A la home
            }
            
            throw new ValidationException('El usuario y el password introducidos no existen');

        } catch (ValidationException $e) {
            FlashMessage::set('login-error', [$e->getMessage()]);
            App::get('router')->redirect('login');
        }
    }

    public function logout()
    {
        if (isset($_SESSION['loguedUser'])) {
            unset($_SESSION['loguedUser']);
        }
        App::get('router')->redirect('login');
    }
}