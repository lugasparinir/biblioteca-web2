<?php

require_once 'helpers/authhelper.php';
require_once 'views/authview.php'; 
require_once 'models/adminmodel.php';

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

    public function verifyogin($request) {
        if(empty($_POST['email']) || empty($_POST['contraseña'])) {
            return $this->view->showLogin("Faltan datos obligatorios", $request->user);
        }

        $user = $_POST['email'];
        $contraseña = $_POST['contraseña'];

        $admindb = $this->adminmodel->getbyemail($user);

        if($admindb && password_verify($contraseña, $admindb->contraseña)) {
            $_SESSION['ADMIN_ID'] = $userFromDB->id;
            $_SESSION['ADMIN_EMAIL'] = $userFromDB->usuario;
            header("Location: ".BASE_URL."listar");
            return;
        } else {
            return $this->view->showlogin("Usuario o contraseña incorrecta", $request->user);
        }
    }

    public function logout($request) {
        session_destroy();
        header("Location: ".BASE_URL."login");
        return;
    }



}