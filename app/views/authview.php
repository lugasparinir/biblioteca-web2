<?php

class AuthView {

    private $formlogin = ROOT_DIR . 'app/templates/formlogin.phtml';

    public function showlogin($error, $user) {
        require_once $this->formlogin;
    }

    public function showerror($error, $user) {
        require_once ROOT_DIR . 'app/templates/header.phtml';
        echo "<h1>Error: " . htmlspecialchars($error) . "</h1>";
        require_once ROOT_DIR . 'app/templates/footer.phtml';
    }
}