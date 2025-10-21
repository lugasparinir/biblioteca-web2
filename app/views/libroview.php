<?php
class libroview {

    public function showlibros($libros, $user) {
        require_once 'app/templates/listadolibros.phtml';
    }
    public function showlibro($libro, $user) {
        require_once 'app/templates/mostrarlibro.phtml';
    }
    public function showform($libro = null, $user) { 
        require_once 'app/templates/formlibro.phtml'; 
    }
    public function showerror($error, $user) {
        echo "<h1>$error</h1>";
    }
}
