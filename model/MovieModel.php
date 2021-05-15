<?php

class MovieModel {

    protected $database;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->database = SPDO::singleton();
    }

    public function getMovieByName($movieName) {
        $query = $this->database->prepare("call sp_get_movie_by_name('$movieName')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getMovieByGenre($genre) {
        $query = $this->database->prepare("call sp_get_movie_by_genre('$genre')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getGenresByMovieName($movieName) {
        $query = $this->database->prepare("call sp_get_genres_by_movieName('$movieName')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getActorsByMovieName($movieName) {
        $query = $this->database->prepare("call sp_get_actors_by_movieName('$movieName')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getActorsByMovieGenre($genre) {
        $query = $this->database->prepare("call sp_get_actors_by_MovieGenre('$genre')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getGenresByMovieGenre($genre) {
        $query = $this->database->prepare("call sp_get_genres_by_MovieGenre('$genre')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getMovieByActorGenreAjax($genreName, $actorFullName){
        $query = $this->database->prepare("call sp_get_movieName_by_genre_and_actor('$genreName','$actorFullName')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function getMovieDataByMovieNameAjax($movieName){
        $query = $this->database->prepare("call sp_get_movieData_by_movieName('$movieName')");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function deleteMovieByName($movieName) {
        $query = $this->database->prepare("call sp_delete_movie_by_name('$movieName')");
        $query->execute();
        $query->closeCursor();
    }

    public function registerMovie($movieCode, $movieName, $movieDuration, $movieLanguage, $movieSynopsis) {
        $query = $this->database->prepare("call sp_insert_movie('$movieCode','$movieName','$movieDuration','$movieLanguage','$movieSynopsis')");
        $query->execute();
        $query->closeCursor();
    }

    public function registerGenresToMovie($movieCode, $genre) {
        $query = $this->database->prepare("call sp_insert_genre_to_movie('$movieCode', '$genre')");
        $query->execute();
        $query->closeCursor();
    }

    public function registerActorsToMovie($movieCode, $actor) {
        $query = $this->database->prepare("call sp_insert_actor_to_movie('$movieCode', '$actor')");
        $query->execute();
        $query->closeCursor();
    }

    public function modifyMovie($movieCode, $movieName, $movieDuration, $movieLanguage, $movieSynopsis) {
        $query = $this->database->prepare("call sp_modify_movie('$movieCode','$movieName','$movieDuration','$movieLanguage','$movieSynopsis')");
        $query->execute();
        $query->closeCursor();
    }

    public function modifyMovieName($movieCode, $newMovieName) {
        $query = $this->database->prepare("call sp_modify_movieName('$movieCode','$newMovieName')");
        $query->execute();
        $query->closeCursor();
    }

    public function modifyMovieDuration($movieCode, $newMovieDuration) {
        $query = $this->database->prepare("call sp_modify_movieDuration('$movieCode','$newMovieDuration')");
        $query->execute();
        $query->closeCursor();
    }

    public function modifyMovieLanguage($movieCode, $newMovieLanguage) {
        $query = $this->database->prepare("call sp_modify_movieLanguage('$movieCode','$newMovieLanguage')");
        $query->execute();
        $query->closeCursor();
    }

    public function modifyMovieSynopsis($movieCode, $newMovieSynopsis) {
        $query = $this->database->prepare("call sp_modify_movieSynopsis('$movieCode','$newMovieSynopsis')");
        $query->execute();
        $query->closeCursor();
    }

}
