<?php


require_once ROOT_DIR . 'app/helpers/authhelper.php';
require_once ROOT_DIR . 'app/views/authview.php'; 
require_once ROOT_DIR . 'app/models/usermodel.php';

class AuthController {
    
    private $view;
    private $usermodel;

    public function __construct() {
        $this->view = new authview(); 
        $this->usermodel= new usermodel();
    }

    public function showlogin($request) {
        $this->view->showlogin("", $request->user); 
    }

   
    public function authenticate($request) { 
        if(empty($_POST['email']) || empty($_POST['contraseña'])) {
            return $this->view->showLogin("Faltan datos obligatorios", $request->user);
        }

        $user_email = $_POST['email'];
        $contraseña = $_POST['contraseña'];

        $userdb = $this->usermodel->getbyemail($user_email);

        
        if($userdb && password_verify($contraseña, $userdb->contraseña)) {
            $_SESSION['USER_ID'] = $userdb->id; 
            $_SESSION['USER_NAME'] = $userdb->email; 
            $_SESSION['IS_LOGGED'] = true;
            header("Location: ".BASE_URL."listarlibros"); 
        }
        else { 
            return $this->view->showlogin("Usuario o contraseña incorrecta", $request->user);
        }
    }

    public function logout($request) {
        session_destroy();
        header("Location: ".BASE_URL."login");
        return;
    }
}

