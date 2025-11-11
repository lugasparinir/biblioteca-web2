<?php

class GeneroView {
    
    
    private $header = ROOT_DIR . 'app/templates/header.phtml';
    private $footer = ROOT_DIR . 'app/templates/footer.phtml';
    private $template_path = ROOT_DIR . 'app/templates/';

    
    public function showGeneros($generos, $user) {
        require_once $this->header; 
        require_once $this->template_path . 'listadogeneros.phtml';
        require_once $this->footer;
    }

    public function showForm($genero = null, $user, $error = null) { 
        require_once $this->header;
        require_once $this->template_path . 'formgenero.phtml';
        require_once $this->footer;
    }


    public function showError($msg, $user) {
        require_once $this->header;
        echo "<div Error: " . htmlspecialchars($msg) . "</div></div>";
        require_once $this->footer;
    }
}