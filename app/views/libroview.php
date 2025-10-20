<?php
class libroview {

    public function showlibros($libros, $user) {
        $cuenta = count($libros);

    
        require_once 'app/templates/listadolibros.phtml';
    }

    public function showerror($error, $user) {
        echo "<h1>$error</h1>";
    }
}
