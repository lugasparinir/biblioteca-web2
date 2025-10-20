<?php

class guardmiddleware {
    public function run($request) {
        
        if (!defined('BASE_URL')) {
             require_once 'app/models/config.php'; 
        }

        if ($request->user) {
           return $request;
        } else { 
           header("Location: " . BASE_URL . "login"); 
           exit();
        }
    }
}
