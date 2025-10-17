<?php

require_once 'helpers/authhelper.php';
require_once 'views/AuthView.php'; 
require_once 'models/adminmodel.php';

class AuthController {
    
    private $view;
    private $adminmodel;

    public function __construct() {
        $this->view = new AuthView(); 
        $this->adminmodel= new adminmodel();
    }

    public function showlogin($error = null) {
        $this->view->showLogin($error);
    }

    
    public function verifylogin() {
        
        if (empty($_POST['email'])) || empty($_POST['password']) {
            $this->showlogin("Faltan datos de usuario o contraseña.");
            return;
        }

        $user = $_POST['email'];
        $password = $_POST['password'];

        $admindb=$this->adminmodel->getuserbyemail($user);

    
        if ($admindb && password_verify($password,$admindb->contraseña)) {
            AuthHelper::startsession();
            $_SESSION['IS_LOGGED'] = true;
            $_SESSION['USER_NAME'] = $user; 
            
            header("Location: " . BASE_URL . "listarlibros"); 
            die();
        } else { //falla login
            $this->showlogin("Usuario o contraseña inválidos.");
        }
    }

}