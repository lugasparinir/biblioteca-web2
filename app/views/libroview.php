
<?php


class libroView {


    private function render($template, $data = []) {
        extract($data); 
        
        include 'templates/header.phtml'; 
        include "templates/{$template}.phtml"; // Carga el contenido dinámico
        include 'templates/footer.phtml';
    }


    public function showLibros($libros) {
        $this->render('publiclistadolibros', ['libros' => $libros]);
    }


    public function showLibroDetalle($libro) {
        $this->render('publicdetallelibro', ['libro' => $libro]);
    }
}
