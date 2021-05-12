<?php

class MovieController {

    private $movieArray;
    private $genresByMovieArray;
    private $actorsByMovieArray;

    public function __construct() {
        require_once 'model/MovieModel.php';
        $this->view = new View();
        $this->movieModel = new MovieModel();
    }

    private function listAllGenres() {
        require 'GenreController.php';
        $genreController = new GenreController();
        return $genreController->listAllGenres();
    }

    private function listAllActors() {
        require 'ActorController.php';
        $actorController = new ActorController();
        return $actorController->listAllActors();
    }

    private function getMainArrayToRegister() {
        $genreArray['genreArray'] = $this->listAllGenres();
        $actorArray['actorArray'] = $this->listAllActors();
        $mainArray['mainArray'] = array($genreArray, $actorArray);
        return $mainArray;
    }

    private function getMainArrayToSearch() {
        $genreArray['genreArray'] = $this->listAllGenres();
        $mainArray['mainArray'] = array($genreArray, $this->movieArray, $this->genresByMovieArray, $this->actorsByMovieArray);
        return $mainArray;
    }

    public function registerMovie() {
        $movieCode = $_GET['movieCode'];
        $this->movieModel->registerMovie($movieCode, $_GET['movieName'], $_GET['movieDuration'], $_GET['movieLanguage'], $_GET['movieSynopsis']);
        $this->registerGenresToMovie($movieCode, $_GET['genreSelected']);
        $this->registerActorsToMovie($movieCode, $_GET['actorselected']);
        $this->showMovieRegisterView();
    }

    private function registerGenresToMovie($movieCode, $genreArray) {
        foreach ($genreArray as $genre)
            $this->movieModel->registerGenresToMovie($movieCode, $genre);
    }

    private function registerActorsToMovie($movieCode, $actorArray) {
        foreach ($actorArray as $actor)
            $this->movieModel->registerActorsToMovie($movieCode, $actor);
    }

    public function exceuteQueryAccordingToButtonDelete() {
        if (isset($_GET['buttonSearch'])) {
            $this->movieArray['movieArray'] = $this->listMovieByName($_GET['movieName']);
        } else if (isset($_GET['buttonDelete'])) {
            $this->deleteMovieByName($_GET['movieToDelete']);
        }
        $this->showMovieDeleteView();
    }

    public function exceuteQueryAccordingToButtonSearch() {
        if (isset($_GET['buttonSearchByName'])) {
            $movieName = $_GET['movieName'];
            $this->saveListToSearcByName($movieName);
        } else if (isset($_GET['buttonSearchByGenre'])) {
            $genreSelected = $_GET['genreSelected'];
            $this->saveListToSearchByGenre($genreSelected);
        }
        $this->showMovieSearchView();
    }

    public function saveListToSearcByName($movieName) {
        $this->movieArray['movieArray'] = $this->listMovieByName($movieName);
        $this->genresByMovieArray['genresByMovieArray'] = $this->listGenresByMovieName($movieName);
        $this->actorsByMovieArray['actorsByMovieArray'] = $this->listActorsByMovieName($movieName);
    }

    public function saveListToSearchByGenre($movieGenre) {
        $this->movieArray['movieArray'] = $this->listMovieByGenre($movieGenre);
        $this->genresByMovieArray['genresByMovieArray'] = $this->listGenresByMovieGenre($movieGenre);
        $this->actorsByMovieArray['actorsByMovieArray'] = $this->listActorsByMovieGenre($movieGenre);
    }

    public function listMovieByName($movieName) {
        return $this->movieModel->getMovieByName($movieName);
    }

    public function listMovieByGenre($genre) {
        return $this->movieModel->getMovieByGenre($genre);
    }

    public function listGenresByMovieGenre($genre) {
        return $this->movieModel->getGenresByMovieGenre($genre);
    }

    public function listActorsByMovieGenre($genre) {
        return $this->movieModel->getActorsByMovieGenre($genre);
    }

    public function listActorsByMovieName($movieName) {
        return $this->movieModel->getActorsByMovieName($movieName);
    }

    public function listGenresByMovieName($movieName) {
        return $this->movieModel->getGenresByMovieName($movieName);
    }

    public function deleteMovieByName($movieName) {
        foreach ($movieName as $movie)
            $this->movieModel->deleteMovieByName($movie);
    }

    public function modifyMovie() {
        $this->movieModel->modifyMovie($_GET['movieCode'], $_GET['movieName'], $_GET['movieDuration'], $_GET['movieLanguage'], $_GET['movieSynopsis']);
        $this->showMovieUpdateView();
    }

    public function showMovieRegisterView() {
        $this->view->show("movieRegisterView.php", $this->getMainArrayToRegister());
    }

    public function showMovieDeleteView() {
        $this->view->show("movieDeleteView.php", $this->movieArray);
    }

    public function showMovieSearchView() {
        $this->view->show("movieSearchView.php", $this->getMainArrayToSearch());
    }

    public function showMovieUpdateView() {
        $this->view->show("movieUpdateView.php", null);
    }

}

?>