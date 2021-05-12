<?php

class GenreController {

    public function __construct() {
        require_once 'model/GenreModel.php';
        $this->view = new View();
        $this->genreModel = new GenreModel();
    }

    public function listAllGenres() {
        return $this->genreModel->getAllGenres();
    }

    public function registerGenre() {
        $this->genreModel->registerGenre($_GET['genreName']);
        $this->showGenreRegisterView();
    }

    public function showGenreRegisterView() {
        $this->view->show("genreRegisterView.php", null);
    }

}

?>