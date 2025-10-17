<?php

require_once 'helpers/authhelper.php';
require_once 'views/AuthView.php'; 

class AuthController {
    
    private $view;

    public function __construct() {
        $this->view = new AuthView(); 
    }

    public function showlogin($error = null) {
        $this->view->showLogin($error);
    }

    
    public function verifylogin() {
        if (empty($_POST['user'])) || empty($_POST['password']) {
            $this->showlogin("Faltan datos de usuario o contraseña.");
            return;
        }

        $user = $_POST['user'];
        $password = $_POST['password'];

    
        if ($user === "webadmin" && $password === "admin") {
            
            session_start();
            $_SESSION['IS_LOGGED'] = true;
            $_SESSION['USER_NAME'] = $user; 
            
            header("Location: " . BASE_URL . "listarlibros"); 
            die();
        } else { //falla login
            $this->showlogin("Usuario o contraseña inválidos.");
        }
    }

}