<?php

class MovieController
{

    private $movieArray;
    private $genresByMovieArray;
    private $actorsByMovieArray;

    public function __construct()
    {
        require_once 'model/MovieModel.php';
        $this->view = new View();
        $this->movieModel = new MovieModel();
    }

    private function listAllGenres()
    {
        require 'GenreController.php';
        $genreController = new GenreController();
        return $genreController->listAllGenres();
    }

    private function listAllActors()
    {
        require 'ActorController.php';
        $actorController = new ActorController();
        return $actorController->listAllActors();
    }

    private function getMainArrayToRegister()
    {
        $genreArray['genreArray'] = $this->listAllGenres();
        $actorArray['actorArray'] = $this->listAllActors();
        $mainArray['mainArray'] = array($genreArray, $actorArray);
        return $mainArray;
    }

    private function getMainArrayToSearch()
    {
        $genreArray['genreArray'] = $this->listAllGenres();
        $mainArray['mainArray'] = array($genreArray, $this->movieArray, $this->genresByMovieArray, $this->actorsByMovieArray);
        return $mainArray;
    }

    public function registerMovie()
    {
        $movieCode = $_POST['movieCode'];
        $this->movieModel->registerMovie($movieCode, $_POST['movieName'], $_POST['movieDuration'], $_POST['movieLanguage'], $_POST['movieSynopsis']);
        $this->registerGenresToMovie($movieCode, $_POST['genreSelected']);
        $this->registerActorsToMovie($movieCode, $_POST['actorselected']);
        $this->showMovieRegisterView();
    }

    private function registerGenresToMovie($movieCode, $genreArray)
    {
        foreach ($genreArray as $genre)
            $this->movieModel->registerGenresToMovie($movieCode, $genre);
    }

    private function registerActorsToMovie($movieCode, $actorArray)
    {
        foreach ($actorArray as $actor)
            $this->movieModel->registerActorsToMovie($movieCode, $actor);
    }

    public function exceuteQueryAccordingToButtonDelete()
    {
        if (isset($_POST['buttonSearch'])) {
            $this->movieArray['movieArray'] = $this->listMovieByName($_POST['movieName']);
        } else if (isset($_POST['buttonDelete'])) {
            $this->deleteMovieByName($_POST['movieToDelete']);
        }
        $this->showMovieDeleteView();
    }

    public function exceuteQueryAccordingToButtonSearch()
    {
        if (isset($_POST['buttonSearchByName'])) {
            $movieName = $_POST['movieName'];
            $this->saveListToSearcByName($movieName);
        } else if (isset($_POST['buttonSearchByGenre'])) {
            $genreSelected = $_POST['genreSelected'];
            $this->saveListToSearchByGenre($genreSelected);
        }
        $this->showMovieSearchView();
    }

    public function exceuteQueryAccordingToButtonFilter()
    {
        if (isset($_POST['buttonSearchByName'])) {
            $movieName = $_POST['movieName'];
            $this->saveListToSearcByName($movieName);
        } else if (isset($_POST['buttonSearchByGenre'])) {
            $genreSelected = $_POST['genreSelected'];
            $this->saveListToSearchByGenre($genreSelected);
        }
        $this->showMovieSearchView();
    }

    public function saveListToSearcByName($movieName)
    {
        $this->movieArray['movieArray'] = $this->listMovieByName($movieName);
        $this->genresByMovieArray['genresByMovieArray'] = $this->listGenresByMovieName($movieName);
        $this->actorsByMovieArray['actorsByMovieArray'] = $this->listActorsByMovieName($movieName);
    }

    public function saveListToSearchByGenre($movieGenre)
    {
        $this->movieArray['movieArray'] = $this->listMovieByGenre($movieGenre);
        $this->genresByMovieArray['genresByMovieArray'] = $this->listGenresByMovieGenre($movieGenre);
        $this->actorsByMovieArray['actorsByMovieArray'] = $this->listActorsByMovieGenre($movieGenre);
    }

    public function getActorByGenreAjax()
    {
        echo json_encode($this->listActorsByMovieGenre($_POST['genre']));
    }

    public function getMovieNameByAjax()
    {
        echo json_encode($this->movieModel->getMovieByActorGenreAjax($_POST['genre'], $_POST['actorFullName']));
    }

    public function getMovieDataByAjax(){
        echo json_encode($this->movieModel->getMovieDataByMovieNameAjax($_POST['movieName']));
    }

    public function getActorByMovieNameAjax()
    {
        echo json_encode($this->listActorsByMovieName($_POST['movieName']));
    }

    public function getGenresByMovieNameAjax(){
        echo json_encode($this->listGenresByMovieName($_POST['movieName']));
    }

    public function listMovieByName($movieName)
    {
        return $this->movieModel->getMovieByName($movieName);
    }

    public function listMovieByGenre($genre)
    {
        return $this->movieModel->getMovieByGenre($genre);
    }

    public function listGenresByMovieGenre($genre)
    {
        return $this->movieModel->getGenresByMovieGenre($genre);
    }

    public function listActorsByMovieGenre($genre)
    {
        return $this->movieModel->getActorsByMovieGenre($genre);
    }

    public function listActorsByMovieName($movieName)
    {
        return $this->movieModel->getActorsByMovieName($movieName);
    }

    public function listGenresByMovieName($movieName)
    {
        return $this->movieModel->getGenresByMovieName($movieName);
    }

    public function deleteMovieByName($movieName)
    {
        foreach ($movieName as $movie)
            $this->movieModel->deleteMovieByName($movie);
    }

    public function modifyMovie()
    {
        $this->movieModel->modifyMovie($_POST['movieCode'], $_POST['movieName'], $_POST['movieDuration'], $_POST['movieLanguage'], $_POST['movieSynopsis']);
        $this->showMovieUpdateView();
    }

    public function showMovieRegisterView()
    {
        $this->view->show("movieRegisterView.php", $this->getMainArrayToRegister());
    }

    public function showMovieDeleteView()
    {
        $this->view->show("movieDeleteView.php", $this->movieArray);
    }

    public function showMovieSearchView()
    {
        $this->view->show("movieSearchView.php", $this->getMainArrayToSearch());
    }

    public function showMovieUpdateView()
    {
        $this->view->show("movieUpdateView.php", null);
    }

    public function showMovieFilterView()
    {
        $genreArray['genreArray'] = $this->listAllGenres();
        $this->view->show("movieFilterView.php", $genreArray);
    }
}
