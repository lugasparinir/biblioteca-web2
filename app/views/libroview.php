<?php


class libroview {

    private $header = ROOT_DIR . 'app/templates/header.phtml';
    private $footer = ROOT_DIR . 'app/templates/footer.phtml';
    private $template_path = ROOT_DIR . 'app/templates/';
    
    public function showlibros($libros, $user) {
        require_once $this->header; 
        require_once $this->template_path . 'listadolibros.phtml';
        require_once $this->footer;
    }
    
    public function showlibro($libro, $user, $error = null) {
        require_once $this->header; 
        require_once $this->template_path . 'mostrarlibro.phtml';
        require_once $this->footer;
    }
 
    public function showform($libro = null, $generos, $user, $error = null) { 
        require_once $this->header; 
        require_once $this->template_path . 'formlibro.phtml'; 
        require_once $this->footer;
    }
    
    public function showerror($error, $user) {
        require_once $this->header;
        echo "<h1>Error: " . htmlspecialchars($error) . "</h1>";
        require_once $this->footer;
    }
}