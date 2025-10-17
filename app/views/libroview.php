<?php

require_once 'helpers/authhelper.php';

class libroView {
   private $base_url=BASE_URL;

public function showLibros($libros, $islogged) {
        
        require 'templates/header.phtml';
        require 'templates/listadolibros.phtml'; 
        require 'templates/footer.phtml';
    }

    public function showlibro($libro) {
        require 'templates/header.phtml';
        require 'templates/librosingular.phtml';
        require 'templates/footer.phtml';
    }
}
