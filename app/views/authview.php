<?php

class AuthView {

    public function showlogin($error, $user) {
        require_once 'app/templates/formlogin.phtml';
    }

    public function showerror($error, $user) {
        echo "<h1>$error</h1>";
    }
}
