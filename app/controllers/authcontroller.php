<?php


require_once 'views/AuthView.php'; // Necesitarás una vista para el formulario

class AuthController {
    
    private $view;

    public function __construct() {
        $this->view = new AuthView(); 
    }

    public function showLogin($error = null) {
        $this->view->showLogin($error);
    }

    
    public function verifyLogin() {
        if (empty($_POST['user']) || empty($_POST['password'])) {
            $this->showLogin("Faltan datos de usuario o contraseña.");
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
            $this->showLogin("Usuario o contraseña inválidos.");
        }
    }

