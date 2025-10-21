<?php

class sessionmiddleware {
    
    public function run($request) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $request->user = null;

        // Verificar que la sesión está iniciada Y que las claves necesarias existan
        if (isset($_SESSION['IS_LOGGED']) && $_SESSION['IS_LOGGED'] === true && isset($_SESSION['USER_ID']) && isset($_SESSION['USER_NAME'])) {
             
            $request->user = new StdClass();
            $request->user->id = $_SESSION['USER_ID'];
            $request->user->email = $_SESSION['USER_NAME']; 
        } 
        
        return $request;
    }
}