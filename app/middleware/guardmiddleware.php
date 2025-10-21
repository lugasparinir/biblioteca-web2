<?php

class guardmiddleware {
    public function run($request) {
        if (isset($request->user) && $request->user) {// verifica que $request->user exista y no sea null
           return $request;
        } else { 
           header("Location: " . BASE_URL . "login"); 
           exit();
        }
    }
}
