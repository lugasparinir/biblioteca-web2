<?php


class guardmiddleware {
    public function run($request) {
        
        if (isset($request->user) && $request->user) {
           return $request;
        } else { 
            header("Location: " . BASE_URL . "login"); 
            exit();
        }
    }
}
