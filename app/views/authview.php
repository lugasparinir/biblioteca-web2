<?php

class AuthView {

    public function showLogin($error, $user) {
        require_once './templates/formlibro.phtml';
    }

    public function showerror($error, $user) {
        echo "<h1>$error</h1>";
    }
}
