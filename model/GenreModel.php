<?php

class GenreModel {

    protected $database;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->database = SPDO::singleton();
    }

    public function getAllGenres() {
        $query = $this->database->prepare("call sp_get_genres()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function registerGenre($genreName) {
        $query = $this->database->prepare("call sp_insert_genre('$genreName')");
        $query->execute();
        $query->closeCursor();
    }

}
