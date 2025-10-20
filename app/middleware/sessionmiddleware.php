<?php

class sessionmiddleware {

    public function run($request) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $request->user = null;

     if (isset($_SESSION['IS_LOGGED']) && $_SESSION['IS_LOGGED'] === true) {
            $request->user = new StdClass();
            $request->user->id = $_SESSION['USER_ID'];
            $request->user->email = $_SESSION['USER_NAME']; //email admin
        } 
        
        return $request;
    }
}