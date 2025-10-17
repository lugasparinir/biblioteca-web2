<?php

require_once 'helpers/authhelper.php';

class libroView {
   private $base_url=BASE_URL;

public function showlibros($libros, $islogged) {
        
        require 'templates/header.phtml';
        require 'templates/listadolibros.phtml'; 
        require 'templates/footer.phtml';
    }

    public function showlibro($libro, $islogged) {
        require 'templates/header.phtml';
        require 'templates/librosingular.phtml';
        require 'templates/footer.phtml';
    }
}
