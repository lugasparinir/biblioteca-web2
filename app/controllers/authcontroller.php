<?php

require_once 'app/helpers/authhelper.php';
require_once 'app/views/authview.php'; 
require_once 'app/models/adminmodel.php';

class AuthController {
    
    private $view;
    private $adminmodel;

    public function __construct() {
        $this->view = new authview(); 
        $this->adminmodel= new adminmodel();
    }

    
     public function showlogin($request) {
        $this->view->showlogin("", $request->user); 
    }

    public function verifylogin($request) {
        if(empty($_POST['email']) || empty($_POST['contraseña'])) {
            return $this->view->showLogin("Faltan datos obligatorios", $request->user);
        }

        $user = $_POST['email'];
        $contraseña = $_POST['contraseña'];

        $admindb = $this->adminmodel->getbyemail($user);

      if($admindb && password_verify($contraseña, $admindb->contraseña)) {
        $_SESSION['USER_ID'] = $admindb->id; 
        $_SESSION['USER_NAME'] = $admindb->email; // almacena el email para el header
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

